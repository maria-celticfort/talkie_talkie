<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MatchController;
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

Route::get('/', function () {
    return view('index');
})->name('index');

#Generates URIs for User
Route::resource('user',UserController::class);
Route::post('auth',[UserController::class, 'auth'])->name('user.auth');
Route::get('logout',[UserController::class, 'logout'])->name('user.logout');

#Generates URIs for Topic
Route::resource('topic',TopicController::class);

#Generates URIs for Conversation
Route::resource('conversation',ConversationController::class);

#Generates URIs for match Controller
Route::get('match_index',[MatchController::class,'index'])->name('match.index');
Route::get('match_load',[MatchController::class,'load'])->name('match.load');
Route::get('match_cancel',[MatchController::class,'cancel'])->name('match.cancel');