<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('conversation.load');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }

    /**
     * Try to match to users looking for the same Topic
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public static function add_to_queue(Request $request)
    {
        #TODO This comments need some improvement...
        $user_id=Session::get('id');
        $topic_id=Session::get('topic_id');

        #Check 

        #from the waiting room
        #If user_1_id already has a conversation and other person joins that conversation; redirect to chat view
        if (DB::table('conversations')->where('user_1_id',$user_id)->whereNull('end_date')->value('user_2_id') != NULL ){
            #Imagine this is the chat view
            return view('conversation.chat');
        }

        #from the waiting room
        #if the conversation exists but no one joined yet, just keep waiting
        if ((DB::table('conversations')->where('user_1_id',$user_id)->whereNull('end_date')->value('user_1_id')) != (NULL)){
            return redirect()->route('conversation.index');
        }
            
        #Check if someone is looking for the same topic already
        $match=DB::table('conversations')->where('topic_id',$topic_id)->whereNull('end_date')->value('id');

        #Not lokking for-> creates a new conversation and goes to waiting room
        if(!$match){
            Conversation::create([
                'user_1_id'=>$user_id,
                'topic_id'=>$topic_id
            ]);

            $id=DB::table('conversations')->where('user_1_id',$user_id)->whereNull('end_date')->value('id');
            $request->Session()->put('conversation_id', $id);
            #Test return
            return redirect()->route('conversation.index');

        #A conver is started and has only one user-> this user joins that conver and goes directly to chat view
        }else{
            $conversation=([
                'user_2_id'=>$user_id,
                'start_date'=>Carbon::now()
            ]);

            DB::table('conversations')->where('topic_id',$topic_id)->update($conversation);
            $id=DB::table('conversations')->where('user_2_id',$user_id)->whereNull('end_date')->value('id');
            $request->Session()->put('conversation_id', $id);

            #Test return
            #return redirect()->route('index');
            return view('conversation.chat');
        }
    }

    /**
     * Cancel current try of matching
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public static function cancel(Request $request)
    {
        $end_date=([
            'end_date'=>Carbon::now()
        ]);

        $id=$request->Session()->get('conversation_id');
        DB::table('conversations')->where('id',$id)->update($end_date);
        $request->Session()->put('conversation_id',null);
        return redirect()->route('index');
    }
}
