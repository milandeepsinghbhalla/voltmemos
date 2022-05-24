<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\blogcontroller;
use App\Http\Controllers\userController;
use App\Http\Controllers\subscriptionController;


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
Route::post('add-user',[userController::class,'add_user']);
Route::post('login-user',[userController::class,'login_user']);
Route::post('add-subscription',[subscriptionController::class,'add_subscription']);
Route::post('delete-blog',[blogcontroller::class,'delete_blog']);

Route::post('add-blog',[blogcontroller::class,'add_blog']);
Route::post('edit-blog',[blogcontroller::class,'edit_blog']);

Route::get('get-all-blogs',[blogcontroller::class,'get_all_blogs']);
Route::post('get-user-blogs',[blogcontroller::class,'get_user_blogs']);

Route::post('get-blog-data',[blogcontroller::class,'get_blog_data']);
Route::post('get-blog-edit-data',[blogcontroller::class,'get_blog_edit_data']);

Route::post('get-comments',[blogcontroller::class,'get_comments']);
Route::post('update-comments',[blogcontroller::class,'update_comments']);



