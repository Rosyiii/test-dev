<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// starting
Route::get('/login', [UserController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);
Route::post('/logout', [UserController::class, 'logout']);

Route::get('/', [UserController::class, 'loginSucces'])->middleware('auth');
Route::get('/data_user', [UserController::class, 'users'])->middleware('admin');
Route::get('/detail_user/{id:id}', [UserController::class, 'detail'])->middleware('admin');
Route::post('/detail_user/{id:id}', [PostController::class, 'update']);

Route::get('/registrasi', [UserController::class, 'indexRegis'])->middleware('admin');
Route::post('/registrasi', [UserController::class, 'store']);

// Post
Route::get('/tambah_post', [PostController::class, 'indexTambah'])->middleware('auth');
Route::post('/tambah_post', [PostController::class, 'store']);
Route::get('/detail_post/{id:id}', [PostController::class, 'detail'])->middleware('auth');

// Destroy
Route::post('/post/{id:id}', [PostController::class, 'destroy'])->middleware('auth');

// edit
Route::get('/edit_post/{id:id}', [PostController::class, 'edit'])->middleware('auth');
Route::post('/edit_post/{id:id}', [PostController::class, 'update']);