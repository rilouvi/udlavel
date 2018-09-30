<?php

// namespace App\Http\Controllers;
// \\ Diubah menyesuaikan foldernya //\\
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

// class HomeController extends Controller
// Diubah menjadi dibawah ini karena class Controller harus ber

class HomeController extends BackController
{
    // Dipindah ke BackCOntroller
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
