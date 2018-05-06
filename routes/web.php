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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/book/{bookid}',[
    'uses'=>"HomeController@bookinfo",
    'as'=>"bookinfo"
]);

Route::get('/author/{authorid}',[
    'uses'=>"HomeController@authorinfo",
    'as'=>"authorinfo"
]);

Route::post('/borrow/', [
    'uses'=>"HomeController@borrowBook",
    'as'=>"borrow"
])->middleware("auth");

Route::post('/returnbook',[
    'uses'=>"HomeController@returnbook",
    "as"=>"returnbook"
])->middleware("auth");

Route::get('/category/{categoryName}',[
    'uses'=>"HomeController@booksFromCategory",
    "as"=>"category"
]);

Route::get('/categories',[
    'uses'=>"HomeController@categories",
    'as'=>"categories"
]);

Route::get('/search',[
    'uses'=>"HomeController@search",
    "as"=>"search"
]);

Route::get('/search/{searchType}/{searchField}',[
    'uses'=>"HomeController@searchResults",
    "as"=>"searchResults"
]);

Route::get('/user/history',[
    'uses'=>"UserController@displayUserLogs",
    "as"=>"user.logs"
])->middleware("auth");

Route::get('/user/fines',[
    'uses'=>"UserController@displayFines",
    "as"=>"user.fines"
])->middleware("auth");

Route::post("/user/payfines",[
    'uses'=>"UserController@payFines",
    'as'=>"user.payfines"
]);

Route::get("/admin",[
    'uses'=>"AdminController@index",
    'as'=>"admin.index"
]);

Route::get("/admin/newbook",[
    'uses'=>"AdminController@newbook",
    'as'=>"admin.newbook"
]);

Route::post("/admin/editbook",[
    'uses'=>"AdminController@editbook",
    'as'=>"admin.editbook"
]);

Route::post("/admin/savebook",[
    'uses'=>"AdminController@saveBook",
    "as"=>"admin.saveBook"
]);

Route::get("/admin/addauthor",[
    'uses'=>"AdminController@addauthor",
    "as"=>"admin.addauthor"
]);

Route::post("/admin/saveauthor",[
    "uses"=>"AdminController@saveauthor",
    "as"=>"admin.saveauthor"
]);

Route::post("/admin/addcopy",[
    "uses"=>"AdminController@addcopy",
    "as"=>"admin.addcopy"
]);

Route::post("/admin/savecopy",[
    "uses"=>"AdminController@savecopy",
    "as"=>"admin.savecopy"
]);

Route::get("/admin/addcategory",[
    "uses"=>"AdminController@addcategory",
    "as"=>"admin.addcategory"
]);

Route::post("/admin/savecategory",[
    "uses"=>"AdminController@savecategory",
    "as"=>"admin.savecategory"
]);

Route::post("/admin/assignCategory",[
    'uses'=>"AdminController@bookcategory",
    "as"=>"admin.bookcategory"
]);

Route::post("/admin/saveCategory",[
    "uses"=>"AdminController@savebookcategory",
    "as"=>"admin.savebookcategory"
]);