<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;

class Post extends Model
{
    //\\Update post view_count Cara Pertama//\\
    protected $fillable=['view_count'];

    protected $dates=['published_at'];

    public function author(){
        return $this->belongsTo(User::class);
    }
    //\\ Pada Video 017 ADD CATEGORY //\\
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function getImageUrlAttribute($value){
        $images_url = "";
        if( ! is_null($this->images)){
            $imagesPath = public_path() . "/img/" . $this->images;
            if(file_exists($imagesPath)) $images_url = asset("img/" . $this->images);
        }
        return $images_url;
    }

    public function getImageThumbUrlAttribute($value){
        $images_url = "";
        if( ! is_null($this->images)){
            $ext = substr(strrchr($this->images, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->images);
            $imagesPath = public_path() . "/img/" . $thumbnail;
            if(file_exists($imagesPath)) $images_url = asset("img/" . $thumbnail);
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

    //\\Method untuk Admin//\\
    // Method untuk mengganti format tanggal
    public function dateFormatted($showTimes = false)
    {
        $format = "d/m/Y";
        if($showTimes) $format = $format . "H:i:s";
        return $this->created_at->format($format);
    }

    public function publicationLabel()
    {
        if (! $this->published_at) {
            return '<span class="label label-warning">Draft</span>';
        }
        elseif ($this->published_at && $this->published_at->isFuture()) {
            return '<span class="label label-info">Schedule</span>';
        }
        else {
            return '<span class="label label-success">Published</span>';
        }
    }
    //\\END Method untuk Admin//\\

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at','desc');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count','desc');
    }

    public function scopePublished($query)
    {
        return $query->where("published_at","<=",Carbon::now());
    }
}
