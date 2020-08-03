<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'title', 'all_day', 'start_date','end_date',
        'repetition_flag','repetition','notification_flag',
        'notification','color','place','url','memo','calendar_id'
    ];
}
