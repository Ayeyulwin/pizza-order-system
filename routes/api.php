<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\RouteCompiler;
use App\Http\Controllers\API\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//GET
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('user/list',[RouteController::class,'userList']);
Route::get('order/list',[RouteController::class,'orderList']);

//POST
Route::post('create/category',[RouteController::class,'createCategory']);
Route::post('create/contact',[RouteController::class,'createCOntact']);

Route::post('delete/category',[RouteController::class,'deleteCategory']);

Route::get('category/details/{id}',[RouteController::class,'categoryDetails']);

Route::post('category/update',[RouteController::class,'categoryUpdate']);


/**
 *
 * product list
 * localhost:8000/api/product/list (GET)
 *
 * create category
 * localhost:8000/api/create/category (POST)
 * body{
 *      name : ''
 * }
 *
 *create contact
 * localhost:8000/api/create/contact (POST)
 * body{
 *      name : '' ,
 *      email : '' ,
 *      message : ''
 * }
 *
 *
 * //delete category
 * localhost:8000/api/delete/category (POST)
 * body{
 *      category_id : ''
 * }
 *
 *  //category details
 * localhost:8000/api/category/details/{id} (GET)
 *
 *
 *
 * //update category
 * localhost:8000/api/category/update (POST)
 * body{
 *      category_name : '' ,
 *      category_id : ''
 * }
 */

