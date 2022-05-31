<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class TopicController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //User must be loged in to search for a topic
        if(!Session::has('id')){
            Session::flash('log_needed_message','Inicia sesión para poder buscar un tema');    
            return redirect()->route('user.index');  
        }

        //Topic data is validated before anything else
        $request->validate([
            'name'=>'required|max:50',
            'language'=>'required',
        ]);

        //If the Topic doesn't exist in the language choosen by the user, it will be created
        $topic_exists = DB::table('topics')->where('name',$request->get('name'))->where('language',$request->get('language'))->value('id');
        if (!$topic_exists){
            Topic::create($request ->only('name','language'));
        }

        //We recuperate the id in DB of the Topic searcheed.
        $topic_id = DB::table('topics')->where('name', $request['name'])->where('language', $request['language'])->value('id');

        //Add a 'number_times_searched more'
        $this->times_searched($topic_id);

        //Set the Topic id in the Session
        $request->Session()->put('topic_id', $topic_id);

        //Return user to the 'Wait Room'
        return redirect()->route('conversation.queue');
    }

    /**
     * Add +1 to 'number_times_searched', every time a topic is searched in a certain language
     * 
     * @param int $topic_id
     * @return void
     */
    public function times_searched($topic_id){
        $number_times_searched=DB::table('topics')->where('id',$topic_id)->value('number_times_searched');
        $number_times_searched=(int)$number_times_searched + 1;
        $number_times_searched=DB::table('topics')->where('id',$topic_id)->update(['number_times_searched'=>$number_times_searched]);
    }

}
