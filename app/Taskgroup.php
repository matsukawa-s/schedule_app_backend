<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taskgroup extends Model
{
    protected $fillable = ['taskgroup_name', 'color', 'calendar_id'];
}
