<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;

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

    public function getBodyHtmlAttribute($value)
    {
        // return Markdown::convertToHtml(e($this->body));
        return $this->body ? Markdown::convertToHtml(e($this->body)) : NULL;
    }

    public function getExcerptHtmlAttribute($value)
    {
        // return Markdown::convertToHtml(e($this->excerpt));
        return $this->excerpt ? Markdown::convertToHtml(e($this->excerpt)) : NULL;
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
