<?php

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use  App\Http\Controllers\api\authController;
use App\Http\Controllers\bkash\BkashController;
use App\Http\Controllers\NidSearchedController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\bkash\BkashRefundController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('bkash/get-token', [BkashController::class, 'getToken'])->name('bkash-get-token');
Route::post('bkash/create-payment', [BkashController::class, 'createPayment'])->name('bkash-create-payment');
Route::post('bkash/execute-payment', [BkashController::class, 'executePayment'])->name('bkash-execute-payment');
Route::get('bkash/query-payment', [BkashController::class, 'queryPayment'])->name('bkash-query-payment');
Route::post('bkash/success', [BkashController::class, 'bkashSuccess'])->name('bkash-success');

// Refund Routes for bKash
Route::get('bkash/refund', [BkashRefundController::class ,'index'])->name('bkash-refund');
Route::post('bkash/refund', [BkashRefundController::class ,'refund'])->name('bkash-refund');


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [authController::class,'login']);
    Route::post('register', [authController::class,'register']);
    Route::post('logout', [authController::class,'logout']);
    Route::post('refresh', [authController::class,'refresh']);
    Route::post('me', [authController::class,'login']);

});


Route::middleware('auth:api')->group(function () {

Route::get('user/{status}/{id}',[UserController::class,'userbanned']);
Route::resources([
    'admin/user' => UserController::class,
    'admin/notification' => NotificationController::class,
]);
Route::get('single/user/{token}', [UserController::class, 'showByToken']);
Route::resource('nidsearched', NidSearchedController::class);
Route::resource('payments', PaymentController::class);
Route::get('payments/user/{userId}', [PaymentController::class, 'paymentsForUser']);
Route::get('payments/approve/{id}', [PaymentController::class, 'approvePayment']);
Route::post('user/up/{id}/{bal}',[UserController::class,'balanceUpdate']);
Route::post('/register', [UserController::class, 'registerUser']);
Route::get('/get/all/stats', [NidSearchedController::class, 'allStats']);

Route::post('/update/nid/data/{id}', [NidSearchedController::class, 'updateNid']);

});






Route::get('get/roles',[authController::class,'getRoles']);
Route::post('role/assign',[authController::class,'roleAssign']);
Route::get('get/all/latest/news',[BlogController::class,'latestNews']);
Route::get('get/all/category',[CategoryController::class,'index']);
Route::get('get/category/list',[CategoryController::class,'getCategory']);
Route::get('update/category/{id}',[CategoryController::class,'getSinglecategory']);
Route::post('update/category',[CategoryController::class,'updatecategory']);
Route::get('get/post/by/post/{id}',[BlogController::class,'getPostBy']);
Route::get('get/blog/list',[BlogController::class,'getblog']);
Route::post('set/featured/post',[BlogController::class,'setFiPost']);
Route::get('get/blog/delete/{id}',[BlogController::class,'deleteblog']);
Route::get('update/blog/{id}',[BlogController::class,'getblogEdit']);
Route::post('update/blog',[BlogController::class,'updateblog']);





    Route::post('/articles', [ArticleController::class, 'store']);
    Route::get('/articles/{id}', [ArticleController::class, 'show']);
    Route::post('/articles/{id}', [ArticleController::class, 'update']);
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
    // Article routes
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/by-category/{categoryId}', [ArticleController::class, 'getByCategory']);
    Route::get('/articles/{id}', [ArticleController::class, 'show']);
    Route::get('/article/{slug}', [ArticleController::class, 'showBySlug']);
    Route::get('/articles/list/{slug}', [ArticleController::class, 'getArticlesBySlug']);

    Route::get('/all/latest/articles', [ArticleController::class, 'getLatestarticles']);
    Route::get('/all/related/articles/{articleSlug}', [ArticleController::class, 'getRelatedArticles']);



    Route::post('/categories', [CategoryController::class, 'store']);
    Route::post('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
    // Category routes
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::get('/categories/{id}/subcategories', [CategoryController::class, 'getSubcategories']);
