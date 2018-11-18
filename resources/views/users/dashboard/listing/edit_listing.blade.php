@extends('users.dashboard.layout')
@section('otherStyle')
    <link href="{{asset('users/assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" />

    <link href="{{asset('users/assets/css/jquery.masterblaster.css')}}" rel="stylesheet" />

    <link href="{{asset('users/assets/vendors/dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/dropzone/dist/min/basic.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/css/tagify.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/alertifyjs/dist/css/alertify.css')}}" rel="stylesheet" />
@endsection

@section('otherCss')
<style type="text/css">
    sup{
        color:red;
    }
    input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
.imageThumb {
    max-height: 75px;
    border: 1px dotted orange;
    padding: 1px;
    cursor: pointer;
}
</style>
@endsection

<!-- basic-info -->
@section('content')
   <div class="col-md-12">
   <form action="{{url('listing_update')}}" method="post" enctype="multipart/form-data">
       <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">
                Product Specfication
                </div>
            </div>
            <div class="ibox-body">
            
                <div class="row">
                    <div class="col-md-12">
                    @if(session('success'))
                         <div class="alert alert-primary alert-dismissable fade show has-icon"><i class="la la-check alert-icon"></i>
                        <button class="close" data-dismiss="alert" aria-label="Close"></button><strong>Well done!</strong><br>{{session('success')}}</div>
                    @endif   
                    </div>
                    <div class="col-md-6">
                       <div class="form-group mb-4">
                            <label>Product Category <sup>*</sup></label>
                            <select class="form-control" id="category" name="category" >
                            <option  selected value> select category </option>
                            @foreach($categories as $cat)
                              <option value="{{$cat->id}}" <?php
                              if($UserProducts->category_id==$cat->id){echo'selected';}
                              ?> >{{$cat->category_name}}</option>
                            @endforeach
                            
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label>Product Final Category <sup>*</sup></label>
                            <select class="form-control" id="tri_sub_category" name="tri_sub_category" >


                            <!-- <option  selected value> select final category </option> -->

                             <?php
                            $triSubCategory = DB::table('menu_tri_sub_categories')->where('sub_category_id',$UserProducts->sub_category_id)->get();
                            if($triSubCategory){
                              foreach ($triSubCategory as $triSubCategory) {
                           ?>
                           <option value="{{$triSubCategory->id}}">{{$triSubCategory->tri_sub_category_name}}</option>
                           <?php } } ?>

                               
                            </select>
                        </div>
                       
                         <div class="form-group mb-4">
                            <label>Discount Price</label>
                            <input class="form-control" type="text" placeholder="discount should be (10%)" name="discount" value="{{$UserProducts->discount}}">
                        </div>
                        <?php 

                          $custom_category = DB::table('custom_categories')->where('user_id',Auth()->user()->id)->get();
                        ?>
                         <div class="form-group mb-4">
                            <label>Custom Category <sup>*</sup></label>
                            <select class="form-control" id="custom_category" name="custom_category">
                            <option  selected value> select custom category </option>
                            <option  value="create_custom_category"> Create New Category </option>
                            <?php
                              if($custom_category){
                                foreach ($custom_category as $key => $custom_category) {
                               
                            ?>
                             <option  value="{{$custom_category->category}}"

                             <?php 

                              if($UserProducts->custom_category == $custom_category->category){
                                echo 'selected';
                              }
                             ?>

                             > {{$custom_category->category}} </option>

                             <?php } } ?>
                            </select>
                            <div class="form-horizontal row" id="custom_category_name" style="display: none;">
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" placeholder="Crate New Custom Category" id="custom_category_val" name="custom_category_val" style="margin-top: 20px;" >
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary mr-2" type="button" id="category_create_button" style="margin-top: 20px">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group mb-4">
                            <label>Product Sub Category <sup>*</sup></label>
                            <select class="form-control" id="sub_category" name="sub_category">
                           <!--  <option  selected value> select sub category </option> -->
                           <?php
                            $subCategory = DB::table('menu_sub_categories')->where('category_id',$UserProducts->category_id)->get();
                            if($subCategory){
                              foreach ($subCategory as $subCategory) {
                           ?>
                           <option value="{{$subCategory->id}}">{{$subCategory->sub_category_name}}</option>
                           <?php } } ?>
                               
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label>Product Title<sup>*</sup></label>
                            <input class="form-control" type="text" placeholder="product title" name="product_title" value="{{$UserProducts->product_title}}" >
                        </div>
                         
                          <div class="form-group mb-4">
                            <label>Product Price <sup>*</sup></label>
                            <input class="form-control" type="text" placeholder="product price " name="product_price" value="{{$UserProducts->price}}">
                        </div>
                        <div class="form-group mb-4">
                            <label>Thumbnail Image<sup>*</sup></label>
                            <br/>
                             <label class="btn btn-primary file-input mr-2">

                                <span class="btn-icon"><i class="la la-cloud-upload"></i>Browse file</span>
                                <input type="file" name="thumbnail_image">
                             </label>
                        </div>


                    </div> 
                </div> 
            </div>
      </div>
    <!-- step -2 -->
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
            Image Specfication
            </div>
        </div>
        <div class="ibox-body">
            <div class="row">
            <div class="col-md-6">
                   <div class="form-group mb-4 text-center">
                        <label class="radio radio-outline-success" id="samePrice">
                            <input type="radio" name="color" value="same_price" checked>
                            <span class="input-span"></span>Different Color Same Price
                        </label>
                    </div>
                </div>

                <div class="col-md-6" class="">
                   <div class="form-group mb-4 text-center">
                        <label class="radio radio-outline-success" id="differentPrice">
                            <input type="radio" name="color" value="diff_price">
                            <span class="input-span"></span>Different Color Different Price
                        </label>
                    </div>
                </div>
                

                <div class="col-md-12" id="abc" style="border: 2px dotted orange;padding: 20px;">
                   <div class="field" align="left">
                      <input type="file" id="files" name="same_product_img[]" multiple />
                      <?php
                        $samePrice = DB::table('same_prices')->where('product_id',$UserProducts->id)->get();
                        if($samePrice){
                          foreach ($samePrice as $samePrice) {
                      ?>
                      <span class="pip">
                        <img src="{{asset('users/product-image/'.$samePrice->img)}}" class="imageThumb">
                        <br>
                        <span class="same_remove_from_db remove" id="{{$samePrice->id}}">Remove</span>
                      </span>
                      <?php } } ?>
                    </div>
                </div>  
            </div>
        <div  id="myrep" style="display: none;">
                    <h4 align="center">Enter Item Details</h4>
                   <br />
                    <div class="table-repsonsive">
                     <span id="error"></span>
                     <table class="table table-bordered" id="item_table">
                      <tr>
                       <th>Chose Image</th>
                       <th>Enter Price</th>
                       <th><button type="button" name="add" class="btn btn-gradient-aqua btn-fix add">Add Row</button></th>
                      </tr>

                      <?php
                        $different_color = DB::table('different_prices')->where('product_id',$UserProducts->id)->get();
                        if($different_color){
                          foreach ($different_color as $different_color) {

                      ?>
                      <tr>
                        <td><div class="form-group">
                          <img src="{{asset('users/product-image/'.$different_color->img)}}" style="height: 50px; width: 50px;">
                        </div></td>
                        <td><input type="text" name="noname" class="form-control item_quantity" value="{{$different_color->price}}" readonly /></td>
                        <td><button type="button" name="remove" class="btn btn-gradient-aqua btn-fix remove" value="{{$different_color->id}}" style="border:none">Remove</button></td></tr>
                      </tr>
                      <?php } } ?>

                     </table>
                     <div align="center">
                     
                     </div>
                    </div>
         </div>
         </div>
    </div>


    <!-- end step 2 -->

    <!-- step 3 -->
     <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">
                Size Specfication
                </div>
            </div>
            <div class="ibox-body">
            <div id="sizeSp">
                <div class="row">
                    <div class="col-md-6">
                      <input name="tags" id="tags" placeholder="Enter size" value="{{$UserProducts->size}}">
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group mb-4">
                             <label class="btn btn-primary file-input mr-2" style="">
                                <span class="btn-icon"><i class="la la-cloud-upload"></i>Browse file</span>
                                <input type="file" name="sizeFile">
                             </label>
                        </div>
                    </div> 

                </div>  
            </div>
             
      </div>
      </div>

    <!-- end step 3 -->

    <!-- step 4 -->
         <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">
                Shipping Infomation
                </div>
            </div>
            <div class="ibox-body">
                <div class="row">
                    <div class="col-md-6">
                       <div class="form-group mb-4">
                            <label>Shipping Cost</label>
                            <select class="form-control" name="shipping_const">
                            <option  selected value> Select Shipping </option>
                            <option value="i_will_fix_cost"
                            <?php
                              if($UserProducts->shipping_cost =='i_will_fix_cost'){
                                echo 'selected';
                              }
                            ?>
                            > I will enter fixed cost manually </option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label>Shipping Origin</label>
                            <select class="form-control" name="shipping_origin" id="ShippingOriginName">
                            <option  selected value> Select Origin </option>
                            @foreach($ShopCountry as $shop_country)
                            <option value="{{$shop_country->shop_country}}"
                            <?php if($shop_country->shop_country==$UserProducts->shipping_origin){echo'selected';}?>
                            > {{$shop_country->shop_country}} </option>
                            @endforeach
                            </select>
                        </div>

                    </div> 
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                                <label></label>
                                 <p>Estimate and enter shipping costs yourself, including any multiple-item discounts, shipping upgrades or international options you'll offer.</p>
                        </div>
                        <div class="form-group mb-4">
                            <label>Processing time</label>
                            <select class="form-control" id="custom_range" name="processing_time">
                            <option  selected value> Select processing time </option>
                            <option value="{{$UserProducts->processing_time}}" selected>{{$UserProducts->processing_time}}</option>
                            <option value="1 business day">1 business day</option>
                            <option value="1-2 business day">1-2 business day</option>
                            <option value="2-3 business day">2-3 business day</option>
                            <option value="3-5 business day">3-5 business day</option>
                            <option value="1-2 weeks">1-2 weeks</option>
                            <option value="2-3 weeks">2-3 weeks</option>
                            <option value="3-4 weeks">3-4 weeks</option>
                            <option value="4-6 weeks">4-6 weeks</option>
                            <option value="6-8 weeks">6-8 weeks</option>
                            <option value="custom_range"> Custom Range </option>
                            <option value="Unknon"> Unknon</option>
                            </select>
                        </div>
                         

                         <div class="form-inline form-success mb-4 from-to" style="display: none">
                           <label class="sr-only" for="ex-pass">Email</label>
                            <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="ex-pass"  placeholder="From" style="width: 231px" name="from_day">
                            <option selected value>From</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            </select>
                            <label class="sr-only" for="ex-pass">To</label>
                            <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="ex-pass"  placeholder="From" style="width: 257px" name="to_day">
                            <option selected value>To</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            </select>
                            
                            <label class="radio radio-outline-success" id="differentPrice" style="margin-top: 19px; margin-right: 27px">
                                <input type="radio" name="custom_day" value="business days">
                                <span class="input-span"></span>business days
                            </label>
                             <label class="radio radio-outline-success" id="differentPrice" style="margin-top: 19px;">
                                <input type="radio" name="custom_day" value="weeks">
                                <span class="input-span"></span>weeks
                            </label>

                            
                        </div>

                    </div> 



                </div>  
                
            </div>
      </div>




     







    <!-- step 4 end -->

    <!-- step 5 -->
     <div class="ibox">
        
            @csrf
            <div class="ibox-head">
                <div class="ibox-title">
                Fixed shipping costs
                </div>
            </div>
            <div class="ibox-body">
                
                 <div class="form-horizontal repeater" id="repeter">
                    <div class="ibox-body">
                        <div class="form-group mb-4 row">
                            <label class="col-sm-2 col-form-label" id="ChangeOriginCountry">{{$UserProducts->shipping_origin}}</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="origin_shipping_cost" placeholder="price ($)" value="<?php if($UserProducts->origin_cost=='Free Shipping'){}else{echo $UserProducts->origin_cost;}?>">
                                    

                               
                            </div>
                             <div class="col-sm-4">
                                <label class="checkbox checkbox-primary" style="margin-top: 6px;">
                                    <input type="checkbox" name="origin_shipping_cost" value="Free Shipping"

                                    <?php
                                     if($UserProducts->origin_cost =='Free Shipping'){
                                        echo 'checked';
                                      }

                                    ?>
                                    >
                                    <span class="input-span"></span>Free Shipping
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <label class="col-sm-2 col-form-label">Everywhere Else</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="everywhere_shipping_cost" placeholder="price ($)" value="<?php if($UserProducts->everywhere_cost=='Free Shipping'){}else{echo $UserProducts->everywhere_cost;}?>">

                               
                            </div>
                             <div class="col-sm-4">
                                 <label class="checkbox checkbox-primary" style="margin-top: 6px;">
                                    <input type="checkbox" name="everywhere_shipping_cost" value="Free Shipping"

                                     <?php
                                     if($UserProducts->everywhere_cost =='Free Shipping'){
                                        echo 'checked';
                                      }

                                    ?>

                                    >
                                    <span class="input-span"></span>Free Shipping
                                </label>
                            </div>
                        </div>


                        
                         <div class="locationRept">
                         <?php
                          $shipping_location = DB::table('product_shipping_locations')->where('product_id',$UserProducts->id)->get();
                          if($shipping_location){
                            foreach ($shipping_location as  $shipping_location) {
                             
                         ?>
                          <div class="form-group mb-4 row">
                             <label class="col-sm-2 col-form-label">Location</label>
                             <div class="col-sm-3">
                               <select class="form-control" name="shipping_location[]" required> 
                                <option selected value"> Select Origin </option>
                                <?php foreach ($ShopCountry as $shop_country){?>
                                <option value="<?php echo $shop_country->shop_country;?>"

                                <?php if($shop_country->shop_country==$shipping_location->location){echo 'selected';}?>
                                >
                                <?php echo $shop_country->shop_country; ?></option><?php } ?>
                               </select> 
                              <label class="checkbox checkbox-primary" style="margin-top: 14px;">
                              <input type="checkbox" name="total_shipping_cost[]" value="Free Shipping" <?php if($shipping_location->cost=='Free Shipping'){echo'checked';}?> ><span class="input-span"></span>Free Shipping</label>
                             </div>
                             <div class="col-sm-3">  
                               <input class="form-control" type="text" placeholder="price ($)" name="total_shipping_cost[]" value="<?php if($shipping_location->cost=='Free Shipping'){}else{echo $shipping_location->cost;}?>">
                             </div>
                             <div class="col-sm-2"><button type="button" id="locationRemove" value="{{$shipping_location->id}}" class="btn btn-gradient-aqua btn-fix" />Delete</button></div>
                          </div> 
                          <?php } } ?>

                          
                        </div>
                      <input type="button" id="locationRepter" class="btn btn-gradient-lime btn-rounded btn-fix" value="Add a Location"/>
                        
                    </div>
                    
          </div>
       </div>
       

    <!-- end step 5 -->
    <input type="hidden" name="product_id" value="{{$UserProducts->id}}">
    <!-- start step 6 -->
         <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">
                Metirial and  Description
                </div>
            </div>
            <div class="ibox-body">
                <div class="row">
                    <div class="col-md-6">
                      <input name="tags2" id="tags" placeholder="Enter Tags" value="{{$UserProducts->tags}}">
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group mb-4">
                            <input name="meterials" id="tags" placeholder="Enter Meterials" value="{{$UserProducts->meterials}}">
                        </div>
                    </div>
                     <div class="col-md-12">
                        <label>About Product <sup>*</sup></label>
                         <textarea id="summernote" data-plugin="summernote" data-air-mode="true"  name="product_details" required>
                          {{$UserProducts->description}}
                         </textarea>
                    </div> 

                </div>  
            </div>
             <div class="ibox-footer text-right">
                <button type="submit" class="btn btn-primary mr-2" type="submit" name="savemode" value="save">
                    Update and Publish
                </button>
                 <button type="submit" class="btn btn-primary mr-2" type="submit">
                    Save to draft
                </button>
                

           </div>
      </div>
