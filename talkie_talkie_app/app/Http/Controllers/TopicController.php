<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
    }

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
        $request->validate([
            'name'=>'required|max:50',
            'language'=>'required',
        ]);

        if(!Session::has('id')){
            Session::flash('log_needed_message','Inicia sesión para poder buscar un tema');    
            return redirect()->route('user.index');  
        }

        $topic_exists = DB::table('topics')->where('name',$request->get('name'))->where('language',$request->get('language'))->value('id');
        if (!$topic_exists){
            Topic::create($request ->only('name','language'));
        }

        $topic_id = DB::table('topics')->where('name', $request['name'])->where('language', $request['language'])->value('id');

        $number_times_searched=DB::table('topics')->where('id',$topic_id)->value('number_times_searched');
        $number_times_searched=(int)$number_times_searched + 1;
        $number_times_searched=DB::table('topics')->where('id',$topic_id)->update(['number_times_searched'=>$number_times_searched]);

        $request->Session()->put('topic_id', $topic_id);
        return redirect()->route('conversation.queue');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        //
    }

}
