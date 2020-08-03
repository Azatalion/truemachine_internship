<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['text', 'mark', 'user_name', 'product_id'];

    public function product() 
    {
        return $this->belongsTo(Product::class);
    }
}
