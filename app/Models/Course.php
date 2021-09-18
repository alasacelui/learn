<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Course extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    
    protected $fillable = ['title', 'subtitle','description','price', 'instructor', 'category_id'];

    public function registerMediaCollections(): void
    {
        // create a card size image
        $this->addMediaConversion('card')
        ->width(600)
        ->height(600);
    }


    public function image()
    {
        return $this->hasOne(Media::class, 'model_id', 'id');
    }

    public function getImageUrlAttribute()
    {
        return optional($this->image)->getUrl('card');
    }

    public function category()
    {

        return $this->belongsTo(Category::class);
        
    }

}
