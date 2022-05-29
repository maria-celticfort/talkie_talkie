<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Profiler\Profile;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.register');
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
            'surname_1'=>'required|max:100',
            'surname_2'=>'max:100',
            'email'=>'required|unique:users',
            'nickname'=>'required|max:15|unique:users',
            'password'=>'required|max:100|min:8',
            'date_of_birth'=>'required',
            'pronouns'=>'required',
        ]);

        $user = User::create($request ->only('name','surname_1','surname_2','email','nickname','password','date_of_birth','pronouns'));

        Session::flash('resolution','¡Registrado! Inicia sesión para empezar a charlar');
        return redirect()->route('user.index');
    }

    /**
     * Handle an authentication attempt and log the user in.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required|max:100|min:8',
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $id = DB::table('users')->where('email', $credentials['email'])->value('id');

            $request->session()->put('id', $id);
 
            return redirect()->route('index');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    /**
     * Log the user out of the application
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();

        $request->session()->regenerate();
     
        return redirect()->route('index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show_profile()
    {
        $id=Session::get('id');
        $user = User::find($id);
        return view('user.profile')
            ->with('user',$user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //$id=Session::get('id');
        //$user = User::find($id);
        //return view('user.profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.register')
            ->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->name != $user->name){
            $request->validate([
                'name'=>'required|max:50',
            ]);
        }

        if ($request->surname_1 != $user->surname_1){
            $request->validate([
                'surname_1'=>'required|max:100',
            ]);
        }

        if ($request->surname_2 != $user->surname_2){
            $request->validate([
                'surname_2'=>'max:100',
            ]);
        }

        if ($request->email != $user->email){
            $request->validate([
                'email'=>'required|unique:users',
            ]);
        }

        if ($request->nickname != $user->nickname){
            $request->validate([
                'nickname'=>'required|unique:users',
            ]);
        }

        if ($request->date_of_birth != $user->date_of_birth){
            $request->validate([
                'date_of_birth'=>'required',
            ]);
        }

        if ($request->password != ''){
            $request->validate([
                'password'=>'required|max:100|min:8|',
            ]);
        }else if($request->password == ''){
            $request->password = $user->password;
        }

        $validated_data=([
            'name'=>$request->name,
            'surname_1'=>$request->surname_1 ,
            'surname_2'=>$request->surname_2 ,
            'email'=>$request->email ,
            'nickname'=>$request->nickname ,
            'date_of_birth'=>$request->date_of_birth,
            'password'=>$request->password ,
        ]);

        DB::table('users')->where('id',$user->id)->update($validated_data);

        Session::flash('resolution','Perfil actualizado con éxito');
        return redirect()->route('user.show_profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
