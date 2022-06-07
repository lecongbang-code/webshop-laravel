<?php

use Illuminate\Support\Facades\Route;


// User
// Start UserController
Route::get('/','UserController@index');
Route::get('/home','UserController@index');

// Search
Route::get('/search/super-discount','UserController@menuSearchSuperDiscount');
Route::get('/search/list-product-discount-code','UserController@menuSearchDiscountCode');
Route::get('/search-category/{paramater}','UserController@categorySearch');
Route::get('/search-category-all','UserController@categorySearchAll');
Route::post('/search-product','UserController@productSearch');

// Load More
Route::post('/load-more-product','UserController@loadMoreProduct');
Route::post('/load-more-product2','UserController@loadMoreProductCategory');
Route::post('/load-more-product3','UserController@loadMoreProductAllCategory');
Route::post('/load-more-category-product','UserController@loadMoreCategoryProduct');
Route::post('/load-more-product-discount-code','UserController@loadMoreProductDiscountCode');
Route::post('/load-more-product-search','UserController@loadMoreProductSearch');

// End UserController

// -----------------------------------------

// Admin
// Start AdminController
Route::get('/admin','AdminController@admin');
Route::get('/admin-login','AdminController@adminLogin');

// Route::get('/admin-signup','AdminController@adminSignup');

Route::post('/post-admin-login','AdminController@postAdminLogin');
// Route::post('/post-admin-signup','AdminController@postAdminSignup');

Route::get('/admin-logout','AdminController@logOut');


// End AdminController

// Start CategoryController
Route::get('/list-category','CategoryController@listCategory');
Route::get('/add-category','CategoryController@addCategory');
Route::get('/edit-category/{id}','CategoryController@editCategory');

Route::get('/delete-category/{id}','CategoryController@deleteCategory');
Route::get('/unactive-category/{id}','CategoryController@unactiveCategory');
Route::get('/active-category/{id}','CategoryController@activeCategory');
// Post
Route::post('/post-add-category','CategoryController@postAddCategory');
Route::post('/update-category/{id}','CategoryController@updateCategory');
// End CategoryController

// Start ProductController
Route::get('/list-product','ProductController@listProduct');
Route::get('/add-product','ProductController@addProduct');
Route::get('/edit-product/{id}','ProductController@editProduct');
Route::get('/delete-product/{id}','ProductController@deleteProduct');

Route::get('/unactive-product/{id}','ProductController@unactiveProduct');
Route::get('/active-product/{id}','ProductController@activeProduct');

Route::get('/unactive-product-adv/{id}','ProductController@unactiveProductAdv');
Route::get('/active-product-adv/{id}','ProductController@activeProductAdv');
//Post
Route::post('/post-add-product','ProductController@postAddProduct');
Route::post('/update-product/{id}','ProductController@updateProduct');

// End ProductController

// Start BannerController
Route::get('/list-banner','BannerController@listBanner');
Route::get('/add-banner','BannerController@addBanner');
Route::get('/delete-banner','BannerController@deleteBanner');
Route::get('/unactive-product-adv-in/{id}','BannerController@unactiveProductAdv');

Route::get('/unactive-product-in/{id}','BannerController@unactiveProduct');
Route::get('/active-product-in/{id}','BannerController@activeProduct');
Route::get('/delete-product-in/{id}','BannerController@deleteProduct');


// End BannerController

// Start EventController

Route::get('/list-event','EventController@listEvent');
Route::get('/add-event','EventController@addEvent');
Route::get('/edit-event/{id}','EventController@editEvent');
Route::get('/delete-event/{id}','EventController@deleteEvent');

Route::get('/unactive-event/{id}','EventController@unactiveEvent');
Route::get('/active-event/{id}','EventController@activeEvent');

//Post
Route::post('/post-add-event','EventController@postAddEvent');
Route::post('/update-event/{id}','EventController@updateEvent');

// End EventController