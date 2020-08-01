<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'code', 'description', 'image', 'category_id'];

    public function categories() 
    {
        return $this->belongsToMany(Category::class);
    }
}
