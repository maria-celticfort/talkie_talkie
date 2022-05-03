<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class MatchController extends Controller
{
    /**
     * Display a listing of the resource. Returns to 'wait room'
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('conversation.load');
    }

    /**
     * Try to match to users looking for the same Topic
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public static function load()
    {
        $user_id=Session::get('id');
        $topic_id=Session::get('topic_id');

        DB::table('users_looking_for_match')->insert([
            'user_id'=> $user_id,
            'topic_id' => $topic_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('match.index');
    }

    /**
     * Cancel current try of matching
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public static function cancel()
    {
        $user_id=Session::get('id');
        DB::table('users_looking_for_match')->where('user_id', $user_id)->delete();
        return redirect()->route('index');
    }

}
