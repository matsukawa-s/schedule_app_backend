<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarUser extends Model
{
    protected $filable = ['calendar_id','user_id'];
}
