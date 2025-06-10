<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    protected $fillable= [
        'name',
        'category_id',
    ];

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
