<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task_name', 'status', 'date', 'taskgroup_id', 'uesr_id'];
}
