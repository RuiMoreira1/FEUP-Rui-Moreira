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
// Home

Route::get('/', 'HomeController@show');
Route::get('/products/HarryPotter', 'HomeController@harry_potter');
Route::get('/about', function() { return view('pages.about'); })->name('about');
Route::get('/contact', function() { return view('pages.contact'); })->name('contact');
Route::get('/faq', 'FaqController@index')->name('faq');

//Route::get('/editOrder', function() { return view('pages.editOrder'); })->name('editOrder');

Route::get('/editUser', function() { return view('pages.editUser'); })->name('editUser');
Route::get('/editFAQ', function() { return view('pages.editFAQ'); })->name('editFAQ');
Route::get('/editOrder', function() { return view('pages.editOrder'); })->name('editOrder');
Route::get('/banUser/{id}', 'UserController@banUserPage');
Route::post('/banUser/ban/{id}','UserController@ban');
Route::post('/banProd/{id}/{prodId}','UserController@banProduct');
Route::delete('/unBan/{id}','UserController@unBan');
Route::delete('/deleteUser/{id}','UserController@deleteUser');


Route::get('/login', 'Auth\LoginController@home');

Route::get('/404', function() { return view('pages.404'); });

//admin
Route::get('/admin', function() { return view('pages.admin'); })->name('admin');
Route::get('/admin', 'AdminController@index');
Route::get('/addProduct', function() { return view('pages.addProduct'); });
Route::get('/bannedUser', function() { return view('pages.bannedUser'); });
Route::get('/newProduct', function() { return view('pages.addProduct'); })->name('newProduct');
Route::post('/newProduct', 'ProductController@store');
Route::get('/editProduct/{id}', 'AdminController@find');
Route::delete('/deleteProduct/{id}','ProductController@destroy')->name('deleteProduct');
Route::put('/editProduct/edit/{id}','ProductController@update');
Route::get('/editFaq/{id}', 'FaqController@find');
Route::delete('/deleteFaq/{id}','FaqController@destroy');
Route::put('/editFaq/edit/{id}','FaqController@update');
Route::post('/newFaq', 'FaqController@store')->name('newFaq');;
Route::get('/addFaq', function() { return view('pages.addFaq'); });

// products
Route::get('/products', function () { return view('pages.search'); })->name('search');
Route::get('/product/{id}', 'ProductController@index');
Route::get('/products', 'SearchController@index');
Route::delete('/products', 'SearchController@search')->name('search');
Route::post('/products', 'SearchController@search')->name('search');
Route::post('/review/{id}', 'ReviewController@store');
Route::put('/product/{id}/{prod_id}','ReviewController@update');
Route::delete('/rev/{id}/{id_prod}','ReviewController@destroy');
Route::post('/addCart/{id_prod}','CartController@store');
Route::delete('/cart/{id_prod}', 'CartController@destroy');


Route::get('/cart', 'CartController@index')->name('cart');

//Wishlist
Route::get('/wishlist', 'WishlistController@show')->name('wishlist');
Route::post('/product/{id}/add_to_wishlist', 'WishlistController@add_product');
Route::post('/wishlist/add_to_cart/{id_prod}', 'WishlistController@add_to_cart');
Route::post('/wishlist/remove_product/{id_prod}','WishlistController@remove_prod');



Route::get('/users/{id}', 'UserController@show');


Route::get('/login', 'Auth\LoginController@home');

// Cards
Route::get('cards', 'CardController@list');
Route::get('cards/{id}', 'CardController@show');
Route::get('products/{id}','CardController@show');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
