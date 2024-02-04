<?php

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use  App\Http\Controllers\api\authController;
use App\Http\Controllers\NidSearchedController;
use App\Http\Controllers\NotificationController;

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

Route::get('user/{status}/{id}',[UserController::class,'userbanned']);
Route::resources([
    'admin/user' => UserController::class,
    'admin/notification' => NotificationController::class,
]);

Route::resource('nidsearched', NidSearchedController::class);
Route::resource('payments', PaymentController::class);
Route::get('payments/user/{userId}', [PaymentController::class, 'paymentsForUser']);
Route::get('payments/approve/{id}', [PaymentController::class, 'approvePayment']);
Route::post('user/up/{id}/{bal}',[UserController::class,'balanceUpdate']);
Route::post('/register', [UserController::class, 'registerUser']);
Route::get('/get/all/stats', [NidSearchedController::class, 'allStats']);








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
