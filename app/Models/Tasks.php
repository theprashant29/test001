<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'sub_id',
        'user_id',
        'option1',
        'option2',
        'option3'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subCategories()
    {
        return $this->hasMany(SubCategories::class, 'id', 'sub_id');
    }

   
    
}


