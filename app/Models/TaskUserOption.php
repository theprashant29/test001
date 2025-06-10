<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskUserOption extends Model
{
    protected $fillable = ['task_id', 'user_id', 'option'];

    public function task()
    {
        return $this->belongsTo(Tasks::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
