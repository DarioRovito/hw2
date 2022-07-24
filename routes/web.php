<?php

use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/', function () {return view('welcome');});

//Generali
Route::get("/login", "App\Http\Controllers\LoginController@login")->name("login");
Route::post("/login", "App\Http\Controllers\LoginController@verify_Login");
Route::post("/logout", "App\Http\Controllers\LoginController@logout")->name("logout");
Route::get('/home', "App\Http\Controllers\HomeController@index")->name('home');
Route::get('/profilo', 'App\Http\Controllers\ProfiloController@index')->name('profilo');

//Fase di registrazione
Route::post('/register', "App\Http\Controllers\RegisterController@register");
Route::get('/register', "App\Http\Controllers\RegisterController@index")->name('register');
Route::get('/register/email/{query}', "App\Http\Controllers\RegisterController@verify_Email");
Route::get("register/username/{q}", "App\Http\Controllers\RegisterController@verify_Username");

//Post
Route::get('/postone', 'App\Http\Controllers\PostController@post');
Route::get('/postfollow','App\Http\Controllers\PostController@postfollow');

//Ricercare persone
Route::get('/search_people', 'App\Http\Controllers\SearchPeopleController@index')->name('search_people');
Route::post('/search_utente', 'App\Http\Controllers\SearchPeopleController@search_utente');
Route::post('/search_utenti', 'App\Http\Controllers\SearchPeopleController@search_utenti');
Route::post('/follow', 'App\Http\Controllers\SearchPeopleController@follow');
Route::post('/unfollow', 'App\Http\Controllers\SearchPeopleController@unfollow');

//Like
Route::post('/viewlike', 'App\Http\Controllers\LikeController@show');
Route::post('/post_like', 'App\Http\Controllers\LikeController@post_like');
Route::post('/post_dont_like', 'App\Http\Controllers\LikeController@post_dont_like');

//Commenti
Route::get('/post/{id}/comments', 'App\Http\Controllers\CommentController@show');
Route::post('/comment', 'App\Http\Controllers\CommentController@index');

//Preferiti
Route::post('/prefers', 'App\Http\Controllers\PreferitiController@newprefer');
Route::post('/deleteprefers', 'App\Http\Controllers\PreferitiController@deleteprefer');
Route::get('/viewprefers', 'App\Http\Controllers\PreferitiController@viewprefers');

//Nuovi post
Route::get('/New', 'App\Http\Controllers\NewController@index')->name('New');
Route::post('/new', 'App\Http\Controllers\NewController@new');
Route::get('/New/search/{type}/{query?}', 'App\Http\Controllers\NewController@search');