</div>

 </form>
@endsection
@section('otherScript')
<script src="{{asset('users/assets/vendors/summernote/dist/summernote.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap-markdown/js/bootstrap-markdown.js')}}">
</script>
<script src="{{asset('users/assets/vendors/dropzone/dist/min/dropzone.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"></script>

<script src="{{asset('users/assets/js/jQuery.tagify.js')}}"></script>
<script src="{{asset('users/assets/vendors/alertifyjs/dist/js/alertify.js')}}"></script>
@endsection

@section('otherJs')
<script>
        $(function() {
            $('#summernote').summernote();
            $('#summernote_air').summernote({
                airMode: true
            });
        });
</script>
<script>
        Dropzone.options.mydropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 5, // MB
            dictDefaultMessage: '<div class="text-center mb-3"><i class="la la-cloud-upload text-primary" style="font-size:50px"></i></div> <strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)',
            init: function() {
                this.on("addedfile", function(file) {
                    var removeButton = Dropzone.createElement("<a href='javascript:;'' class='btn btn-danger btn-sm btn-block'>Remove</a>");
                    var _this = this;
                    removeButton.addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        _this.removeFile(file);
                    });
                    file.previewElement.appendChild(removeButton);
                });
            }
        }
    </script>
    <script>
    $(document).ready(function () {
        $('.repeater').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater'
            }]
        });
        
    });
