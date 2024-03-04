<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register',[AuthController::class,'loadRegister']);
Route::post('/register',[AuthController::class,'UsersRegister'])->name('UsersRegister');


Route::get('/login',function(){
    return redirect('/');
});
Route::get('/',[AuthController::class,'loadLogin']);
Route::post('/login',[AuthController::class,'userLogin'])->name('userLogin');

Route::get('/logout',[AuthController::class,'logout']);



//Admin Section================================================================>
Route::group(['middleware'=>['web','checkAdmin']],function(){
    Route::get('/admin/dashboard',[AuthController::class,'adminDahsboard']);

    Route::get('/admin/dashboard/add-skills',[AdminController::class,'skillPage'])->name('skillPageLoad');
    
    Route::post('/add-skills',[AdminController::class,'addSkill'])->name('addSkillss');
    Route::post('/edit-skills',[AdminController::class,'editSkill'])->name('editSkills');
    Route::post('/delete-skills',[AdminController::class,'deleteSkill'])->name('deleteSkill');

    
    Route::get('/admin/dashboard/add-QA',[AdminController::class,'QApageLoad'])->name('QApageLoad');

    Route::post('/add-Questions',[AdminController::class,'addQA'])->name('addQuesAns');
});


//Student Section Or USer Section======================================>
Route::group(['middleware'=>['web','checkUsers']],function(){
    Route::get('/dashboard',[AuthController::class,'loadDahsboard']);
    Route::post('/add-rest-data-of-user',[AdminController::class,'addRestdataOfuser'])->name('add_rest_data_of_user');
});
