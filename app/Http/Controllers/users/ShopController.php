<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;
use App\Shop;
use App\UserProduct;
use App\ShopCountry;
use App\ShopCurrency;
use App\ShopLanguage;
use App\MenuCategory;
use App\MenuSubCategory;
use App\MenuTriSubCategory;
use App\UserProfile\UpdateProfile;
use Session;
use App\SamePrice;
use App\differentPrice;
use App\ProductShippingLocations;
use App\User;
use App\shopCarousel;
use App\customCategory;
use Cart;
use App\user_different_address;
use App\buyed_product;
use App\AfterShip\AfterShipException;
use App\AfterShip\BackwardCompatible;
use App\AfterShip\Couriers;
use App\AfterShip\LastCheckPoint;
use App\AfterShip\Notifications;
use App\AfterShip\Requestable;
use App\AfterShip\Request as AftersipRequest;
use App\AfterShip\Trackings;
use App\feedback;
use App\slim\Slim;
class ShopController extends Controller
{
  public $key;

  public function __construct()
  {
     $this->key = 'd925b234-affd-4129-a432-e294db5f4ea3';
  }
  public function createShop()
  {
    $ShopCountry = ShopCountry::all();
    $ShopCurrency  = ShopCurrency::all();
    $ShopLanguage  = ShopLanguage::all();
    $shops = DB::table('shops')->where('user_id',Auth()->user()->id)->first();

    // return view('users.user-shop.create_shop',compact('ShopCountry','ShopCurrency','ShopLanguage','shops'));
    return view('users.dashboard.shop.create_shop',compact('ShopCountry','ShopCurrency','ShopLanguage','shops'));
  }
  public function newCreateProduct()
  {
    $categories = MenuCategory::all();
    $subcategory = MenuSubCategory::all();
    $MenuTriSubCategory = MenuTriSubCategory::all();
    $ShopCountry = ShopCountry::all();
    // return view('users.product.newCreateProduct',compact('categories','subcategory','MenuTriSubCategory','ShopCountry'));

    return view('users.dashboard.listing.add_listing',compact('categories','subcategory','MenuTriSubCategory','ShopCountry'));
  }

