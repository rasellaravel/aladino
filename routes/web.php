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
//     return view('front-end.myhome');
// });
// Route::get('/test', function () {
//     return view('product.test');
// });

Auth::routes();
Route::get('/', 'AladinouserController@index');
Route::get('/home', 'HomeController@index')->name('home');
//edit user profile
Route::get('/edit-profile', 'HomeController@editProfile')->name('edit_profile');
Route::post('user-profile-update', 'HomeController@updateProfile');

//profile picture upload
Route::get('image-crop', 'HomeController@imageCrop');
Route::post('image-crop', 'HomeController@imageCropPost');
Route::get('create-shop', 'HomeController@createShop');
Route::get('shop', 'HomeController@shop');
Route::post('check_shopname', 'HomeController@checkShopeName');
Route::post('shop-store', 'HomeController@ShopStore');
Route::get('create-product', 'HomeController@createProduct');
Route::post('get-sub-category','HomeController@getSubCategory');
Route::post('get-tri_sub-category','HomeController@getTriSubCategory');
Route::post('store-user-product','HomeController@StoreUserProduct');

// Route::get('api-test','AladinouserController@index');
// Route::get('test2','AladinouserController@test2');



Route::get('/admin', 'AdminController@index')->name('admin');

Route::prefix('admin')->group(function(){
	// admin login
	Route::get('login','Auth\AdminLoginController@showLoginForm');
	Route::post('login','Auth\AdminLoginController@login')->name('admin-login');
	Route::post('logout','Auth\AdminLoginController@logout')->name('admin-logout');

	//admin menu
	
	Route::get('menu-category','Admin\Menu\MenuController@menuCategory');
	Route::post('menu-category-store','Admin\Menu\MenuController@menuCategoryStore');
	Route::get('menu-category-edit/{id}','Admin\Menu\MenuController@menuCategoryEdit');
	Route::post('menu-category-update','Admin\Menu\MenuController@menuCategoryUpdate');
	Route::get('menu-category-delete/{id}','Admin\Menu\MenuController@menuCategoryDelete');

	Route::get('menu-sub-category','Admin\Menu\MenuController@menuSubCategory');
	Route::post('menu-sub-category-store','Admin\Menu\MenuController@menuSubCategoryStore');
	Route::get('menu-sub-category-edit/{id}/{cat_id}','Admin\Menu\MenuController@menuSubCategoryEdit');
	Route::post('menu-sub-category-update','Admin\Menu\MenuController@menuSubCategoryUpdate');
	Route::get('menu-sub-category-delete/{id}','Admin\Menu\MenuController@menuSubCategoryDelete');



	Route::get('menu-tri-sub-category','Admin\Menu\MenuController@menuTriSubCategory');
	Route::get('menu-tri-sub-category-edit/{tri_id}/{sub_id}/{cat_id}','Admin\Menu\MenuController@menuTriSubCategoryEdit');
	Route::post('menu-tri-sub-category-update','Admin\Menu\MenuController@menuTriSubCategoryUpdate');
	Route::get('menu-tri-sub-category-delete/{id}','Admin\Menu\MenuController@menuTriSubCategoryDelete');

	Route::post('get-sub-category','Admin\Menu\MenuController@getSubCategory');

	Route::post('menu-tri-sub-category-store','Admin\Menu\MenuController@menuTriSubCategoryStore');

	Route::get('menu-forth-sub-category','Admin\Menu\MenuController@menuForthSubCategory');
    Route::get('menu-forth-sub-category-delete/{id}','Admin\Menu\MenuController@menuForthSubCategoryDelete');





	Route::post('get-tri_sub-category','Admin\Menu\MenuController@getTriSubCategory');

	Route::post('menu-forth-sub-category-store','Admin\Menu\MenuController@menuForthSubCategoryStore');

	Route::get('menu-forth-sub-category-edit/{cat_id}/{sub_id}/{tri_id}/{forth_id}','Admin\Menu\MenuController@menuForthSubCategoryEdit');
	Route::post('menu-forth-sub-category-update','Admin\Menu\MenuController@menuForthSubCategoryUpdate');

}); 


Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');


// Route::get('myhome', 'AladinouserController@index');

Route::get('aladino-home', 'AladinouserController@aladinoHome');

Route::get('aladino-product', 'AladinouserController@aladinoProduct');
Route::get('aladino-product-details', 'AladinouserController@aladinoProductDetails');


// new



Route::get('user_create_shop', 'users\ShopController@createShop');
Route::post('user_create_shop_update', 'users\ShopController@createShopUpdate');

Route::get('user_add_product', 'users\ShopController@addProduct');
Route::post('store-primary-product', 'users\ShopController@storePrimaryProduct');
Route::post('dataTest', 'users\ShopController@dataTest');
Route::post('colorStore', 'users\ShopController@storeProductColor');
Route::post('sizeStore', 'users\ShopController@storeProductSize');
Route::post('productDetailsStore', 'users\ShopController@storeProductDetails');

