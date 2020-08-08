<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'code', 'description', 'image', 'category_id'];

    public function categories() 
    {
        return $this->belongsToMany(Category::class);
    }

    public function reviews() 
    {
        return $this->hasMany(Review::class);
    }

    public function averageMark() 
    {
        return DB::table('reviews')
            ->select(DB::raw('round(avg(mark), 2) as average_mark'))
            ->where('product_id', '=', $this->id)
            ->first()
            ->average_mark;
    }

    public function reviewsCount() 
    {
        return $this->hasMany(Review::class)->count();
    }
}
