<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maincategory =  Category::where(['type'=>'main','status'=>'active'])->get();
        $maincategoris = [];
        foreach ($maincategory as  $mainCat) {
            // print_r($mainCat);
            $id = $mainCat->id;
            $subCategoies = [];
            $subCategory =  Category::where(['type'=>'sub','status'=>'active','cat_id'=>$id])->get();
            foreach ($subCategory as  $subCat) {
                $id2 = $subCat->id;
                $subCategoies2 = [];
                $subCategory2 =  Category::where(['type'=>'sub_sub','status'=>'active','cat_id'=>$id])->get();
                foreach ($subCategory2 as  $subCat2) {
                    array_push($subCategoies2,['id'=>$subCat2->id,'name'=>$subCat2->name,'slug'=>$subCat2->slug]);
                }
                array_push($subCategoies,['id'=>$subCat->id,'name'=>$subCat->name,'slug'=>$subCat->slug,'subCategoies'=>$subCategoies2]);
            }


            array_push($maincategoris,['id'=>$mainCat->id,'name'=>$mainCat->name,'slug'=>$mainCat->slug,'subCategoies'=>$subCategoies]);

        }

        return $maincategoris;


    }


    public function getCategory(Request $request)
    {
        $type = $request->type;
        if($type=='all'){
            return  Category::orderBy('id','desc')->get();
        }
        return Category::orderBy('id','desc')->paginate(20);
    }
        public function getSinglecategory(Request $request,$id)
        {
           return Category::find($id);
        }

    public function updatecategory(Request $request)
    {

        $id = $request->id;
        $cat_id = $request->cat_id;


        $name = $request->name;
        $slug = strtolower(str_replace(" ","_",$request->slug));
        if($id){

            $data = ['name'=>$name,'slug'=>$slug,'cat_id'=>$cat_id,'type'=>'main'];
            if($cat_id){
                $data = ['name'=>$name,'slug'=>$slug,'cat_id'=>$cat_id,'type'=>'sub'];
            }
            $data['status']='active';

            $Blog_category = Category::find($id);
            return $Blog_category->update($data);
        }
        $random  = sprintf("%06d", mt_rand(1, 999999));
        $data = ['name'=>$name,'slug'=>$slug,'category_id'=>$random,'cat_id'=>$cat_id,'type'=>'main'];
        if($cat_id){
            $data = ['name'=>$name,'slug'=>$slug,'category_id'=>$random,'cat_id'=>$cat_id,'type'=>'sub'];
        }
        $data['status']='active';
        return Category::create($data);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
