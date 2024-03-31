<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\DateService;
use App\Services\ContentService;
use App\Services\ReadArticleService;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
     // Get list of articles with their categories
     public function index(Request $request)
     {

        if($request->paginate){
            $paginate = $request->paginate;
            $articles = Article::with('categories')->orderBy('id','desc')->paginate($paginate);
        }else{
            $articles = Article::with('categories')->orderBy('id','desc')->get();

        }

        $articles = DateService::formatArticleDates($articles);
        $articles = ContentService::sortArticleContents($articles);
        // return $articles;
        return ArticleResource::collection($articles);



     }

     // Get list of articles by category
     public function getByCategory($categoryId)
     {
         $articles = Article::whereHas('categories', function ($query) use ($categoryId) {
             $query->where('category_id', $categoryId);
         })->with('categories')->orderBy('id','desc')->get();

         $articles = ContentService::sortArticleContents($articles);
         return $articles;
     }

       // Create a new article
       public function store(Request $request)
       {

           $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'categories' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
           // Get the authenticated user using the bearer token
           $user = auth()->user();




           if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('post/banner', $fileName, 'protected');
        } else {
            return response()->json(['error' => 'No banner file provided.'], 422);
        }


        $article = new Article();


        $article->title = $request->title; // Set the title
        $article->setSlugAttribute($article->title);
        if($user){
            $article->author = $user->name; // Set other attributes
            $article->user_id = 1;
        }
        $article->date = date('Y-m-d H:i:s'); // Set other attributes
        $article->content = $request->content;
        $article->banner = url('files/'.$filePath);
        $article->save();



           $article->categories()->attach($request->categories);

           return response()->json($article, 201);
       }

       // Update an existing article
       public function update(Request $request, $id)
       {

           $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'categories' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
           // Get the authenticated user using the bearer token
           $user = auth()->user();

           $article = Article::findOrFail($id);
           // Check if the authenticated user owns the article
           if ($article->user_id !== $user->id) {
               return response()->json(['error' => 'Unauthorized'], 401);
           }



           $article->title = $request->title;
           $article->author = $user->name;
           $article->content = $request->content;






        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('post/banner', $fileName, 'protected');
            // $updatedData['banner'] = url('files/'.$filePath);
            $article->banner = url('files/'.$filePath);
        }
        //    $article->update($updatedData);
            $article->save();

           $article->categories()->sync($request->categories);

           return response()->json($article, 200);
       }

     // Delete an article
     public function destroy($id)
     {
         $article = Article::findOrFail($id);
         $article->delete();

         return response()->json(null, 204);
     }

     // Show a specific article with its categories
     public function show($id)
     {
         $article = Article::with('categories')->findOrFail($id);
         $article = DateService::formatArticleDate($article);

         return response()->json($article, 200);
     }

     public function showBySlug(Request $request, $slug)
     {
         $article = Article::with('categories')->where('slug', $slug)->firstOrFail();
         $article = DateService::formatArticleDate($article);





        //  $data = [
        //     // 'user_id' => $request->user_id,
        //     'article_id' => $article->id,
        //     'browser' => $request->header('User-Agent'),
        //     'ip_address' => $request->ip(),
        //     'location' => $request->location,
        //     'mac_address' => $request->mac_address,
        //     'date' => now()->toDateString(),
        //     'month' => now()->month,
        //     'year' => now()->year,
        //     'unique_reader_id' => $request->unique_reader_id,
        // ];

        // $readArticle = ReadArticleService::createReadArticle($data);










         return response()->json($article, 200);
     }


     function getArticlesBySlug($slug) {
        $categorySlug = $slug;
        $perPage = 15;

        $articles = Article::getByCategorySlug($categorySlug, $perPage);
        $articles = DateService::formatArticleDates($articles);
        $articles = ContentService::sortArticleContents($articles);
       return ArticleResource::collection($articles);
     }
     function getLatestarticles() {

        $latestArticles = Article::latestArticles(10);
        $latestArticles = ContentService::sortArticleContents($latestArticles);

        return ArticleResource::collection($latestArticles);
        // return $latestArticles;
     }

     function getRelatedArticles(Request $request,$articleSlug) {

        $limit = $request->limit;
        if($limit){
            $limit = $request->limit;
        }else{
            $limit = 8;
        }
        $article = new Article();
        $relatedArticles = $article->relatedArticlesByArticleSlug($articleSlug,$limit);
        $relatedArticles = ContentService::sortArticleContents($relatedArticles);
        $relatedArticles = DateService::formatArticleDates($relatedArticles);
        return ArticleResource::collection($relatedArticles);
        return $relatedArticles;
     }




     public function updateSlugs()
     {
          // Get all articles from the database
          $articles = Article::all();

          // Loop through each article and update its slug based on the title
          foreach ($articles as $article) {
            $article->setSlugAttribute($article->title);
            //  return $article->setSlugAttribute($article->title); // Use setSlugAttribute method to generate unique slug
              $article->save(); // Save the changes
          }

          return response()->json(['message' => 'Article slugs updated successfully'], 200);
     }


}
