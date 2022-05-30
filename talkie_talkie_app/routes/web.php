<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ConversationController;
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

#Generates URI for main page
Route::get('/', function () {
    return view('index');
})->name('index');

#Generates URIs for User
Route::resource('user',UserController::class);
Route::post('auth',[UserController::class, 'auth'])->name('user.auth');
Route::get('logout',[UserController::class, 'logout'])->name('user.logout');
Route::get('show_profile',[UserController::class, 'show_profile'])->name('user.show_profile');

#Generates URIs for Topic
Route::resource('topic',TopicController::class);

#Generates URIs for Conversation
Route::resource('conversation',ConversationController::class);
Route::get('conversation_queue',[ConversationController::class,'add_to_queue'])->name('conversation.queue');
Route::get('conversation_cancel',[ConversationController::class,'cancel'])->name('conversation.cancel');
Route::post('send_message',[ConversationController::class,'send_message'])->name('message.send');


