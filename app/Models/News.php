<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class News extends Model implements HasMedia 
{  use InteractsWithMedia;
    protected $fillable=[
        'title',
        'details',
        'user_id',
        'photo'
    ];
    protected $attributes = [
    'user_id' => 1, // Default user_id, can be set to null or any default value you prefer
];

     public function comments(){
        return $this->morphTo(Comment::class,'commentable');
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image_news')
             ->useDisk('news')
             ->registerMediaConversions(function(Media $media){
             $this->addMediaConversion('thumb1')
             ->width(100)
             ->height(100)
             ->queued();
             
             
             });
            // $this->addMediaCollection('logo')
            //  ->useDisk('public');
            
            
    }
}
