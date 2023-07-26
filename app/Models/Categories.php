<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'image_url', 'thumb_url'
    ];
    public function categories()
    {

        return $this->belongsTo(CategoryShop::class, 'category_id', 'id');
    }
    /// Count for no of shop providing this service.

    public function serviceProvideByShop()
    {

        return $this->hasMany(CategoryShop::class, 'category_id', 'id');
    }

    public function subCategories()
    {

        return $this->hasMany(SubCategories::class, 'category_id', 'id');
    }

    // public function getImageUrlAttribute()
    // {
    //     return 'https://198.211.99.129/laundry/public' . $this->attributes['image_url'];
    // }
    // public function getThumbUrlAttribute()
    // {

    //     return 'https://198.211.99.129/laundry/public' . $this->attributes['thumb_url'];
    //     // return  env('API_PATH') . $this->attributes['thumb_url'];
    // }
}
