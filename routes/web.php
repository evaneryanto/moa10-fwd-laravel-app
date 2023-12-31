<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\HomeMemberController;
use App\Http\Controllers\MasterBukuController;
use App\Http\Controllers\MasterMemberController;
 
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


Route::group(['middleware' => 'guest'], function () {
    Route::get('/register_member', [MemberController::class, 'register'])->name('register.member');
    Route::post('/register_member', [MemberController::class, 'registerPost'])->name('register.member');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');

    Route::get('/login_member', [MemberController::class, 'login'])->name('login.member');
    Route::post('/login_member', [MemberController::class, 'loginPost'])->name('login.member');
});
 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/home_member', [HomeMemberController::class, 'index']);

    Route::get('/master_buku',[MasterBukuController::class, 'tampil_master_buku'])->name('tampil_master_buku');

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::delete('/logout_member', [MemberController::class, 'logout'])->name('logout.member');

    //Route::get('/master_buku', [MasterBukuController::class, 'tampil_master_buku']);
    Route::get('/fetchall', [MasterBukuController::class, 'fetchAll'])->name('fetchAll');
    Route::post('/store', [MasterBukuController::class, 'store'])->name('store');
    Route::get('/edit', [MasterBukuController::class, 'edit'])->name('edit');
    Route::post('/update', [MasterBukuController::class, 'update'])->name('update');
    Route::delete('/delete', [MasterBukuController::class, 'delete'])->name('delete');

    Route::get('/master_member', [MasterMemberController::class, 'tampil_master_member'])->name('tampil_master_member');
    Route::get('/fetchallmember', [MasterMemberController::class, 'fetchAllMember'])->name('fetchAllMembers');
    Route::post('/store_member', [MasterMemberController::class, 'store_members'])->name('storeMembers');
    Route::get('/edit_member', [MasterMemberController::class, 'edit_member'])->name('editMembers');
    Route::post('/update_member', [MasterMemberController::class, 'update_member'])->name('updateMembers');
    Route::delete('/delete_member', [MasterMemberController::class, 'delete'])->name('deleteMembers');
});


//Route::get('/', [EmployeeController::class, 'index']);





