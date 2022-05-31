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
    /**
     * Check that there is a Session with an User authenticated
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Send the User to the 'Wait Room'
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('conversation.load');
    }

    /**
     * Call the ChatEvent to send a message
     *
     * @return void
     */
    public function send_message(Request $request)
    {
        //Get Auth User data
        $user = User::find(Auth::id());

        //Get conversation id
        $conversation_id = Session::get('conversation_id');
        
        //Calls the event ChatEvent
        event(new ChatEvent($request->message, $user, $conversation_id));
    }

    /**
     * Try to match to users looking for the same Topic
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function add_to_queue(Request $request)
    {
        #Get User id and Topic id
        $user_id=Session::get('id');
        $topic_id=Session::get('topic_id');

        #WHEN THE USER IS ALREADY IN THE WAIT ROOM
        #If user_1_id already has a conversation and other person joins that conversation, the user_1_id will be redirected to chat view
        if (DB::table('conversations')->where('user_1_id',$user_id)->whereNull('end_date')->value('user_2_id') != NULL ){
            //Get Conversation id
            $conversation_id = Session::get('conversation_id');
            
            //Get all Conversation data
            $conversation=Conversation::find($conversation_id);

            //Create payload with the Conversation id 
            $payload=$this->create_payload($conversation_id);

            //Get data from the User we're matched to
            $user_data = DB::table('users')
                ->join('conversations', 'users.id','=','conversations.user_2_id')
                ->where('conversations.id',$conversation_id)
                ->select('users.name','users.pronouns','users.id')
                ->get();

            //The User will be redirected to the chat view with the payload
            return view('conversation.chat')
            ->with('payload', $payload )
            ->with('user_2_data' ,$user_data[0]);
        }

        #If the conversation exists but no one joined yet, just keep waiting
        if ((DB::table('conversations')->where('user_1_id',$user_id)->whereNull('end_date')->value('user_1_id')) != NULL){
            //The User will stay in the Wait Room
            return redirect()->route('conversation.index');
        }
        
        
        #WHEN THE USER IS NOT IN THE WAIT ROOM

        #Check if someone is looking for the same topic already
        $match=DB::table('conversations')->where('topic_id',$topic_id)->whereNull('start_date')->whereNull('end_date')->whereNull('user_2_id')->value('id');

        #If no one is loking for the same; create a new conversation and the user will be redirected to the Wait Room
        if(!$match){
            //Create a new Conversation with the values of 'user_1_id' and 'topic_id'
            Conversation::create([
                'user_1_id'=>$user_id,
                'topic_id'=>$topic_id
            ]);

            //Call function to substract one from 'number_users_speaking' that topic
            $this->add_number_users_speaking($topic_id);

            //Get new Conversation id and save it in Session
            $conversation_id=DB::table('conversations')->where('user_1_id',$user_id)->whereNull('end_date')->value('id');
            $request->Session()->put('conversation_id', $conversation_id);
            
            //The user will be redirected to the Wait Room
            return redirect()->route('conversation.index');

        #A conversation is started and has only one user, the user  will join it and they'll go to chat view directly
        }else{
            //Get new data for the Conversation
            $conversation=([
                'user_2_id'=>$user_id,
                'start_date'=>Carbon::now()
            ]);

            //Update the Conversation with the new data
            DB::table('conversations')->where('id',$match)->update($conversation);

            //Get the Conversation id and save it in Session
            $conversation_id=DB::table('conversations')->where('user_2_id',$user_id)->whereNull('end_date')->value('id');
            $request->Session()->put('conversation_id', $conversation_id);
            
            //Call function to substract one from 'number_users_speaking' that topic
            $this->add_number_users_speaking($topic_id);

            //Get data from the User we're matched to
            $user_data = DB::table('users')
                ->join('conversations', 'users.id','=','conversations.user_1_id')
                ->where('conversations.id',$conversation_id)
                ->select('users.name','users.pronouns','users.id')
                ->get();

            //Create payload with the Conversation id 
            $payload=$this->create_payload($conversation_id);

            //The user will be redirected to the chat view
            return view('conversation.chat')
            ->with('payload', $payload)
            ->with('user_1_data' ,$user_data[0]);
        }
    }

    /**
     * Cancel current try of matching or the conversation itself
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function cancel(Request $request)
    {
        //Data added when a conversations is finished
        $finish_conversation=([
            'end_date'=>Carbon::now(),
            'finished'=>1
        ]);

        //Get Topic id
        $topic_id=$request->Session()->get('topic_id');

        //Call function to substract one from 'number_users_speaking' that topic
        $this->substract_number_users_speaking($topic_id);

        //The conversation is updated with '$finish_conversation' data
        $id=$request->Session()->get('conversation_id');
        DB::table('conversations')->where('id',$id)->update($finish_conversation);

        //Conversation id in Session is set to null to avoid conflicts
        $request->Session()->put('conversation_id',null);

        //The user will be redirected to 
        return redirect()->route('index');
    }

    /**
     * Subtract 1 to the 'number_of_users_speaking'
     * 
     * @param int $topic_id
     * @return void
     */
    public function substract_number_users_speaking($topic_id) {
        $number_users_speaking=DB::table('topics')->where('id',$topic_id)->value('number_users_speaking');
        $number_users_speaking=(int)$number_users_speaking - 1;
        $number_users_speaking=DB::table('topics')->where('id',$topic_id)->update(['number_users_speaking'=>$number_users_speaking]);
    }

    /**
     * Add 1 to the 'number_of_users_speaking'
     * 
     * @param int $topic_id
     * @return void
     */
    public function add_number_users_speaking($topic_id) {
        $number_users_speaking=DB::table('topics')->where('id',$topic_id)->value('number_users_speaking');
        $number_users_speaking=(int)$number_users_speaking + 1;
        $number_users_speaking=DB::table('topics')->where('id',$topic_id)->update(['number_users_speaking'=>$number_users_speaking]);
    }

    /**
     * Add 1 to the 'number_of_users_speaking'
     * 
     * @param int $conversation_id
     * @return $payload
     */
    public function create_payload($conversation_id){
        $payload=$conversation_id;
        $payload = json_encode($payload);
        $payload = preg_replace("_\\\_", "\\\\\\", $payload);
        $payload = preg_replace("/\"/", "\\\"", $payload);
        return $payload;
    }
}
