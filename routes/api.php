<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\Front\RecentPostController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login',[LoginController::class,'login']);
Route::post('register',[RegisterController::class,'register']);

Route::get('recent-post',RecentPostController::class);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user',function(Request $request){
        return $request->user();
    });

    Route::resource('/settings',SettingsController::class);
    Route::resource('/categories',CategoriesController::class);
    Route::resource('/authors',AuthorController::class);
    Route::resource('/articles',ArticleController::class);
    Route::resource('/subscriptions',SubscriptionController::class);

    // Other

    Route::post('/upload-image' , [UploadController::class,'editorImage'])->name('upload.editor');
});
