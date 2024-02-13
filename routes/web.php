<?php

use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[EmployeeController::class,'display']);

Route::post('/dataupload',[EmployeeController::class,'upload']);
Route::get('/dataupload',[EmployeeController::class,'display']);

Route::get('/dataupdate/{id}',[EmployeeController::class,'update']);
Route::post('/dataupdatesubmit',[EmployeeController::class,'updatedata']);

Route::get('/datadelete/{id}',[EmployeeController::class,'delete_data']);

Route::get('/search',[EmployeeController::class,'search']);


Route::get('/sayHello',function(){
    return "Hello";
});