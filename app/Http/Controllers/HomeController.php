<?php

namespace App\Http\Controllers;
use DB;
use File;
use App\Shop;
// use Request;
use App\UserProduct;
use App\ShopCountry;
use App\ShopCurrency;
use App\ShopLanguage;
use App\MenuCategory;
use App\MenuSubCategory;
use App\MenuTriSubCategory;
use Illuminate\Http\Request;
use App\UserProfile\UpdateProfile;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        // $url = 'http://tamalmanager.aladino.lt/domain.php';
        // $json = file_get_contents($url);
        // $result = json_decode($json, true);
        // foreach ($result as  $value) {
        //     $arr[]= $value['domain_name'];
        // }
        // $hostName = Request::server ("HTTP_HOST");
        // if(in_array($hostName, $arr)){
            return view('front-end.myhome');
        // }else{
        //     return view('product.error');
        // }
        
    }
    public function editProfile()
    {
        $ProfileInfo = UpdateProfile::where('user_id',Auth()->user()->id)->first();
        $include_profile = explode(',', $ProfileInfo->showing_item);
        return view('product.edit-profile',compact('ProfileInfo','include_profile'));
    }
     public function imageCrop()
    {
        return view('front-end.uploadImage');
    }
    public function imageCropPost(Request $request)
    {
        $data = $request->image;


        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);
        $image_name= time().'.png';
        $path = public_path() . "/user-image/" . $image_name;


        file_put_contents($path, $data);
        if($request->image){
         $db_check = DB::table('update_profiles')->select('id')->where('user_id',Auth()->user()->id)->first();
          if($db_check){
            $UpdateProfile = UpdateProfile::find($db_check ->id);
             $UpdateProfile->image = $image_name;
              $UpdateProfile->save();
          }else{
            $UpdateProfile = new UpdateProfile;
            $UpdateProfile->user_id = Auth()->user()->id;
            $UpdateProfile->image = $image_name;
            $UpdateProfile->save();
          }
      }

        return response()->json(['success'=>$image_name]);
    }
    public function updateProfile(Request $request)
    {

        $db_check = DB::table('update_profiles')->select('id')->where('user_id',Auth()->user()->id)->first();

        if($db_check){
            $UpdateProfile = UpdateProfile::find($db_check ->id);
            $showing_item_get = $request->include_profile;

            if($showing_item_get){
                $showing_item = implode(',', $showing_item_get);
                $UpdateProfile->showing_item = $showing_item;
            }
       
            if($request->image){
                $image = $request->file('image');
                $imageName  = rand().'.'.$image->getClientOriginalExtension();
                $image->move('user-image',$imageName);
                $UpdateProfile->image = $imageName;
            }
            $UpdateProfile->user_id = Auth()->user()->id;
            $UpdateProfile->gender = $request->gender;
            $UpdateProfile->city = $request->city;
            $UpdateProfile->birthday = $request->birthday;
            $UpdateProfile->about = $request->about;
            $UpdateProfile->favorite = $request->favorite_metrials;        
            $UpdateProfile->save();

       }else{

            $UpdateProfile = new UpdateProfile;
            $showing_item_get = $request->include_profile;

            if($showing_item_get){
                $showing_item = implode(',', $showing_item_get);
                $UpdateProfile->showing_item = $showing_item;
            }
        
       
            if($request->image){
                $image = $request->file('image');
                $imageName  = rand().'.'.$image->getClientOriginalExtension();
                $image->move('user-image',$imageName);
                $UpdateProfile->image = $imageName;
            }

        
            $UpdateProfile->user_id = Auth()->user()->id;
            $UpdateProfile->gender = $request->gender;
            $UpdateProfile->city = $request->city;
            $UpdateProfile->birthday = $request->birthday;
            $UpdateProfile->about = $request->about;
            $UpdateProfile->favorite = $request->favorite_metrials;        
            $UpdateProfile->save();
       }

       return back();
    }

    public function createShop()
    {
         $ShopCountry = ShopCountry::all();
         $ShopCurrency  = ShopCurrency::all();
         $ShopLanguage  = ShopLanguage::all();
         $shops = DB::table('shops')->where('user_id',Auth()->user()->id)->first();

        return view('front-end.create-shop',compact('ShopCountry','ShopCurrency','ShopLanguage','shops'));
    }
    public function shop()
    {
        return view('front-end.shop');
    }

    public function checkShopeName(Request $request)
    {

        return response()->json(['success'=>$request->val]);
    }
    public function ShopStore(Request $request)
    {
        $db_check = DB::table('shops')->select('id')->where('user_id',Auth()->user()->id)->first();
        if($db_check){
            $Shop = Shop::find($db_check->id);
            $Shop->user_id = Auth()->user()->id;
            $Shop->country_id = $request->country;
            $Shop->language_id = $request->language;
            $Shop->currency_id = $request->currency;
            $Shop->shop_name = $request->shopname;
            $Shop->shop_title = $request->shoptitle;
            $Shop->about_shop = $request->aboutshop;
            $Shop->save();
        }else{
            $Shop = new Shop;
            $Shop->user_id = Auth()->user()->id;
            $Shop->country_id = $request->country;
            $Shop->language_id = $request->language;
            $Shop->currency_id = $request->currency;
            $Shop->shop_name = $request->shopname;
            $Shop->shop_title = $request->shoptitle;
            $Shop->about_shop = $request->aboutshop;
            $Shop->save();
        }
        return back();
        
    }

    public function createProduct()
    {
        $categories = MenuCategory::all();
        $subcategory = MenuSubCategory::all();
        $MenuTriSubCategory = MenuTriSubCategory::all();
        return view('front-end.create-product',compact('categories','subcategory','MenuTriSubCategory'));
    }
    public function getSubCategory(Request $request)
    {
        
        $sub_categorories = MenuSubCategory::where('category_id', $request->id )->get();
        $item = '';
        foreach ($sub_categorories  as  $sub_categorory) {
            $item .='<option value="'.$sub_categorory->id.'">'.$sub_categorory->sub_category_name.'</option>';
            
        }
        echo $item;

       
        //return response()->json(['msg'=>$sub_category_id]);
    }
    public function getTriSubCategory(Request $request)
    {
        
        $sub_categorories = MenuTriSubCategory::where('sub_category_id', $request->id )->get();
        $item = '';
        foreach ($sub_categorories  as  $sub_categorory) {
            $item .='<option value="'.$sub_categorory->id.'">'.$sub_categorory->tri_sub_category_name.'</option>';
            
        }
        echo $item;





        //return response()->json(['msg'=>$sub_category_id]);
    }

    public function StoreUserProduct(Request $request)
    {

        $db_check = DB::table('shops')->select('id')->where('user_id',Auth()->user()->id)->first();

            $UserProduct = new UserProduct;
            $UserProduct->user_id = Auth()->user()->id;
            $UserProduct->shop_id = $db_check->id;
            $UserProduct->category_id = $request->category;
            $UserProduct->sub_category_id = $request->sub_category;
            $UserProduct->tri_sub_category_id = $request->tri_sub_category;
            $UserProduct->product_title = $request->product_title;
            $UserProduct->price = $request->product_price;
            $UserProduct->reviews = 0;
            $UserProduct->order = 0;
            $UserProduct->size = '';
            $UserProduct->return_polichy = '';
            $UserProduct->description = $request->aboutshop;
            $UserProduct->who_made_it = $request->who_made_it;
            $UserProduct->what_is_it = $request->who_is_it;
            $UserProduct->save();
            return back();

    }







     
}
