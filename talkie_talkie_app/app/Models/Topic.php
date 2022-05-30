<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Allows massive data assignation of Topics attributes included
class Topic extends Model
{
    use HasFactory;
    protected $fillable = ['name','language'];
}
