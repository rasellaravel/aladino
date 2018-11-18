@extends('users.dashboard.layout')
@section('otherStyle')
    <link href="{{asset('users/assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" />

    <!-- <link href="{{asset('users/assets/css/jquery.masterblaster.css')}}" rel="stylesheet" /> -->
    <link href="{{asset('users/assets/css/tagify.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/alertifyjs/dist/css/alertify.css')}}" rel="stylesheet" />
     <link href="{{asset('users/assets/slim/slim.min.css')}}" rel="stylesheet" />
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

.slim-result img
{
  height: 130px;
}
.slim{height: 130px; margin-bottom: 10px; width: 143px;}
</style>
@endsection

<!-- basic-info -->
@section('content')
<div class="col-md-12">
   <form action="{{url('add-data')}}" method="post" enctype="multipart/form-data">
     <!-- '''''''''''''''''''''''''product specfication ''''''''''''''''''''''''''-->
       @csrf
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
                    <button class="close" data-dismiss="alert" aria-label="Close"></button><strong>Well done!</strong>
                    <br>{{session('success')}}</div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Product Category <sup>*</sup></label>
                    <select class="form-control" id="category" name="first_category" onchange="findSize(this);">
                        <option selected value> select category </option>
                        @foreach($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Product Sub Category <sup>*</sup></label>
                    <select class="form-control" id="sub_category" name="sub_category">
                        <option selected value> select sub category </option>

                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Product Final Category <sup>*</sup></label>
                    <select class="form-control" id="tri_sub_category" name="tri_sub_category_id">
                        <option selected value> select final category </option>

                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Product Title<sup>*</sup></label>
                    <input class="form-control" type="text" placeholder="product title" name="product_title">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Product Price <sup>*</sup></label>
                    <input class="form-control" type="text" placeholder="product price " name="given_product_prices">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Discount Price</label>
                    <input class="form-control" type="text" placeholder="discount should be (10%)" name="discount">
                </div>
            </div>
            <?php 

                          $custom_category = DB::table('custom_categories')->where('user_id',Auth()->user()->id)->get();
                        ?>
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label>Custom Category <sup>*</sup></label>
                        <select class="form-control" id="custom_category" name="custom_category">
                            <option selected value> select custom category </option>
                            <option value="create_custom_category"> Create New Category </option>
                            <?php
                              if($custom_category){
                                foreach ($custom_category as $key => $custom_category) {

                            ?>
                                <option value="{{$custom_category->category}}"> {{$custom_category->category}} </option>

                                <?php } } ?>
                        </select>
                        <div class="form-horizontal row" id="custom_category_name" style="display: none;">
                            <div class="col-sm-9">
                                <input class="form-control" type="text" placeholder="Crate New Custom Category" id="custom_category_val" name="custom_category_val" style="margin-top: 20px;">
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
                    <label class="checkbox checkbox-primary" style="margin-top: 27px;">
                        <input type="checkbox" name="special_product" value="1">
                        <span class="input-span"></span>Special Product
                    </label>
                </div>
            </div>
        </div>
    </div>

      <!-- image uplaod -->
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
                Image Specfication
            </div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="slim" data-label="Drop Thumbnail Image" data-size="1920, 1280" style="color: orange;">
                        <input type="file" name="thumbnail_img" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="slim" data-label="Drop product image" data-size="1920, 1280">
                        <input type="file" name="product_img[]" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="slim" data-label="Drop product image" data-size="1920, 1280">
                        <input type="file" name="product_img[]" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="slim" data-label="Drop product image" data-size="1920, 1280">
                        <input type="file" name="product_img[]" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="slim" data-label="Drop product image" data-size="1920, 1280">
                        <input type="file" name="product_img[]" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="slim" data-label="Drop product image" data-size="1920, 1280">
                        <input type="file" name="product_img[]" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="slim" data-label="Drop product image" data-size="1920, 1280">
                        <input type="file" name="product_img[]" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="slim" data-label="Drop product image" data-size="1920, 1280">
                        <input type="file" name="product_img[]" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="slim" data-label="Drop product image" data-size="1920, 1280">
                        <input type="file" name="product_img[]" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="slim" data-label="Drop product image" data-size="1920, 1280">
                        <input type="file" name="product_img[]" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="slim" data-label="Drop product image" data-size="1920, 1280">
                        <input type="file" name="product_img[]" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="slim" data-label="Drop product image" data-size="1920, 1280">
                        <input type="file" name="product_img[]" />
                    </div>
                </div>
            </div>
        </div>
    </div>





  <!-- '''''''''''''''''''''''''Image Specfication ''''''''''''''''''''''''''''''-->
<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">
            Color Specfication
        </div>
    </div>
    <div class="ibox-body">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div id="myrep">
                    <div class="table-repsonsive">
                        <span id="error"></span>
                        <table class="table table-bordered" id="item_table">
                            <tr>
                                <th>Chose Different Color</th>
                                <th>Enter Color Name</th>
                                <th>
                                    <button type="button" name="add" class="btn btn-gradient-aqua btn-fix" id="add_fuck">Add Row</button>
                                </th>
                            </tr>

                        </table>
                        <div align="center">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>


<!-- '''''''''''''''''''''''''Size Specfication ''''''''''''''''''''''''''''''-->
<div class="ibox" id="show_size_spc" style="display: none;">
    <div class="ibox-head">
        <div class="ibox-title">
            Size Specfication
        </div>
    </div>
    <div class="ibox-body">
        <div id="sizeSp">
            <div class="row">
                <div class="col-md-6" id="size" style="display: none; margin-top: 20px;">
                    <input name="tags" id="tags" placeholder="Enter size" value="">
                </div>
                <div class="col-md-6" id="materials" style="display: none; margin-top: 20px;">
                    <input name="tags" id="tags" placeholder="Enter Materials" value="">
                </div>
                <div class="col-md-6" id="small" style="margin-top: 20px; display: none;">
                    <input name="tags" id="tags" placeholder="Enter Small" value="">
                </div>
                <div class="col-md-6" id="condition" style="margin-top: 20px; display: none;">
                    <div class="form-group mb-4">
                        <select class="form-control" id="category" name="category">
                            <option selected value> Select Condition </option>
                            <option value="">New</option>
                            <option value="">Old</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6" id="create_option_hide" style="margin-top: 20px;">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="form-group mb-4">
                                <input class="form-control" id="option_name" type="text" placeholder="Option Name" name="product_price">
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary mr-2" type="button" id="create_option" onclick="createOption();">Create </button>     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="optin_value_show" style="margin-top: 20px; display: none;">
                    <input name="tags" class="option_value" id="tags" placeholder="Enter Option Value" value="">
                    <a href="javascript:;" onclick="cancleOption();" style="color: red">cancle</a>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- '''''''''''''''''''''''''Shipping Infomation ''''''''''''''''''''''''''''''-->
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
                            <option value="i_will_fix_cost"> I will enter fixed cost manually </option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label>Shipping Origin</label>
                            <select class="form-control" name="shipping_origin" id="ShippingOriginName">
                            <option  selected value> Select Origin </option>
                            @foreach($ShopCountry as $shop_country)
                            <option value="{{$shop_country->shop_country}}"
                            <?php if($shop_country->shop_country=='United State'){echo'selected';}?>
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
                            <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="ex-pass"  placeholder="From" style="width: 244px" name="from_day">
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
                            <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="ex-pass"  placeholder="From" style="width: 245px" name="to_day">
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

 <!-- '''''''''''''''''''''''''Fixed shipping costs ''''''''''''''''''''''''''''''-->
     <div class="ibox">
        
            <div class="ibox-head">
                <div class="ibox-title">
                Fixed shipping costs
                </div>
            </div>
            <div class="ibox-body">
                
                 <div class="form-horizontal repeater" id="repeter">
                    <div class="ibox-body">
                        <div class="form-group mb-4 row">
                            <label class="col-sm-2 col-form-label" id="ChangeOriginCountry">United States</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="origin_shipping_cost" placeholder="price ($)">

                               
                            </div>
                             <div class="col-sm-4">
                                <label class="checkbox checkbox-primary" style="margin-top: 6px;">
                                    <input type="checkbox" name="origin_shipping_cost" value="Free Shipping">
                                    <span class="input-span"></span>Free Shipping
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <label class="col-sm-2 col-form-label">Everywhere Else</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="everywhere_shipping_cost" placeholder="price ($)">

                               
                            </div>
                             <div class="col-sm-4">
                                 <label class="checkbox checkbox-primary" style="margin-top: 6px;">
                                    <input type="checkbox" name="everywhere_shipping_cost" value="Free Shipping">
                                    <span class="input-span"></span>Free Shipping
                                </label>
                            </div>
                        </div>


                        
                    <div class="locationRept">
                       
                          
                        </div>
                      <input type="button" id="locationRepter" class="btn btn-gradient-lime btn-rounded btn-fix" value="Add a Location"/>
                        
                    </div>
                    
          </div>
       </div>
       
 <!-- ''''''''''''''''''''''''' Metirial and  Description ''''''''''''''''''''''''''-->
         <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">
                Tags and  Description
                </div>
            </div>
            <div class="ibox-body">
                <div class="row">
                    <div class="col-md-12">
                      <input name="tags2" id="tags" placeholder="Enter Tags" value="XS,S,M,L,XL,XXL,XXXL">
                    </div> 
                     <div class="col-md-12" style="margin-top: 20px;">
                        <label>About Product <sup>*</sup></label>
                         <textarea id="summernote" data-plugin="summernote" data-air-mode="true"  name="product_details" required>
                        
                         </textarea>
                    </div> 

                </div>  
            </div>
             <div class="ibox-footer text-right">
                <button type="submit" class="btn btn-primary mr-2" type="submit" name="savemode" value="save">
                    Save and publish
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
<script src="{{asset('users/assets/js/jQuery.tagify.js')}}"></script>
<script src="{{asset('users/assets/vendors/alertifyjs/dist/js/alertify.js')}}"></script>
<script src="{{asset('users/assets/slim/slim.kickstart.min.js')}}"></script>
@endsection

@section('otherJs')

 <!-- '''''''''''''''''''''''''product specfication ''''''''''''''''''''''''''''''-->
<script type="text/javascript">
   $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    $(document).ready(function(){
       $('#category').change(function(){
        $('#show_size_spc').css('display','block');
        var id  = $(this).val();
        var itemName = $(this).find('option:selected').text();
        if(itemName == 'Women’s Clothing' || itemName == 'Men’s Clothing' || itemName == 'Home & Garden, Appliance' || itemName == 'Bags & Shoes' || itemName == 'Toys, Kids & Baby' || itemName == 'Sports & Outdoors' || itemName == 'Automobiles & Motorcycles' || itemName == 'Home Improvement, Tools'){
            $('#size').css('display','block');
            $('#materials').css('display','none');
            $('#small').css('display','none');
            $('#condition').css('display','none');
        }else if(itemName == 'Cellphones & Accessories'){
            $('#size').css('display','block');
            $('#materials').css('display','block');
            $('#small').css('display','none');
            $('#condition').css('display','none');
        }else if(itemName == 'Computer, Office, Security' || itemName == 'Consumer Electronics'){
            $('#size').css('display','block');
            $('#materials').css('display','block');
            $('#small').css('display','none');
            $('#condition').css('display','block');
        }else if(itemName == 'Health & Beauty, Hair'){
            $('#size').css('display','block');
            $('#materials').css('display','none');
            $('#small').css('display','block');
            $('#condition').css('display','none');
        }
        $('#sub_category').val([]);
        $.ajax({
            type:'POST',
            url:'get-sub-category',
            data: {id:id},
            success:function(response){
                $("#sub_category option:selected").prop("selected", false);
                $('#sub_category').html(response);
                console.log(response);
                
            }
        });

       });
    });

    $(document).ready(function(){
       $('#sub_category').change(function(){
        var id  = $(this).val();
        $.ajax({
            type:'POST',
            url:'get-tri_sub-category',
            data: {id:id},
            success:function(response){
                $('#tri_sub_category').html(response);
                console.log(response);
                
            }
        });

       });
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
    function createOption(){
        var optionName = $('#option_name').val();
        if(optionName != ''){
            $('#optin_value_show').css('display','block');
            $('#create_option_hide').css('display','none');
        }
    }
    function cancleOption()
    {
        $('#optin_value_show').css('display','none');
        $('#create_option_hide').css('display','block');
    }
</script>
<!-- '''''''''''''''''''''''''Image Specfication ''''''''''''''''''''''''''''''-->
<script type="text/javascript">
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
            });
            fileReader.readAsDataURL(f);
          }
        });
      } else {
        alert("Your browser doesn't support to File API")
      }
    });
  $(document).ready(function(){
     $(document).on('click', '#add_fuck', function(){
        var abc = $.getScript('http://localhost:8000/users/assets/slim/slim.kickstart.min.js');
        var html ='';
        html += '<tr>';
        html += '<td><div class="slim" data-label="Drop various color image" data-size="1920, 1280"><input type="file" name="product_img_1" /></div></td>';
        html += '<td><input type="text" name="item_price[]" class="form-control item_quantity" /></td>';
        html += '<td><button type="button" name="remove" class="btn btn-gradient-aqua btn-fix remove" style="border:none">Remove</button></td></tr>';
        $('#item_table').append(html);
     });
     
     $(document).on('click', '.remove', function(){
        $(this).closest('tr').remove();
     });
  });     

</script>

<!-- '''''''''''''''''''''''''Size Specfication ''''''''''''''''''''''''''''''-->
<script type="text/javascript">
    $(document).ready(function(){
        $('[id=tags]').tagify();
    });
</script>
<!-- '''''''''''''''''''''''''Shipping Infomation ''''''''''''''''''''''''''''''-->
<script type="text/javascript">
  $(document).ready(function(){
    $('#ShippingOriginName').change(function(){
      var val = $(this).val();
      $('#ChangeOriginCountry').html(val);
    });
  });

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

<!-- '''''''''''''''''''''''''Fixed shipping costs ''''''''''''''''''''''''''''''-->
<script type="text/javascript">
  $(document).ready(function(){
      $(document).on('click', '#locationRepter', function(){
         
          var html = '';
          html += '<div class="form-group mb-4 row"><label class="col-sm-2 col-form-label">Location</label><div class="col-sm-3">';

          html += '<select class="form-control" name="shipping_location[]" required>';
          html +='<option selected value"> Select Origin </option>';
          html += '<?php foreach ($ShopCountry as $country){?><option value="<?php echo $country->shop_country;?>"><?php echo $country->shop_country; ?></option><?php }?>';
          html += '</select>';
          html += '<label class="checkbox checkbox-primary" style="margin-top: 14px;"><input type="checkbox" name="total_shipping_cost[]" value="Free Shipping"><span class="input-span"></span>Free Shipping</label></div>';
          html += '<div class="col-sm-3"> <input class="form-control" type="text" placeholder="price ($)" name="total_shipping_cost[]"> </div>';
          
          html += '<div class="col-sm-2"><input type="button" id="removeShipping" value="Delete" class="btn btn-gradient-aqua btn-fix" /></div></div>';
                                
          $('.locationRept').append(html);
          
      });

      $(document).on('click', '#removeShipping', function(){
        $(this).closest('.form-group').remove();
     });

  });
</script>
<!-- ''''''''''''''''''''''''' Metirial and  Description ''''''''''''''''''''''''''-->
<script>
        $(function() {
            $('#summernote').summernote();
            $('#summernote_air').summernote({
                airMode: true
            });
        });
</script>
@endsection