  public function createShopUpdate(Request $request)
  {
    $findShopName = Shop::where('shop_name',$request->shopname)->first();
    if($findShopName){
      return back()->with('fail','Shop name not aviable please try another name');
    }


   $db_check = DB::table('shops')->select('id')->where('user_id',Auth()->user()->id)->first();
   if($db_check){
    $Shop = Shop::find($db_check->id);
    $Shop->user_id = Auth()->user()->id;
    $Shop->country_id = $request->country;
    $Shop->language_id = $request->language;
    $Shop->currency_id = $request->currency;
    $Shop->shop_title = $request->shoptitle;
    $Shop->about_shop = $request->aboutshop;
    $Shop->announcement = $request->announcement;
    $Shop->police = $request->police;
    $Shop->more = $request->more;
    $Shop->update_date = date('Y-m-d');
    // shopProfileImage

      $shopProfileImage = $request->file('shopProfileImage');
      if($shopProfileImage){
         $shopProfileImageName = rand().'.'.$shopProfileImage->getClientOriginalExtension();
         $shopProfileImage->move(public_path("users/shop"),$shopProfileImageName);
         $Shop->image = $shopProfileImageName;
      }



    //image 
    if($request->banner=='banner'){
      $banner = $request->file('bannerFile');
      if($banner){
       $newName = rand().'.'.$banner->getClientOriginalExtension();
       $banner->move(public_path("users/shop"),$newName);
       $Shop->banner = $newName;
     }
   }else if($request->banner=='carousel'){
      $bannerCarousel = $request->file('bannerCarousel');
      if($bannerCarousel){
        foreach ($bannerCarousel as  $carousel) {
         $shopCarousel = new shopCarousel;
         $img_name = rand().'.'.$carousel->getClientOriginalExtension();
         $carousel->move(public_path("users/shop"),$img_name);
         $shopCarousel->user_id = Auth()->user()->id;
         $shopCarousel->shop_id = $db_check->id;
         $shopCarousel->image = $img_name;
         $shopCarousel->save();
        }
       
      }
   }
   //end image
    $Shop->save();
    return back()->with('updated','Shop Updated Successfully');
  }else{
    $Shop = new Shop;
    $Shop->user_id = Auth()->user()->id;
    $Shop->country_id = $request->country;
    $Shop->language_id = $request->language;
    $Shop->currency_id = $request->currency;
    $Shop->shop_name = $request->shopname;
    $Shop->shop_title = $request->shoptitle;
    $Shop->about_shop = $request->aboutshop;
    $Shop->announcement = $request->announcement;
    $Shop->police = $request->police;
    $Shop->more = $request->more;
    
    $shopProfileImage = $request->file('shopProfileImage');
      if($shopProfileImage){
         $shopProfileImageName = rand().'.'.$shopProfileImage->getClientOriginalExtension();
         $shopProfileImage->move(public_path("users/shop"),$shopProfileImageName);
         $Shop->image = $shopProfileImageName;
      }
    $Shop->save();
    //image 
    if($request->banner=='banner'){
      $banner = $request->file('bannerFile');
      if($banner){
       $newName = rand().'.'.$banner->getClientOriginalExtension();
       $banner->move(public_path("users/shop"),$newName);
       $shopUpdate = Shop::find($Shop->id);
       $shopUpdate->banner = $newName;
       $shopUpdate->save();
     }
   }else if($request->banner=='carousel'){
      $bannerCarousel = $request->file('bannerCarousel');
      if($bannerCarousel){
        foreach ($bannerCarousel as  $carousel) {
         $shopCarousel = new shopCarousel;
         $img_name = rand().'.'.$carousel->getClientOriginalExtension();
         $carousel->move(public_path("users/shop"),$img_name);
         $shopCarousel->user_id = Auth()->user()->id;
         $shopCarousel->shop_id = $Shop->id;
         $shopCarousel->image = $img_name;
         $shopCarousel->save();
        }
       
      }
   }
   //end image
    return back()->with('saved','Shop Created Successfully');
  }


}
public function addProduct()
{
 $categories = MenuCategory::all();
 $subcategory = MenuSubCategory::all();
 $MenuTriSubCategory = MenuTriSubCategory::all();
 return view('users.product.create_product',compact('categories','subcategory','MenuTriSubCategory'));
}
public function dataTest(Request $request)
{

  
  $imgs = $request->file('item_img');
  for ($count=0; $count < count($request->item_price); $count++) { 
    $differentPrice = new differentPrice;
    $img = $imgs[$count];
    $thumb = rand().'.'.$img->getClientOriginalExtension();
    $img->move(public_path("users/product-image"),$thumb);
    $differentPrice->product_id = Session::get('product_id');
    $differentPrice->img = $thumb;
    $differentPrice->price = $request->item_price[$count];
    $differentPrice->save();
    
  }
  print_r($request->item_price);
  
}


public function storePrimaryProduct(Request $request)
{
  if(Session::get('product_id')){
    $UserProduct = UserProduct::find(Session::get('product_id'));
    $category_id = $request->category;
    $tri_sub_category = $request->tri_sub_category;
    $discount = $request->discount;
    $sub_category = $request->sub_category;
    $product_title = $request->product_title;
    $product_price = $request->product_price;

    $thum_img = $request->file('thumbnail_image');
    if($thum_img){
     $thumb = rand().'.'.$thum_img->getClientOriginalExtension();
     $thum_img->move(public_path("users/product-image"),$thumb);
     $UserProduct->image =  $thumb;
   }
   $UserProduct->category_id = $category_id;
   $UserProduct->sub_category_id = $sub_category;
   $UserProduct->tri_sub_category_id = $tri_sub_category;
   $UserProduct->product_title = $product_title;
   $UserProduct->price = $product_price;
   $UserProduct->discount = $discount;
   $UserProduct->save();
   Session::put('product_id',$UserProduct->id);
   return response()->json(['update'=>'update']); 
 }else{
  $category_id = $request->category;
  $tri_sub_category = $request->tri_sub_category;
  $discount = $request->discount;
  $sub_category = $request->sub_category;
  $product_title = $request->product_title;
  $product_price = $request->product_price;
  $UserProduct = new UserProduct;
  $thum_img = $request->file('thumbnail_image');
  if($thum_img){
    $thumb = rand().'.'.$thum_img->getClientOriginalExtension();
    $thum_img->move(public_path("users/product-image"),$thumb);
    $UserProduct->image =  $thumb;
  }
  $shop_id = Shop::where('id',Auth()->user()->id)->first();
  $UserProduct->user_id = Auth()->user()->id;
  $UserProduct->shop_id = $shop_id->id;
  $UserProduct->category_id = $category_id;
  $UserProduct->sub_category_id = $sub_category;
  $UserProduct->tri_sub_category_id = $tri_sub_category;
  $UserProduct->product_title = $product_title;
  $UserProduct->price = $product_price;
  $UserProduct->discount = $discount;
  $UserProduct->save();
  Session::put('product_id',$UserProduct->id);
  return response()->json(['save'=>'save']); 
}



}
public function storeProductColor(Request $request)
{
       // dd();
       // dd($request->item_name);

  echo 'rasel';
}
public function storeProductSize(Request $request)
{
  $size = $request->tags;
  $main_size = str_replace(array('[',']','"'), '',$size);
  $UserProduct = UserProduct::find(Session::get('product_id'));
  if($UserProduct){
   $sizeFile = $request->file('sizeFile');
   if($sizeFile){
     $thumb = rand().'.'.$sizeFile->getClientOriginalExtension();
     $sizeFile->move(public_path("users/product-image"),$thumb);
     $UserProduct->size_img =  $thumb;
   }
   $UserProduct->size =  $main_size;
   $UserProduct->save();
 }else{
  echo'previes';
}

}
public function storeProductDetails(Request $request)
{
  $tags = $request->tags;
  $main_tags = str_replace(array('[',']','"'), '',$tags);
  $meterials = $request->meterials;
  $main_meterials = str_replace(array('[',']','"'), '',$meterials);
  $des = $request->product_details;
  $UserProduct = UserProduct::find(Session::get('product_id'));
  if($UserProduct){
   $UserProduct->tags =  $main_tags;
   $UserProduct->meterials =  $main_meterials;
   $UserProduct->description =  $des;
   $UserProduct->save();
 }else{
  echo'previes';
}

}

public function allData(Request $request)
{
  //basic info  

  return back()->with('success','product successfully added');
  $UserProduct = new UserProduct;
  if($request->savemode=='save'){
    $UserProduct->status = 1;
  }
  $category_id = $request->first_category;
  $sub_category = $request->sub_category;
  $tri_sub_category = $request->tri_sub_category_id;
  $category_name = DB::table('menu_categories')->where('id',$request->first_category)->first();
  $sub_category_name = DB::table('menu_sub_categories')->where('id',$request->sub_category)->first();
  $tri_sub_category_name = DB::table('menu_tri_sub_categories')->where('id',$request->tri_sub_category_id)->first();

  $UserProduct->category_name = $category_name->category_name;
  $UserProduct->sub_category_name = $sub_category_name->sub_category_name;
  $UserProduct->tri_sub_category_name = $tri_sub_category_name->tri_sub_category_name;

  $discount = $request->discount;
  $product_title = $request->product_title;
  $product_price = $request->given_product_prices;


  // $thum_img = $request->file('thumbnail_image');
  // if($thum_img){
  //   $thumb = rand().'.'.$thum_img->getClientOriginalExtension();
  //   $thum_img->move(public_path("users/product-image"),$thumb);
  //   $UserProduct->image =  $thumb;
  // }
  $shop_id = Shop::where('id',Auth()->user()->id)->first();
  $UserProduct->user_id = Auth()->user()->id;
  $UserProduct->shop_id = $shop_id->id;
  $UserProduct->category_id = $category_id;
  $UserProduct->sub_category_id = $sub_category;
  $UserProduct->tri_sub_category_id = $tri_sub_category;
  $UserProduct->product_title = $product_title;
  $UserProduct->price = $product_price;
  $UserProduct->discount = $discount;
  if($discount){
    $total_discount = $product_price*$discount/100;
    $UserProduct->main_price = $product_price-$total_discount;
  }else{
    $UserProduct->main_price = $product_price;
  }
  
  // $UserProduct->custom_category = $request->custom_category;
  if($request->special_product){
    $UserProduct->special_product =1;
  }
  //thumbnail image 

  if($request->thumbnail_img){
    
  }
  
  $UserProduct->save();

  // if($request->custom_category){
  //    $findCategory = customCategory::where('category',$request->custom_category)->first();
  //     if(!$findCategory){
  //       $customCategory = new customCategory;
  //       $customCategory->user_id = Auth()->user()->id;
  //       $customCategory->product_id = $UserProduct->id;
  //       $customCategory->shop_id = $shop_id->id;
  //       $customCategory->category = $request->custom_category;
  //       $customCategory->save();
  //       $customCategoryId = $customCategory->id;
  //     }else{
  //       $customCategoryId = $findCategory->id;
  //     }
  // }else{
  //    $customCategoryId ='';
  // }

  // $product_id = $UserProduct->id;
  // $UserProductUpdate = UserProduct::find($product_id);

  //           // image specification goes differect table with product_id
  // if($request->color == 'diff_price'){
  //   $imgs = $request->file('item_img');
  //   if($request->item_price){
  //     for ($count=0; $count < count($request->item_price); $count++) { 
  //      $differentPrice = new differentPrice;
  //      $img = $imgs[$count];
  //      $thumb = rand().'.'.$img->getClientOriginalExtension();
  //      $img->move(public_path("users/product-image"),$thumb);
  //      $differentPrice->product_id = $product_id;
  //      $differentPrice->img = $thumb;
  //      $differentPrice->price = $request->item_price[$count];
  //      $differentPrice->save();
       
  //    }
  //  }
   
  //           }elseif($request->color == 'same_price'){  //different table with id
  //             $product_image = $request->file('same_product_img');
  //             if($product_image){
  //               foreach ($product_image as  $product_img) {
  //                $SamePrice = new SamePrice;
  //                $img_name = rand().'.'.$product_img->getClientOriginalExtension();
  //                $product_img->move(public_path("users/product-image"),$img_name);
  //                $SamePrice->product_id = $product_id;
  //                $SamePrice->img = $img_name;
  //                $SamePrice->save();
  //              }
               
  //            }

  //          }


           

  //       //size specfication

  //       $size = $request->tags; //goes same table
  //       $main_size = str_replace(array('[',']','"'), '',$size);

  //       $sizeFile = $request->file('sizeFile');
  //       if($sizeFile){
  //        $thumb = rand().'.'.$sizeFile->getClientOriginalExtension();
  //        $sizeFile->move(public_path("users/product-image"),$thumb);
  //        $UserProductUpdate->size_img =  $thumb;
  //      }
  //      $UserProductUpdate->size =  $main_size;


  //      $UserProductUpdate->custom_category =  $customCategoryId;
       

  //       // shipping info 
       
  //      $UserProductUpdate->shipping_cost = $request->shipping_const; 
  //      $UserProductUpdate->shipping_origin = $request->shipping_origin; 
  //      $processing_time = $request->processing_time; 
  //       if($processing_time=='custom_range'){             //same table
  //        $from_day = $request->from_day; 
  //        $to_day = $request->to_day; 
  //        $custom_day = $request->custom_day;
  //        $processing_time = $from_day.' - '.$to_day.' '.$custom_day;
  //      }
  //      $UserProductUpdate->processing_time = $processing_time;

  //      $UserProductUpdate->origin_cost = $request->origin_shipping_cost;
  //      $UserProductUpdate->everywhere_cost = $request->everywhere_shipping_cost;
  //      $UserProductUpdate->save();

  //      $shipping_location = $request->shipping_location;
       
  //      if($shipping_location){
  //       $location_shipping_cost = array_filter($request->total_shipping_cost);
  //       for ($count=0; $count < count($request->shipping_location); $count++) { 

  //         $ProductShippingLocation  = new ProductShippingLocations;
  //         $ProductShippingLocation->product_id = $product_id;
  //         $ProductShippingLocation->location = $request->shipping_location[$count];
  //         $ProductShippingLocation->cost =  $location_shipping_cost[$count];
  //         $ProductShippingLocation->save();
          
          
  //       }
  //     }
      
  //     $tags = $request->tags2;
  //     $main_tags = str_replace(array('[',']','"'), '',$tags);
  //     $meterials = $request->meterials;
  //     $main_meterials = str_replace(array('[',']','"'), '',$meterials);
  //     $des = $request->product_details;
  //     $UserProductUpdate->tags = $main_tags;
  //     $UserProductUpdate->meterials = $main_meterials;
  //     $UserProductUpdate->description = $des;
  //     $UserProductUpdate->save();
  //     return redirect('product_listin')->with('add_listin_success','success');
      
    }
    public function shopPublicProfile($shop_id)
    {
      return view('users.user-shop.public_profile',compact('shop_id'));
    }

