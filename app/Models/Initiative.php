<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Initiative extends Model implements HasMedia
{
     use InteractsWithMedia;

    //protected $table='intiatives';
    protected $fillable=[
        'title',
        'description',
        'start_at',
        'end_data',
        'target_amount',
        'current_amount',
        'status',
        'user_id',
        'photo'
    ];
    public function comments(){
        return $this->morphTo(Comment::class,'commentable');
    }
     public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image_initaitive')
             ->useDisk('initaitives')
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
