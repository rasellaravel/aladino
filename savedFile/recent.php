<?php 

public function allData(Request $request)
{
        //basic info  
  $UserProduct = new UserProduct;
  if($request->savemode=='save'){
    $UserProduct->status = 1;
  } 

  $category_id = $request->category;
  $sub_category = $request->sub_category;
  $tri_sub_category = $request->tri_sub_category;
  $discount = $request->discount;
  
  $product_title = $request->product_title;
  $product_price = $request->product_price;

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
  
  $UserProduct->save();

  if($request->custom_category){
     $findCategory = customCategory::where('category',$request->custom_category)->first();
      if(!$findCategory){
        $customCategory = new customCategory;
        $customCategory->user_id = Auth()->user()->id;
        $customCategory->product_id = $UserProduct->id;
        $customCategory->shop_id = $shop_id->id;
        $customCategory->category = $request->custom_category;
        $customCategory->save();
        $customCategoryId = $customCategory->id;
      }else{
        $customCategoryId = $findCategory->id;
      }
  }else{
     $customCategoryId ='';
  }

  $product_id = $UserProduct->id;
  $UserProductUpdate = UserProduct::find($product_id);

            // image specification goes differect table with product_id
  if($request->color == 'diff_price'){
    $imgs = $request->file('item_img');
    if($request->item_price){
      for ($count=0; $count < count($request->item_price); $count++) { 
       $differentPrice = new differentPrice;
       $img = $imgs[$count];
       $thumb = rand().'.'.$img->getClientOriginalExtension();
       $img->move(public_path("users/product-image"),$thumb);
       $differentPrice->product_id = $product_id;
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
                 $SamePrice->product_id = $product_id;
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
         $UserProductUpdate->size_img =  $thumb;
       }
       $UserProductUpdate->size =  $main_size;


       $UserProductUpdate->custom_category =  $customCategoryId;
       

        // shipping info 
       
       $UserProductUpdate->shipping_cost = $request->shipping_const; 
       $UserProductUpdate->shipping_origin = $request->shipping_origin; 
       $processing_time = $request->processing_time; 
        if($processing_time=='custom_range'){             //same table
         $from_day = $request->from_day; 
         $to_day = $request->to_day; 
         $custom_day = $request->custom_day;
         $processing_time = $from_day.' - '.$to_day.' '.$custom_day;
       }
       $UserProductUpdate->processing_time = $processing_time;

       $UserProductUpdate->origin_cost = $request->origin_shipping_cost;
       $UserProductUpdate->everywhere_cost = $request->everywhere_shipping_cost;
       $UserProductUpdate->save();

       $shipping_location = $request->shipping_location;
       
       if($shipping_location){
        $location_shipping_cost = array_filter($request->total_shipping_cost);
        for ($count=0; $count < count($request->shipping_location); $count++) { 

          $ProductShippingLocation  = new ProductShippingLocations;
          $ProductShippingLocation->product_id = $product_id;
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
      $UserProductUpdate->tags = $main_tags;
      $UserProductUpdate->meterials = $main_meterials;
      $UserProductUpdate->description = $des;
      $UserProductUpdate->save();
      return redirect('product_listin')->with('add_listin_success','success');
      
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