    public function home() {
      return view('users.user-shop.home');
    }

    public function productView($id) {
      return view('users.user-shop.product_view',compact('id'));
    }

    public function userShop() {
      return view('users.user-shop.user_shop');
    }
    public function userProduct($id)
    {
      $UserProducts = UserProduct::where('tri_sub_category_id',$id)->get();
      return view('users.product.product',compact('UserProducts'));

      
    }

    public function userProfile() {
      return view('users.user-shop.user_profile');
    }

    public function getUserDashboard()
    {
      return view('users.dashboard.layout');
    }
    public function personalProfileUpdate()
    {
      return view('users.dashboard.personal_profile.personal_profile');
    }
    public function personalProfileUpdateToDB(Request $request)
    {
      $user = User::find(Auth()->user()->id);
      $user->name = $request->name;
      $user->city = $request->city;
      $user->gender = $request->gender;
      $user->birth_date = $request->brith_date;
      $progile_image = $request->file('progile_image');
      if($progile_image){
        $img = rand().'.'.$progile_image->getClientOriginalExtension();
        $progile_image->move(public_path("users/profile_image"),$img);
        $user->image =  $img;
      }
      $user->save();
      return back()->with('success','success');

    }
    public function changeProfilePicute(Request $request)
    {
      $user = User::find(Auth()->user()->id);
      $image = $request->file('profile_image');
      if($image){
        $image_name = rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path("users/profile_image"),$image_name);
        $user->image =  $image_name;
        $user->save();
        echo 'success';
      }
    }


    public function productListing()
    {
      return view('users.dashboard.listing.listing');
    }


    public function checkShopName(Request $request)
    {
      $findShopName = Shop::where('shop_name',$request->shopName)->first();
      if($findShopName){
        echo 'not_available';
      }else{
        echo 'available';
      }

    }

    public function editListing($id)
    {
      $UserProducts = UserProduct::where('id',$id)->first();
      $categories = MenuCategory::all();
      $subcategory = MenuSubCategory::all();
      $MenuTriSubCategory = MenuTriSubCategory::all();
      $ShopCountry = ShopCountry::all();
      return view('users.dashboard.listing.edit_listing',compact('UserProducts','categories','subcategory','MenuTriSubCategory','ShopCountry'));
    }
   public function deleteDifferentColor(Request $request)
   {
    differentPrice::find($request->id)->delete();
    echo 'deleted';
   }
   public function deleteSameColor(Request $request)
   {
      SamePrice::find($request->id)->delete();
      echo 'deleted';
   }
   public function listingUpdate(Request $request)
   {
    $UserProduct = UserProduct::find($request->product_id);
    if($request->savemode=='save'){
      $UserProduct->status = 1;
    }

   
    $category_id = $request->category;
    $tri_sub_category = $request->tri_sub_category;
    $discount = $request->discount;
    $sub_category = $request->sub_category;
    $product_title = $request->product_title;
    $product_price = $request->product_price;

     if($request->discount){
        $total_discount = $request->product_price * $request->discount/100;
        $UserProduct->main_price = $request->product_price-$total_discount;
      }else{
         $UserProduct->main_price = $request->product_price;
      }

    
    $thum_img = $request->file('thumbnail_image');
    if($thum_img){
      $thumb = rand().'.'.$thum_img->getClientOriginalExtension();
      $thum_img->move(public_path("users/product-image"),$thumb);
      $UserProduct->image =  $thumb;
    }

    $UserProduct->category_id = $category_id;
    $UserProduct->sub_category_id = $sub_category;
    $UserProduct->tri_sub_category_id = $tri_sub_category;
    $UserProduct->product_title = $product_title;
    $UserProduct->price = $product_price;
    $UserProduct->discount = $discount;
    $UserProduct->custom_category = $request->custom_category;





  if($request->custom_category){
     $findCategory = customCategory::where('category',$request->custom_category)->first();
      if(!$findCategory){
        $customCategory = new customCategory;
        $customCategory->user_id = Auth()->user()->id;
        $customCategory->product_id = $request->product_id;
        $customCategory->category = $request->custom_category;
        $customCategory->save();
      }
  }

            // image specification goes differect table with product_id
  if($request->color == 'diff_price'){
    $imgs = $request->file('item_img');
    if($request->item_price){
      for ($count=0; $count < count($request->item_price); $count++) { 
       $differentPrice = new differentPrice;
       $img = $imgs[$count];
       $thumb = rand().'.'.$img->getClientOriginalExtension();
       $img->move(public_path("users/product-image"),$thumb);
       $differentPrice->product_id = $request->product_id;
       $differentPrice->img = $thumb;
       $differentPrice->price = $request->item_price[$count];
       $differentPrice->save();
       
     }
   }
   
            }elseif($request->color == 'same_price'){  //different table with id
              $product_image = $request->file('same_product_img');
              if($product_image){
                foreach ($product_image as  $product_img) {
                 $SamePrice = new SamePrice;
                 $img_name = rand().'.'.$product_img->getClientOriginalExtension();
                 $product_img->move(public_path("users/product-image"),$img_name);
                 $SamePrice->product_id = $request->product_id;
                 $SamePrice->img = $img_name;
                 $SamePrice->save();
               }
               
             }

           }


           

        //size specfication

        $size = $request->tags; //goes same table
        $main_size = str_replace(array('[',']','"'), '',$size);

        $sizeFile = $request->file('sizeFile');
        if($sizeFile){
         $thumb = rand().'.'.$sizeFile->getClientOriginalExtension();
         $sizeFile->move(public_path("users/product-image"),$thumb);
         $UserProduct->size_img =  $thumb;
       }
       $UserProduct->size =  $main_size;


       
       

        // shipping info 
       
       $UserProduct->shipping_cost = $request->shipping_const; 
       $UserProduct->shipping_origin = $request->shipping_origin; 
       $processing_time = $request->processing_time; 
        if($processing_time=='custom_range'){             //same table
         $from_day = $request->from_day; 
         $to_day = $request->to_day; 
         $custom_day = $request->custom_day;
         $processing_time = $from_day.' - '.$to_day.' '.$custom_day;
       }
       $UserProduct->processing_time = $processing_time;

       $UserProduct->origin_cost = $request->origin_shipping_cost;
       $UserProduct->everywhere_cost = $request->everywhere_shipping_cost;

       $shipping_location = $request->shipping_location;
        ProductShippingLocations::where('product_id',$request->product_id)->delete();
       if($shipping_location){
        $location_shipping_cost = array_filter($request->total_shipping_cost);
        for ($count=0; $count < count($request->shipping_location); $count++) { 

          $ProductShippingLocation  = new ProductShippingLocations;
          $ProductShippingLocation->product_id = $request->product_id;
          $ProductShippingLocation->location = $request->shipping_location[$count];
          $ProductShippingLocation->cost =  $location_shipping_cost[$count];
          $ProductShippingLocation->save();
          
          
        }
      }
      
      $tags = $request->tags2;
      $main_tags = str_replace(array('[',']','"'), '',$tags);
      $meterials = $request->meterials;
      $main_meterials = str_replace(array('[',']','"'), '',$meterials);
      $des = $request->product_details;
      $UserProduct->tags = $main_tags;
      $UserProduct->meterials = $main_meterials;
      $UserProduct->description = $des;
      $UserProduct->save();
      return redirect('product_listin')->with('update_success','success');
   }

   public function DeleteShopProfileImage(Request $request)
   {
      $update_shop = Shop::find($request->id);
      $update_shop->image = '';
      $update_shop->save();
      echo 'deleted';



   }
   public function DeleteShopBannerImage(Request $request){
      $update_shop = Shop::find($request->id);
      $update_shop->banner = '';
      $update_shop->save();
      echo 'deleted';
   }
   public function DeleteShopcarouselsImage(Request $request){
     shopCarousel::where('id',$request->id)->delete();
     echo 'deleted';

   }

   public function viewShopProductByCategory(Request $request)
   {
    
    $category_id = $request->category_id;
    $shop_id = $request->shop_id;
    if($category_id){
      $shop_name = Shop::where('id',$shop_id)->first();
      if($category_id =='all'){
        $product = UserProduct::where('shop_id',$shop_id)->get();
        if($product){
          $html = '';
          foreach ($product as $product) {
              $html .='<div class="col-md-3 single-pro-box" style="float: left;">';
              $html .='<a href="'.url("product_view/$product->id").'">';
              $html .='<img src="'.asset("users/product-image/$product->image").'" class="img-fluid" alt="image">';
              $html .='<div class="sgl-pro-t">'.substr($product->product_title,0,40).'</div>';
              $html .='<div class="sgl-pro-s-n">'.$shop_name->shop_title.'</div>';
              $html .='<div class="sgl-pro-p">US '.$product->price.'</div>';
              $html .='</a></div>';
          }
          echo $html;
        }
      }else{
        $product = UserProduct::where('custom_category',$category_id)->where('shop_id',$shop_id)->get();
        if($product){
          $html = '';
          foreach ($product as $product) {
              $html .='<div class="col-md-3 single-pro-box" style="float: left;">';
              $html .='<a href="'.url("product_view/$product->id").'">';
              $html .='<img src="'.asset("users/product-image/$product->image").'" class="img-fluid" alt="image">';
              $html .='<div class="sgl-pro-t">'.substr($product->product_title,0,40).'</div>';
              $html .='<div class="sgl-pro-s-n">'.$shop_name->shop_title.'</div>';
              $html .='<div class="sgl-pro-p">US '.$product->price.'</div>';
              $html .='</a></div>';
          }
          echo $html;
        }
      }
    }else{
      echo'No product avaiable in this category please try another';
    }
    
   }

   public function publicShopProductFilter(Request $request)
   {
      $filter_value = $request->filter_value;
      $shop_id = $request->shop_id;
      $shop_name = Shop::where('id',$shop_id)->first();
      if($filter_value=='lowest_price'){
        $category_id = $request->category_id;
        if($category_id=='all' OR $category_id==''){
         $find_product = UserProduct::where('shop_id',$shop_id)->orderBy('price','ASC')->get();
        }else{
          
          $find_product = UserProduct::where('shop_id',$shop_id)->where('custom_category',$category_id)->orderBy('price','ASC')->get();
        }

       }else if($filter_value=='height_price'){
        $category_id = $request->category_id;
          if($category_id=='all' OR $category_id==''){
           $find_product = UserProduct::where('shop_id',$shop_id)->orderBy('price','DESC')->get();
          }else{
            $find_product = UserProduct::where('shop_id',$shop_id)->where('custom_category',$category_id)->orderBy('price','DESC')->get();
          }
       }else{
          $find_product = UserProduct::where('shop_id',$shop_id)->get();
       }
       if($find_product){
        $html = '';
          foreach ($find_product as $product) {
              $html .='<div class="col-md-3 single-pro-box" style="float: left;">';
              $html .='<a href="'.url("product_view/$product->id").'">';
              $html .='<img src="'.asset("users/product-image/$product->image").'" class="img-fluid" alt="image">';
              $html .='<div class="sgl-pro-t">'.substr($product->product_title,0,40).'</div>';
              $html .='<div class="sgl-pro-s-n">'.$shop_name->shop_title.'</div>';
              $html .='<div class="sgl-pro-p">US '.$product->price.'</div>';
              $html .='</a></div>';
          }
          echo $html;
       }
       
   }

