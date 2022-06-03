<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display the User login page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.login');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.register');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //User data is validated before anything else
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

        //User is created
        User::create($request ->only('name','surname_1','surname_2','email','nickname','password','date_of_birth','pronouns'));

        //The user is notify of the sing in and redirected to log in page
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
        //User data is validated before anything else
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required|max:100|min:8',
        ]);
 
        //Laravel Auth method handles Auth attempts
        if (Auth::attempt($credentials)) {

            //Generate a new token for the Sessions
            $request->session()->regenerate();

            //Check the data
            $id = DB::table('users')->where('email', $credentials['email'])->value('id');

            //Add the User id to the Session
            $request->session()->put('id', $id);
 
            //The user will be redirected to the main page
            return redirect()->route('index');
        }
 
        //If the data doesn't match our records, the user will be notified
        return back()->withErrors([
            'email' => '¡Ups! Las credenciales que has introducido no coinciden con nuetros datos',
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
        //Laravel Auth method handles log outs too
        Auth::logout();
 
        //The actual Session token gets invdalidate
        $request->session()->invalidate();

        //The session token is regerate
        $request->session()->regenerate();
     
        //The user will be redirected to the main page
        return redirect()->route('index');
    }

    /**
     * Display the User profile page.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show_profile()
    {
        //Get the User id
        $id=Session::get('id');

        //Find all User data that matches the $id
        $user = User::find($id);

        //The user will be redirected to the profile view with all the data needed
        return view('user.profile')
            ->with('user',$user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        /**
         * The user will be redirected to register view (is also used for profile editing)
         * with all data needed
         */
        return view('user.register')
            ->with('user',$user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //This function validates all request data one by one due to 'unique' requirement causes conflicts otherwise
        $this->edit_profile($request, $user);
        
        //After validate the data, itś stored into an array
        $validated_data=([
            'name'=>$request->name,
            'surname_1'=>$request->surname_1 ,
            'surname_2'=>$request->surname_2 ,
            'email'=>$request->email ,
            'nickname'=>$request->nickname ,
            'date_of_birth'=>$request->date_of_birth,
            'pronouns'=>$request->pronouns ,
            'password'=>$request->password ,
        ]);

        //The new data is updated in the database
        DB::table('users')->where('id',$user->id)->update($validated_data);

        //The user is notified of the success of the uploading process
        Session::flash('resolution','Perfil actualizado con éxito');

        //The user will be redirected to the profile view
        return redirect()->route('user.show_profile');
    }

    /**
     * Validate all data in the $request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return void
     */

    public function edit_profile(Request $request, User $user) 
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

        if ($request->pronouns != $user->pronouns){
            $request->validate([
                'pronouns'=>'required',
            ]);
        }

        if ($request->password != ''){
            $request->validate([
                'password'=>'required|max:100|min:8|',
            ]);
        } else if($request->password == ''){
            $request->password = $user->password;
        }
    }
}
