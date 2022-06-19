<?php

use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Read all data from CATEGORIES and PRODUCTS table
Route::get('data-products-categories', [CategoryProductController::class, 'index']);
// Create, Update, and Delete to PRODUCTS table
Route::post('store-product', [ProductController::class, 'store']);
Route::patch('update-product', [ProductController::class, 'update']);
Route::delete('delete-product', [ProductController::class, 'destroy']);
// Create, Update, and Delete to CATEGORIES table
Route::post('store-category', [CategoryController::class, 'store']);
Route::patch('update-category', [CategoryController::class, 'update']);
Route::delete('delete-category', [CategoryController::class, 'destroy']);
// Create, Update, and Delete to CATEGORIES table
Route::post('store-image', [ImageController::class, 'store']);
Route::patch('update-image', [ImageController::class, 'update']);
Route::delete('delete-image', [ImageController::class, 'destroy']);