public function AddToCart(Request $request)
{
   $product_id = $request->product_id;
   $qty = $request->qty;
   $shipping_cost = $request->shipping_cost;
   $shipping_location = $request->shipping_location;
   $size = 'm';
   $color = '34dert';
   $single_Product = UserProduct::where('id',$product_id)->first();
   $flag = 0;
   $shop_id_exits = 0;
    foreach(Cart::content() as $row){ 
        if($row->id==$product_id){
            $flag = 1; 
        }
    }

    if($flag == 0){
        if($shipping_cost!='Free Shipping'){
          
            $main_shipping_cost = $shipping_cost;
          
        }else{
          $main_shipping_cost = $shipping_cost;
        }
        if($request->extra_item){
          $extra_item = 1;
        }else{
          $extra_item = 0;
        }

        $done = Cart::add($single_Product->id, $single_Product->product_title,$qty,$single_Product->main_price,['price'=>$single_Product->price,'dicount'=>$single_Product->discount,'shipping'=>$main_shipping_cost,'shop_id'=>$single_Product->shop_id,'image'=>$single_Product->image,'shipping_location'=>$shipping_location,'extra_item'=>$extra_item,'shop_id'=>$request->shop_id,'user_id'=>$request->user_id]);
        echo 'done';
        
    }else{
        echo 'already exits';
    }


}