//


Route::get('/', 'users\ShopController@home')->name('aladino_home');
Route::get('product_view/{id}', 'users\ShopController@productView');
Route::get('user_shop', 'users\ShopController@userShop');
Route::get('user_product/{id}', 'users\ShopController@userProduct');



Route::get('new_create_product', 'users\ShopController@newCreateProduct');
Route::post('add-data', 'users\ShopController@allData');

Route::get('shop-public-profile/{id}', 'users\ShopController@shopPublicProfile');

Route::get('user_profile', 'users\ShopController@userProfile');


Route::get('user_dashboardd', 'users\ShopController@getUserDashboard');
Route::get('personal_profile_update', 'users\ShopController@personalProfileUpdate');
Route::post('personalProfileUpdate', 'users\ShopController@personalProfileUpdateToDB');
Route::post('change_profile_picture
', 'users\ShopController@changeProfilePicute');

Route::get('product_listin
', 'users\ShopController@productListing');

Route::post('check_shop_name', 'users\ShopController@checkShopName');

Route::get('user_single_product/{id}
', 'users\ShopController@getUserSingleProduct');

Route::get('edit_listing/{id}
', 'users\ShopController@editListing');


Route::get('get_sub_category_getmethod/{id}
', 'users\ShopController@getSubCategoryGetMethod');
Route::post('delete_different_color
', 'users\ShopController@deleteDifferentColor');

Route::post('delete_same_color
', 'users\ShopController@deleteSameColor');

Route::post('listing_update
', 'users\ShopController@listingUpdate');

Route::post('delete_shop_profile_image
', 'users\ShopController@DeleteShopProfileImage');
Route::post('delete_shop_banner_image
', 'users\ShopController@DeleteShopBannerImage');
Route::post('delete_shop_carousels_image
', 'users\ShopController@DeleteShopcarouselsImage');

Route::post('view_shop_product_by_category', 'users\ShopController@viewShopProductByCategory');
Route::post('public_shop_product_filter', 'users\ShopController@publicShopProductFilter');

//add to cart
Route::post('add_to_cart', 'users\ShopController@AddToCart');
Route::get('cart', 'users\ShopController@Cart');

Route::post('remove_cart_item', 'users\ShopController@removeCartItem');
Route::post('update_item', 'users\ShopController@upateCartItem');
Route::get('inifital_buying_info', 'users\ShopController@initialBuyingInfo')->name('inifital_buying_info');

//after registration
Route::post('save_user_info', 'users\ShopController@saveUserInfo');
Route::get('checkout', 'users\ShopController@checkout');
Route::post('add_differect_shipping_address', 'users\ShopController@AddDifferentShippingAddress');
Route::post('shipping_selected_address','users\ShopController@shippingSelectedAddress');
Route::post('buying_shipping_add_edit', 'users\ShopController@byingShippingAddressEdit');
Route::post('edit_differect_shipping_address', 'users\ShopController@editDifferentShippingAddress');


// stripe

// Route::get('addmoney/stripe', array('as' => 'addmoney.paywithstripe','uses' => 'AddMoneyController@payWithStripe'));
// Route::post('addmoney/stripe', array('as' => 'addmoney.stripe','uses' => 'AddMoneyController@postPaymentWithStripe'));
Route::get('gotoPayment','users\ShopController@Stripe')->name('gotoPayment');
Route::post('payment','users\ShopController@Payment');

Route::post('goForPayment','users\ShopController@goForPayment');

Route::get('user/buyed','users\ShopController@buyed');
Route::get('user/buy/view/{order_id}','users\ShopController@buyedProductView');
Route::get('user/product/selling','users\ShopController@productSelling');
Route::get('user/product/selling/view/{order_id}','users\ShopController@viewProductSelling');
Route::get('user/earning','users\ShopController@earning');

// create new tracking code and update tracking 
Route::post('user/selling/add/tracking','users\ShopController@addUpdateTracking');
Route::get('user/couriers/all','users\ShopController@allCouriers');
Route::post('user/couriers/orderid/set','users\ShopController@orderIdSet');
Route::get('user/product/shipping/checkpoint/{code}/{slug}','users\ShopController@shippingCheckpoint');
Route::post('user/selling/show/tracking','users\ShopController@showTracking');
Route::post('user/selling/delete/tracking','users\ShopController@deleteTracking');
Route::get('user/buying/give/rating/{id}','users\ShopController@productRatingPage');
Route::post('user/buying/give/feedback','users\ShopController@productFeedback');

//test

Route::get('slim-test','users\ShopController@slimTest'); 
Route::post('slim_upload','users\ShopController@slimUpload');