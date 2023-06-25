<?php

use App\Http\Livewire\Post\Create;
use App\Http\Livewire\Post\Edit;
use App\Http\Livewire\Post\Index;
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

Route::get('/counter', fn () => view('counter'));
Route::get('/user', fn () => view('user.index'));

Route::get('/post', Index::class);
