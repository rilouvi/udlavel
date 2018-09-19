<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    protected $limit = 3;
    public function index(){
        //\\Untuk cek Query//\\
        // \DB::enableQueryLog();
        // $posts = Post::all();
        // $posts = Post::with('author')->orderBy('created_at','desc')->get();
        // $posts = Post::with('author')->latest()->get();
        // $posts = Post::with('author')->latestFirst()->get();
        //\\Untuk pagination beberapa cara//\\
        // $posts = Post::with('author')->latestFirst()->paginate(3);
        // $posts = Post::with('author')->latestFirst()->simplePaginate(3);
        // $posts = Post::with('author')->latestFirst()->simplePaginate($this->limit);
        //\\Menggunakan Method//\\
        $posts = Post::with('author')
                ->latestFirst()
                ->published()
                ->simplePaginate($this->limit);
        return view("blog.index", compact('posts'));
        // view("blog.index", compact('posts'))->render();
        // dd(\DB::getQueryLog());
    }

    // public function show($id)
    public function show(Post $post)
    {
        // die("show");
        // $post=Post::findOrFail($id);
        // $post=Post::published()->findOrFail($id);
        return view("blog.show", compact('post'));
    }
}
