<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarExtension extends Model
{
    protected $table = 'calendar_extension';
    
    protected $fillable = ['calendar_id','extension_id'];
}
