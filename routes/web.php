<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('blog.index');
// });
/*
Pengububahan route disesuaikan
dengan kebutuhan, memanggil class
controller dengan @(method)nya
dan as sebagai view folder dan
file blade dihubungkan dengan . (titik)
*/
Route::get('/', [
    'uses'=>'BlogController@index',
    'as'=>'blog',
]);

// Route::get('/blog/show', function(){
//     return view('blog.show');
// });

Route::get('/blog/{post}', [
    'uses'=>'BlogController@show',
    'as'=>'blog.show'
]);

Route::get('/category/{category}', [
    'uses'=>'BlogController@category',
    'as'=>'category'
]);

Route::get('/author/{author}', [
    'uses'=>'BlogController@author',
    'as'=>'author'
]);

//Route otomatis setelah membuat auth
Auth::routes();

Route::get('/home', 'Backend\HomeController@index')->name('home');

// Menambahkan route untuk admin
// Jika menggunakan resource, maka nanti pada pemanggilan
// hanya memanggil blog .create .index .destroy saja
// tanpa memangil backend.blog .crud
Route::resource('/backend/blog', 'Backend\BlogBackController');

// Sudah ada routenya tapi gak mau jalan.
// Pakai dibawah ini, hanya saja masalah lain ada lagi
// Route::resource('/backend/blog', 'Backend\BlogBackController', [
//     'names' => [
//         'create' => 'backend.blog.create'
//     ]
// ]);