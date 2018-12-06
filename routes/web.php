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
//     return view('welcome');
// });
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

//Logout
Route::get('/logout', 'HomeController@logout')->name('logout');
//Home page
Route::get('/home', 'HomeController@index')->name('home');
//Product detail page
Route::get('/product_detail/{product_id}', 'HomeController@product_detail')->name('product_detail');
//User's account information
Route::get('/account_info', 'HomeController@account_info')->name('account_info');
//Campaign page
Route::get('/campaigns/{campaign_id}', 'HomeController@campaigns')->name('campaigns');
Route::get('/campaigns_list/{campaign_id}', 'HomeController@campaigns_list')->name('campaigns_list');

//view all category products page
Route::get('/category/{categoryId}', 'Categories@categories')->name('categories');
Route::get('/category_list/{categoryId}', 'Categories@categories_list')->name('categories_list');
//view filter page
Route::get('/filter', 'Categories@filter')->name('filter');
Route::get('/filter_list', 'Categories@filter_list')->name('filter_list');
//Compare products page
Route::get('/compare_products', 'Categories@compare_products')->name('compare_products');
//Search Items
Route::get('/search_items', 'SearchController@search_items')->name('search_items');
Route::get('/search_items_list', 'SearchController@search_items_list')->name('search_items_list');

//Cart and wishlist
Route::get('/cart', 'Cart_Wishlist@cart')->name('cart');
Route::get('/wishlist', 'Cart_Wishlist@wishlist')->name('wishlist');
Route::get('/checkout', 'Cart_Wishlist@checkout')->name('checkout');

//Other links
Route::get('/blog', 'Other_links@blog')->name('blog');
Route::get('/blog_post', 'Other_links@blog_post')->name('blog_post');
Route::get('/about_us', 'Other_links@about_us')->name('about_us');
Route::get('/site_map', 'Other_links@site_map')->name('site_map');
Route::get('/contact_us', 'Other_links@contact_us')->name('contact_us');
Route::get('/faq', 'Other_links@faq')->name('faq');
Route::get('/orders', 'Other_links@orders')->name('orders');
Route::get('/view_order/{order_id}', 'Other_links@view_order')->name('view_order');

//Ajax Calls
Route::post('response_add_to_cart', 'AjaxController@response_add_to_cart');
Route::post('response_add_to_wishlist', 'AjaxController@response_add_to_wishlist');
Route::post('response_delete_one_item', 'AjaxController@response_delete_one_item');
Route::post('response_clear_cart', 'AjaxController@response_clear_cart');
Route::post('response_search_dropdown', 'AjaxController@response_search_dropdown');
Route::post('response_delete_one_item_wishlist', 'AjaxController@response_delete_one_item_wishlist');
Route::post('clear_wishlist', 'AjaxController@clear_wishlist');
Route::post('set_filter_cookie', 'AjaxController@set_filter_cookie');
Route::post('response_get_quickView_data', 'AjaxController@response_get_quickView_data');
Route::post('resonse_deactivate_subscription', 'AjaxController@resonse_deactivate_subscription');
Route::post('resonse_compare_products', 'AjaxController@compare_products');
Route::post('response_update_cart', 'AjaxController@response_update_cart');
Route::post('resonse_proceed_to_checkout', 'AjaxController@resonse_proceed_to_checkout');
Route::post('resonse_place_order', 'AjaxController@resonse_place_order');

//Newsletter subscription 
Route::post('newsletter', 'HomeController@newsletter');
//Search item's FORM
Route::post('search_items', 'SearchController@search_items');
Route::post('add_update_review', 'HomeController@add_update_review');
Route::post('only_update_review', 'HomeController@only_update_review');
Route::post('contact_info', 'FormsController@contact_info');
Route::post('billing_address', 'FormsController@billing_address');
Route::post('manage_address', 'FormsController@manage_address');
Route::post('save_address_checkout', 'FormsController@save_address_checkout');
Route::post('place_order', 'FormsController@place_order');
Route::post('contact', 'FormsController@contact');
