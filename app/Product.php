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

    public function reviews() 
    {
        return $this->hasMany(Review::class);
    }

    public function averrageMark() 
    {
        $marksSum = 0;
        $marksCount = 0;
        foreach ($this->reviews()->get() as $review) {
            $marksSum += $review->mark;
            $marksCount++;
        }
        if ($marksCount > 0)
            return $marksSum / $marksCount;
        return 0;
    }

    public function reviewsCount() 
    {
        return $this->hasMany(Review::class)->count();
    }
}