public function Cart(){
  return view('users.user-shop.cart');
}

  public function removeCartItem(Request $request)
  {
    Cart::remove($request->rowid);
    echo 'done';
  }
  public function upateCartItem(Request $request)
  {
    Cart::update($request->rowid, $request->item);
  }

  public function initialBuyingInfo()
  {
    return view('users.buy.initial_buying_info');
  }

  public function saveUserInfo(Request $request)
  {
    $user = new user_different_address;
    $request->validate([
        'country' => 'required',
        'address' => 'required',
        'state' => 'required',
        'postal_code' => 'required|numeric',
        'phone' => 'required|numeric',
        'city' => 'required',
    ]);
    $user_id = Auth()->user()->id;
    $fnameLname = User::where('id',$user_id)->first();
    $user->user_id = $user_id;
    $user->country = $request->country;
    $user->f_name = $fnameLname->name;
    $user->l_name = '';
    $user->street_address1 = $request->address;
    $user->street_address2 = $request->additional;
    $user->state = $request->state;
    $user->city = $request->city;
    $user->zip = $request->postal_code;
    $user->phone = $request->phone;
    $user->primary_address = 1;
    $user->save();

    if(Cart::content()->count()>0){
      return redirect('checkout');
    }else{
      echo 'Need To push redirect Url Rasel';
    }

  }

  public function checkout()
  {
    return view('users.buy.checkout');
  }
  public function AddDifferentShippingAddress(Request $request)
  {
    $user_id = Auth()->user()->id;

    $find_other_shipped_address = user_different_address::where('user_id',$user_id)->where('shipped_address',1)->first();
    if($find_other_shipped_address){
      $save_to_zero = user_different_address::find($find_other_shipped_address->id);
      $save_to_zero->shipped_address = 0;
      $save_to_zero->save();
    }

    if($request->isPrimary){
      $find_primary = user_different_address::where('user_id',$user_id)->where('primary_address',1)->first();
      if($find_primary){
        $primary_address = user_different_address::find($find_primary->id);
        $primary_address->primary_address = 0;
        $primary_address->save();
      }

    }

    $user = new user_different_address;
    $user->user_id = $user_id;
    $user->f_name = $request->f_name;
    $user->l_name = $request->l_name;
    $user->country = $request->country;
    $user->street_address1 = $request->s_address;
    $user->street_address2 = $request->s_address2;
    $user->state = $request->state;
    $user->city = $request->city;
    $user->zip = $request->zip;
    $user->phone = $request->phone;
    if($request->isPrimary){
     $user->primary_address = $request->isPrimary;
    }
    $user->shipped_address = 1;
    $user->save();
    echo 'done';
    
  }

  public function byingShippingAddressEdit(Request $request)
  {
    Session::put('edit_id', $request->id);
    echo $request->id;
  }

  public function editDifferentShippingAddress(Request $request)
  {
     if($request->isPrimary){
      $find_primary = user_different_address::where('user_id',Auth()->user()->id)->where('primary_address',1)->first();
      if($find_primary){
        $primary_address = user_different_address::find($find_primary->id);
        $primary_address->primary_address = 0;
        $primary_address->save();
      }

    }
    $user = user_different_address::find($request->update_id);
    $user->f_name = $request->f_name;
    $user->l_name = $request->l_name;
    $user->country = $request->country;
    $user->street_address1 = $request->s_address;
    $user->street_address2 = $request->s_address2;
    $user->state = $request->state;
    $user->city = $request->city;
    $user->zip = $request->zip;
    $user->phone = $request->phone;
    if($request->isPrimary){
     $user->primary_address = 1;
    }
    $user->save();
    echo 'done';
  }

  public function Stripe()
  {
    return view('paywithstripe');
  }
  public function Payment(Request $request)
  {
    // Set your secret key: remember to change this to your live secret key in production
    // See your keys here: https://dashboard.stripe.com/account/apikeys
    \Stripe\Stripe::setApiKey("sk_test_sHz1xjaV6BefIKdDp18G6tZs");

    // Token is created using Checkout or Elements!
    // Get the payment token ID submitted by the form:
    $amount = Session::get('total_amount') * 100;
    $token =$request->stripeToken;
    $charge = \Stripe\Charge::create([
        'amount' => $amount,
        'currency' => 'usd',
        'description' => 'Example charge',
        'source' => $token,
    ]);

    if($charge)
    {
      $array = array();
      foreach(Cart::content() as $row){
          $array[] = $row->options->shop_id;
      }

      $unique_shop = array_unique($array);
      $total_shop =  array_values($unique_shop);


      $total_shipping_cost = 0;
      $total_product_price = 0;

      for ($i=0; $i < count($total_shop); $i++) { 
          $shop_id = $total_shop[$i];
          $shipping_cost = 0;
          $amount = 0;
          $item_count = 0;
          $random_value = (rand(1, 1000000));
          $get_rendom = $random_value;  
          foreach (Cart::content() as $key => $row) {
           if($row->options->shop_id==$shop_id){
              $item_count++;
               if($row->options->shipping!='Free Shipping'){
                  if($row->options->extra_item==1 && $item_count>1 ){
                      $shipping_cost = $shipping_cost + 2;
               
                  }else{
                      $shipping_cost = $shipping_cost + $row->options->shipping;
                      
                  }
                      
              }else{
                  $shipping_cost = $row->options->shipping; 
              }

             
              $amount = $amount+$row->total;
              $buyed_product = new buyed_product;
              $buyed_product->seller_id = $row->options->user_id;
              $buyed_product->seller_shop_id = $row->options->shop_id;
              $buyed_product->buyer_id = Auth()->user()->id;
              $buyed_product->product_id = $row->id;
              $buyed_product->product_name = $row->name;
              $buyed_product->product_image = $row->options->image;
              $buyed_product->buyer_address_id = Session::get('address_id');
              $buyed_product->product_qty = $row->qty;
              if($row->options->extra_item == 1){
                $single_shipping_cost = 2;
              }else if($row->options->extra_item == 0) {
                $single_shipping_cost = $row->options->shipping;
              }else{
                $single_shipping_cost = $row->options->shipping;
              }
              $buyed_product->single_price = $row->price;
              $buyed_product->shipping_cost = $single_shipping_cost;
              $buyed_product->product_qty = $row->qty;
              $buyed_product->order_id = $get_rendom;
              $buyed_product->total_price = $single_shipping_cost+$row->total;
              $buyed_product->save();

           } } 
           $total_product_price = $total_product_price + $amount;
           $total_shipping_cost =  $total_shipping_cost + (int)$shipping_cost;


      }
    }
    return redirect('user/buyed');
    
  }

  public function shippingSelectedAddress(Request $request)
  {
    $user_id = Auth()->user()->id;

    $find_other_shipped_address = user_different_address::where('user_id',$user_id)->where('shipped_address',1)->first();
    if($find_other_shipped_address){
      $save_to_zero = user_different_address::find($find_other_shipped_address->id);
      $save_to_zero->shipped_address = 0;
      $save_to_zero->save();
    }
    $update = user_different_address::find($request->id);
    $update->shipped_address = 1;
    $update->save();
    echo 'done';
  }
  public function goForPayment(Request $request)
  {
    echo $request->address_id;
    echo $request->total_amount;
    Session::put('address_id',$request->address_id);
    Session::put('total_amount',$request->total_amount);
    echo 'done';
  }

  public function buyed()
  {
    return view('users.dashboard.buy.product_buy');
  }
  public function buyedProductView($order_id)
  {
    $buyed_product = DB::table('buyed_products')->where('order_id',$order_id)->get();
    $buyed_single_product = DB::table('buyed_products')->where('order_id',$order_id)->orderBy('id','DESC')->first();
    return view('users.dashboard.buy.buy_product_view',compact('buyed_product','order_id','buyed_single_product'));
  }
  public function productSelling()
  {

    $all_buyed_product = DB::table('buyed_products')->where('seller_id', Auth()->user()->id)->where('status',0)->whereNotNull('tracking_code')->where('tracking_code','<>', '')->distinct()->get(['order_id']);

    foreach ($all_buyed_product as $key => $order_id) {
      $find_item = buyed_product::where('order_id',$order_id->order_id)->where('status',0)->first();
      $multiple_single_item = buyed_product::where('order_id',$order_id->order_id)->where('status',0)->get();
      $code = $find_item->tracking_code;
      $slug = $find_item->tracking_slug;
      $check_point = new LastCheckPoint($this->key);
      $last_check_point = $check_point->get($slug,$code);
      if($last_check_point){
        if($last_check_point['data']['tag']=='Delivered'){
            $date_time = $last_check_point['data']['checkpoint']['created_at'];
            foreach ($multiple_single_item as $key => $item) {
              $update = buyed_product::find($item->id);
              $update->status = 1;
              $update->delivared_date = $date_time;
              $update->save();
            }
        }
      }

    }
    $couriers = new Couriers($this->key);
    $all_couriers = $couriers->all();
    return view('users.dashboard.selling.selling',compact('all_couriers'));
    // $check_point = new LastCheckPoint($this->key);
    // $last_check_point = $check_point->get('lietuvos-pastas','RE048542646LT');
    // echo '<pre>';
    // print_r($last_check_point);
    // echo '</pre>';
  }
  public function viewProductSelling($order_id)
  {
    $buyed_product = DB::table('buyed_products')->where('order_id',$order_id)->get();
    $buyed_single_product = DB::table('buyed_products')->where('order_id',$order_id)->orderBy('id','DESC')->first();
    return view('users.dashboard.selling.selling_view',compact('buyed_product','order_id','buyed_single_product'));
  }

  public function earning()
  {
    $key = 'd925b234-affd-4129-a432-e294db5f4ea3';
    $couriers = new Couriers($key);
    $trackings = new Trackings($key);
    $notifications = new Notifications($key);
    $last_check_point = new LastCheckPoint($key);

    $response = $couriers->detect('1234567890Z');
    dd($response);

    //RE048542646LT

    //return view('users.dashboard.earning.earning');
  }


  public function addUpdateTracking(Request $request)
  {
    $order_id = $request->order_id_for_tracking;
    $tracking_code = $request->tracing_code;
    $title = $request->title;
    $couriers_slug = $request->couriers;

    $trackings = new Trackings($this->key);
    $tracking_info = [
        'slug'    => $couriers_slug,
        'title'   => $title,
    ];
    $response = $trackings->create($tracking_code, $tracking_info);
    $find_product = DB::table('buyed_products')->where('order_id',$order_id)->get();
    foreach ($find_product as $key => $value) {
      $buyed_product = buyed_product::find($value->id);
      $buyed_product->tracking_code = $tracking_code;
      $buyed_product->tracking_title = $title;
      $buyed_product->tracking_slug = $couriers_slug;
      $buyed_product->save();
    }
    echo 'saved';
    


    
    // if($response){
    //    $buyed_single_product = DB::table('buyed_products')->where('order_id',$order_id)->orderBy('id','DESC')->first();
    // }
  }

  public function allCouriers()
  {
    $couriers = new Couriers($this->key);
    $all_couriers = $couriers->all();
    return view('users.dashboard.selling.couriers',compact('all_couriers'));
  }

  public function orderIdSet(Request $request)
  {
     $find_product = DB::table('buyed_products')->where('order_id',$request->id)->first();
     return response(['tracking_code'=>$find_product->tracking_code,'tracking_title'=>$find_product->tracking_title,'tracking_slug'=>$find_product->tracking_slug]);
  }

  public function shippingCheckpoint($code,$slug)
  {
    $trackings = new Trackings($this->key);
    $tracking_info = $trackings->get($slug,$code);

    $courier = new Couriers($this->key);
    $courier = $courier->detect($code);

    $check_point = new LastCheckPoint($this->key);
    $last_check_point = $check_point->get($slug,$code);

    return view('users.dashboard.selling.check_point',compact('tracking_info','courier','last_check_point'));
  }
  public function showTracking(Request $request){
    $find_product = DB::table('buyed_products')->where('order_id',$request->id)->first();
    $html = '<tr>';
    $html .= '<td>'.$find_product->tracking_code.'</td>';
    $html .= '<td>'.$find_product->tracking_title.'</td>';
    $html .= '<td>'.$find_product->tracking_slug.'</td>';
    $html .= '</tr>';
    return response(['html'=>$html,'tracking_slug'=>$find_product->tracking_slug]);
  }
  public function deleteTracking(Request $request)
  {
    $id = $request->showingTrackingId;
    $slug = $request->showingTrackingSlug;

    $find_product = DB::table('buyed_products')->where('order_id',$id)->get();

    $find_product_single = DB::table('buyed_products')->where('order_id',$id)->first();
    
    $trackings = new Trackings($this->key);
    $response = $trackings->delete($find_product_single->tracking_slug,$find_product_single->tracking_code);
    if($find_product){
      foreach ($find_product as $key => $product) {
        $update = buyed_product::find($product->id);
        $update->tracking_code ='';
        $update->tracking_title ='';
        $update->tracking_slug ='';
        $update->save();
      }
    }

    
    echo 'deleted';
  }

  public function productRatingPage($id)
  {
    $product = buyed_product::find($id);
    return view('users.dashboard.buy.rating',compact('product'));
  }
  
  public function productFeedback(Request $request)
  {
     if($request->product_rating =='')
     {
      return back()->with('rating_error','Please give rating.....');
     }else{

      $feedback = new feedback;
      $feedback->buyed_product_id = $request->buyed_product_id;
      $feedback->product_id = $request->product_id;
      $feedback->rating = $request->product_rating;
      $feedback->comment = $request->comment;
      $feedback->save();
      return redirect()->back();
     }

  }

  public function slimTest()
  {
    return view('users.crop_test');
  }

  public function slimUpload(Request $request)
  {

     if ( $request->avatar)
    {
       foreach ($request->avatar as $key => $value) {
        # code...
      // dd($request->avatar);
        // Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
        // $come = Slim::getImages();
        $image = head(Slim::getImages($value));
        // Grab the ouput data (data modified after Slim has done its thing)
        // print_r($image);
        if ( isset($image['output']['data']) )
        {
           // Original file name
            $name = $image['input']['name'];

            // Base64 of the image
            $data = $image['output']['data'];

            // Server path
            $path = base_path() . '/public/avatars/';

            // Save the file to the server
            $file = Slim::saveFile($data, $name, $path);

            //Get the absolute web path to the image
            // $imagePath = asset('avatars/' . $file['name']);

            // $user->avatar = $imagePath;
            // $user->save();
        }else{
          echo 'no output';
        }
       }
    }else{
      echo 'no data';
    }


  }


  }
