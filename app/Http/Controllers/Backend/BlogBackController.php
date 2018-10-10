<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

// Gunakan Model Post
use App\Post;

// class BlogBackCont extends Controller
// Diubah menjadi dibawah ini karena class Controller harus ber

class BlogBackController extends BackController
{
    protected $limit=5;

    protected $uploadPath;
    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('img');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Menampilkan blog backend
        // $posts=Post::all();
        // $posts=Post::latest()->paginate($this->limit);
        $posts=Post::with('category','author')->latest()->paginate($this->limit);
        $postCount = Post::count();
        return view("backend.blog.index",compact('posts','postCount'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('backend.blog.create',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    // public function store(Request $request)
    // Ubah karena ada postrequest

    public function store(Requests\PostRequest $request)
    {
        // Pindah ke request
        // $this->validate($request,[
        //     'title'=>'required',
        //     'slug'=>'rewuired|unique:posts',
        //     'body'=>'required',
        //     'published_at'=>'date_format:Y-m-d H:i:s',
        //     'category_id'=>'required'
        // ]);
        // $request->user()->posts()->create($request->all());
        $data = $this->handleRequest($request);
        $request->user()->posts()->create($data);
        return redirect('/backend/blog')->with('message','Your Post Created Successfully');
    }
    private function handleRequest($request)
    {
        $data = $request->all();
        if ($request->hasFile('images')) {
            $image=$request->file('images');
            $fileName=$image->getClientOriginalName();
            $destination=$this->uploadPath;
            $image->move($destination, $fileName);
            $data['images']=$fileName;
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