</script>
<script>
    $(document).ready(function(){
        $('#samePrice').click(function(){
            $('#abc').fadeIn('1000');
            $('#myrep').hide(); 
            
        });
         $('#differentPrice').click(function(){
            $('#abc').hide();
            $('#myrep').fadeIn('1000'); 
        });
        
    });
</script>
<script>
    $(document).ready(function(){
        $('[id=tags]').tagify();
    });
</script>
<script>
    $(document).ready(function(){
        $('#custom_range').change(function(){
            var val = $(this).val();
            if(val=='custom_range'){
                $('.from-to').fadeIn();
            }else{
                $('.from-to').hide('first');
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        // $('#repeter').on('submit',function(){
        //     console.log($('.repeater').repeaterVal());
        //     return false;
        // });

        $('#testBtn').click(function(){
            alertify.alert("Message");
            alertify.error("You've clicked Cancel");
        });
    });
</script>

<script type="text/javascript">
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


    $(document).ready(function(){
       $('#category').change(function(){
        var id  = $(this).val();
        alert(id);
        $('#sub_category').val([]);
        $.ajax({
            type:'POST',
            url:'{{url("get-sub-category")}}',
            data: {id:id},
            success:function(response){
                $("#sub_category option:selected").prop("selected", false)
                $('#sub_category').html(response);
               
                
            }
        });

       });
    });


    $(document).ready(function(){
       $('#sub_category').change(function(){
        var id  = $(this).val();
        $.ajax({
            type:'POST',
            url:'{{url("get-tri_sub-category")}}',
            data: {id:id},
            success:function(response){
                $('#tri_sub_category').html(response);
                console.log(response);
                
            }
        });

       });
    });

    $(document).ready(function(){
        $('#basic-info').on('submit', function(){
           // var val = $("input[type=submit][clicked=true]").val();
           // alert(val);
            $.ajax({
                type:'POST',
                url:'add-data',
                processData: false,
                contentType: false,
                data: new FormData(this),
                success:function(response){
                    
                    if(response=='success'){
                         alertify.success('Product Successfully Added');
                    }



                   
                    
                }
            });

            return false;
        });
        
    });


    $(document).ready(function(){
        $('.colorRep').on('submit', function(){
            console.log($('.repeater').repeaterVal());
            $.ajax({
                type:'POST',
                url:'colorStore',
                processData: false,
                contentType: false,
                data: $('.repeater').repeaterVal(),
                success:function(response){
                    // if(response.save == 'save'){
                    //     alertify.success('Product Successfully Saved');
                    //     $('#global_id').val(response.id);
                    // }
                    // if(response.update == 'update'){
                    //     alertify.success('Product Successfully Update');
                    // }
                    console.log(response);

                   
                    
                }
            });

            return false;
        });
        
    });

        $(document).ready(function(){
        $('#sizeSp').on('submit', function(){
            $.ajax({
                type:'POST',
                url:'sizeStore',
                processData: false,
                contentType: false,
                data: new FormData(this),
                success:function(response){
                    if(response== 'previes'){
                        alertify
                          .okBtn("Accept")
                          .cancelBtn("Deny")
                          .confirm("Confirm dialog with custom button labels", function (ev) {
                              ev.preventDefault();
                              alertify.success("You've clicked OK");
                          }, function(ev) {
                              ev.preventDefault();
                              alertify.error("You've clicked Cancel");
                          });
                    }else{
                        alertify.success("Size Successfully Saved");
                    }
                   
                    console.log(response);
                }
            });

            return false;
        });
        
    });


  $(document).ready(function(){
        $('#productDetails').on('submit', function(){

            $.ajax({
                type:'POST',
                url:'productDetailsStore',
                processData: false,
                contentType: false,
                data: new FormData(this),
                success:function(response){
                    if(response== 'previes'){
                        alertify
                          .okBtn("Accept")
                          .cancelBtn("Deny")
                          .confirm("Confirm dialog with custom button labels", function (ev) {
                              ev.preventDefault();
                              alertify.success("You've clicked OK");
                          }, function(ev) {
                              ev.preventDefault();
                              alertify.error("You've clicked Cancel");
                          });
                    }else{
                        alertify.success("Product Details Successfully Saved");
                    }
                   
                    console.log(response);
                }
            });

            return false;
        });
        
    });

   



  //test data   ..............

  $(document).ready(function(){
 
     $(document).on('click', '.add', function(){
      var html = '';
      html += '<tr>';
      html += '<td><div class="form-group"><label class="btn btn-primary file-input"><span class="btn-icon"><i class="la la-cloud-upload"></i>Browse file</span> <input type="file" name="item_img[]"></label></div></td>';
      html += '<td><input type="text" name="item_price[]" class="form-control item_quantity" /></td>';
      html += '<td><button type="button" name="remove" class="btn btn-gradient-aqua btn-fix remove" style="border:none">Remove</button></td></tr>';
      $('#item_table').append(html);
     });
     
     $(document).on('click', '.remove', function(){
       $(this).closest('tr').remove();
            var id = $(this).val();
            $.ajax({
                type:'POST',
                url:'{{url("delete_different_color")}}',
                data: {id:id},
                success:function(response){
                  if(response =='deleted'){
                   
                     toastr["success"]("Successfully deleted");
                  }
                }
            });
     });

      $('#insert_form').on('submit', function(event){
        event.preventDefault();
         $.ajax({
                type:'POST',
                url:'dataTest',
                processData: false,
                contentType: false,
                data: new FormData(this),
                success:function(response){
                    console.log(response)
                }
            });
      });
});     


$(document).on('click', '#locationRepter', function(){
      var html = '';
      html += '<div class="form-group mb-4 row"><label class="col-sm-2 col-form-label">Location</label><div class="col-sm-3"><select class="form-control" name="shipping_location[]" required> <option selected value"> Select Origin </option><?php foreach ($ShopCountry as $shop_country){?><option value="<?php echo $shop_country->shop_country;?>"><?php echo $shop_country->shop_country; ?></option><?php } ?></select> <label class="checkbox checkbox-primary" style="margin-top: 14px;"><input type="checkbox" name="total_shipping_cost[]" value="Free Shipping"><span class="input-span"></span>Free Shipping</label></div>';
      html += '<div class="col-sm-3"> <input class="form-control" type="text" placeholder="price ($)" name="total_shipping_cost[]"> </div>';
      
        html += '<div class="col-sm-2"><input type="button" id="locationRemove"value="Delete" class="btn btn-gradient-aqua btn-fix" /></div></div>';
                            
      $('.locationRept').append(html);
      console.log(html);

  });
     
     $(document).on('click', '#locationRemove', function(){
       $(this).closest('.form-group').remove();
     });

    

    $(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove</span>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});

    $(document).ready(function(){
        $('#custom_category').change(function(){
            var val = $(this).val();
            if(val=='create_custom_category'){
                $('#custom_category_name').show();
            }else{
                $('#custom_category_name').hide();
            }
            
        });


        $('#category_create_button').click(function(){
            var val = $('#custom_category_val').val();
            var html = '<option value="'+val+'">'+val+'</option>';
            $('#custom_category').append(html);
             $('#custom_category_name').hide();

        });
    });

</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#ShippingOriginName').change(function(){
      var val = $(this).val();
      $('#ChangeOriginCountry').html(val);
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
   $(".same_remove_from_db").click(function(){
       $(this).parent(".pip").remove();
      var id = $(this).attr('id');
      alert(id);
            $.ajax({
                type:'POST',
                url:'{{url("delete_same_color")}}',
                data: {id:id},
                success:function(response){
                  if(response =='deleted'){
                   
                     toastr["success"]("Successfully deleted");
                  }
                }
            });

    });
  }); 
</script>
@endsection



