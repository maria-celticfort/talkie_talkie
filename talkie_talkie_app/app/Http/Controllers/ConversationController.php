<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ConversationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('conversation.load');
    }

    public function send_message(Request $request)
    {
        $user = User::find(Auth::id());
        $conversation_id = Session::get('conversation_id');
        $pronouns = $user->pronouns;
        $pronouns= DB::table('users')->where('id',$user->id)->value('pronouns');
        

        event(new ChatEvent($request->message, $user, $conversation_id, $pronouns));
    }

    public function conversation_id(Request $request)
    {
        $conversation_id = Session::get('conversation_id');

        return $conversation_id;
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
        #TODO This comments need some improvements...
        $user_id=Session::get('id');
        $topic_id=Session::get('topic_id');

        #Check
         #WAIT ROOM

        #from the waiting room
        #If user_1_id already has a conversation and other person joins that conversation; redirect to chat view
        if (DB::table('conversations')->where('user_1_id',$user_id)->whereNull('end_date')->value('user_2_id') != NULL ){
            $conversation_id = Session::get('conversation_id');



            $payload=$conversation_id;
            $payload = json_encode($payload);
            $payload = preg_replace("_\\\_", "\\\\\\", $payload);
            $payload = preg_replace("/\"/", "\\\"", $payload);
            return view('conversation.chat')
            ->with('payload', $payload);
        }

       
        #from the waiting room
        #if the conversation exists but no one joined yet, just keep waiting
        if ((DB::table('conversations')->where('user_1_id',$user_id)->whereNull('end_date')->value('user_1_id')) != NULL){
            return redirect()->route('conversation.index');
        }
            
        #Check if someone is looking for the same topic already
        $match=DB::table('conversations')->where('topic_id',$topic_id)->whereNull('start_date')->whereNull('end_date')->whereNull('user_2_id')->value('id');

        #NEW CHAT
        #Not lokking for-> creates a new conversation and goes to waiting room
        if(!$match){
            Conversation::create([
                'user_1_id'=>$user_id,
                'topic_id'=>$topic_id
            ]);

            $number_users_speaking=DB::table('topics')->where('id',$topic_id)->value('number_users_speaking');
            $number_users_speaking=(int)$number_users_speaking + 1;
            $number_users_speaking=DB::table('topics')->where('id',$topic_id)->update(['number_users_speaking'=>$number_users_speaking]);

            $id=DB::table('conversations')->where('user_1_id',$user_id)->whereNull('end_date')->value('id');
            $request->Session()->put('conversation_id', $id);
            
            //event(new Message('username_i_guesss', 'messsage_maybe'));
            
            return redirect()->route('conversation.index');

        #A conver is started and has only one user-> this user joins that conver and goes directly to chat view
        }else{
            $conversation=([
                'user_2_id'=>$user_id,
                'start_date'=>Carbon::now()
            ]);

            DB::table('conversations')->where('id',$match)->update($conversation);
            $id=DB::table('conversations')->where('user_2_id',$user_id)->whereNull('end_date')->value('id');
            $request->Session()->put('conversation_id', $id);


            #Test return
            $number_users_speaking=DB::table('topics')->where('id',$topic_id)->value('number_users_speaking');
            $number_users_speaking=(int)$number_users_speaking + 1;
            $number_users_speaking=DB::table('topics')->where('id',$topic_id)->update(['number_users_speaking'=>$number_users_speaking]);

            #return redirect()->route('index');
            $payload=$id;
            $payload = json_encode($payload);
            $payload = preg_replace("_\\\_", "\\\\\\", $payload);
            $payload = preg_replace("/\"/", "\\\"", $payload);
            return view('conversation.chat')
            ->with('payload', $payload);
        }
    }

    /**
     * Cancel current try of matching or match itself
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public static function cancel(Request $request)
    {
        //Test this
        $finish_conversation=([
            'end_date'=>Carbon::now(),
            'finished'=>1
        ]);

        $topic_id=$request->Session()->get('topic_id');
        $number_users_speaking=DB::table('topics')->where('id',$topic_id)->value('number_users_speaking');
        $number_users_speaking=(int)$number_users_speaking - 1;
        $number_users_speaking=DB::table('topics')->where('id',$topic_id)->update(['number_users_speaking'=>$number_users_speaking]);

        $id=$request->Session()->get('conversation_id');
        DB::table('conversations')->where('id',$id)->update($finish_conversation);
        $request->Session()->put('conversation_id',null);
        return redirect()->route('index');
    }
}
