<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia 
{  use InteractsWithMedia;
    protected $fillable=[
        'title',
        'description',
        'budget',
        'status',
        'start_date',
        'end_date',
        'photo'
    ];
     public function comments(){
        return $this->morphTo(Comment::class,'commentable');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image_project')
             ->useDisk('projects')
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
