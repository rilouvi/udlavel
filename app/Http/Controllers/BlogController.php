<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;

class BlogController extends Controller
{
    protected $limit = 3;
    
    public function index(){

        // $categories = Category::with('posts')->orderBy('title','asc')->all();
        //\\Jadi ke Provider Composer//\\
        // $categories = Category::with(['posts' => function($query){
        //     $query->published();
        // }])->orderBy('title','asc')->get();

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
        // return view("blog.index", compact('posts','categories'));

        // view("blog.index", compact('posts'))->render();
        // dd(\DB::getQueryLog());
    }

    public function category(Category $category){

        $categoryName = $category->title;
        // $categories = Category::with('posts')->orderBy('title','asc')->all();
        //\\ Sudah Pindah Ke Provider//\\
        // $categories = Category::with(['posts' => function($query){
        //     $query->published();
        // }])->orderBy('title','asc')->get();

        // $posts = Post::with('author')
        //         ->latestFirst()
        //         ->published()
        //         ->where('category_id', $id)
        //         ->simplePaginate($this->limit);

        //\\Untuk Kategori//\\
        $posts = $category
                ->posts()
                ->with('author')
                ->latestFirst()
                ->published()
                ->simplePaginate($this->limit);
        
        return view("blog.index", compact('posts','categoryName'));
    }

    public function author(User $author){

        $authorName = $author->name;

        //\\Untuk Author//\\
        $posts = $author
                ->posts()
                ->with('category')
                ->latestFirst()
                ->published()
                ->simplePaginate($this->limit);
        
        return view("blog.index", compact('posts','authorName'));
    }

    // public function show($id)
    public function show(Post $post)
    {
        //\\Pindah ke Composer Provider//\\
        // $categories = Category::with(['posts' => function($query){
        //     $query->published();
        // }])->orderBy('title','asc')->get();

        // die("show");
        // $post=Post::findOrFail($id);
        // $post=Post::published()->findOrFail($id);
        //\\Ganti jadi yang bawah karena pindah ke provider//\\
        // return view("blog.show", compact('post','categories'));
        return view("blog.show", compact('post'));
    }
}
