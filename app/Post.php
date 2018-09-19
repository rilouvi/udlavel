<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $dates=['published_at'];

    public function author(){
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute($value){
        $images_url = "";
        if( ! is_null($this->images)){
            $imagesPath = public_path() . "/img/" . $this->images;
            if(file_exists($imagesPath)) $images_url = asset("img/" . $this->images);
        }
        return $images_url;
    }

    public function getDateAttribute($value){
        // return $this->created_at->diffForHumans();
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at','desc');
    }

    public function scopePublished($query)
    {
        return $query->where("published_at","<=",Carbon::now());
    }
}
