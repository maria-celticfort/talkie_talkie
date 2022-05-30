<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticable;

//Allows massive data assignation of User attributes included
class User extends Authenticable{
    use HasFactory;
    protected $fillable = ['name','surname_1','surname_2','email','nickname','password','date_of_birth','pronouns'];

    /**
     * Encrypt the password
     *
     * @return string
     */
    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }
}
