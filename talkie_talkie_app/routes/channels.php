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

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel ('chat.{conversation_id}',function($user,$conversation_id){
    //$conversation_id = 162;
    //return true;
    return ['name'=>$user->name];
});