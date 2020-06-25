<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TaskDescription extends Model
{
  protected $table = 'tasks_description';
  protected $fillable = [
        'tasks_id',
        'user_id',
        'description',
    ];

   
}
