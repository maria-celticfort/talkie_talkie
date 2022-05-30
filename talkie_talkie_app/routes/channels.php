<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

use App\Models\Conversation;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

/**
 * This method shoul validate which users are allowed to join 'chat.{conversation_id}' But we did that before
 * so any user who reach this point is allowed to.
 * 
 * It needs to return any data about the user because Pusher and Events in Laravel works (it could be the name,
 * all the user data, id , etc) 
 */
Broadcast::channel ('chat.{conversation_id}',function($user,$conversation_id){
    return ['name'=>$user->name];
});