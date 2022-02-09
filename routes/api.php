<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\blogcontroller;


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
Route::post('add-blog',[blogcontroller::class,'add_blog']);
Route::get('get-all-blogs',[blogcontroller::class,'get_all_blogs']);
Route::post('get-blog-data',[blogcontroller::class,'get_blog_data']);
Route::post('get-comments',[blogcontroller::class,'get_comments']);
Route::post('update-comments',[blogcontroller::class,'update_comments']);



