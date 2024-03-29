<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//Allows massive data assignation of Conversation attributes included
class Conversation extends Model
{
    use HasFactory;
    protected $fillable = ['start_date','finished','end_date','user_1_id','user_2_id','topic_id'];
}

