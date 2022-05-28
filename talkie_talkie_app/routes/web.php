<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MatchController;
use Illuminate\Support\Facades\Route;

use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


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

#Generates URIs for Conversation for Conversation
Route::resource('conversation',ConversationController::class);
Route::get('conversation_queue',[ConversationController::class,'add_to_queue'])->name('conversation.queue');
Route::get('conversation_cancel',[ConversationController::class,'cancel'])->name('conversation.cancel');
Route::post('send_message',[ConversationController::class,'send_message'])->name('message.send');

#Test
Route::get('conversation_id',[ConversationController::class,'conversation_id'])->name('conversation.id');

#Generates URIs for match Controller
#Route::get('match_index',[MatchController::class,'index'])->name('match.index');
#Route::get('match_queue',[MatchController::class,'add_to_queue'])->name('match.queue'); 
#Route::get('match_cancel',[MatchController::class,'cancel'])->name('match.cancel'); #Desstroy
#Route::get('match_create',[MatchController::class,'create_conversation'])->name('match.create'); #Create or store