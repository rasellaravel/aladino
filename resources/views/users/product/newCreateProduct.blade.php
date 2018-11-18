@extends('users.layout')
@section('page_style')
    <link href="{{asset('users/assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" />

    <link href="{{asset('users/assets/css/jquery.masterblaster.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/css/tagify.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/alertifyjs/dist/css/alertify.css')}}" rel="stylesheet" />
   
@endsection

@section('row_style')
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
</style>
@endsection


@section('content')
   <div class="container" style="margin-top: 50px;">
   <form id="basic-info" method="post" enctype="multipart/form-data">

    <!-- '''''''''''''''''''''''''product specfication ''''''''''''''''''''''''''''''-->
	   <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">
                Product Specfication sdffsdfsf
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
                              <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                            @endforeach
	                        
	                        </select>
	                    </div>
	                    <div class="form-group mb-4">
	                        <label>Product Final Category <sup>*</sup></label>
	                        <select class="form-control" id="tri_sub_category" name="tri_sub_category" >
	                        <option  selected value> select final category </option>
	                           
	                        </select>
	                    </div>
                       
                         <div class="form-group mb-4">
                            <label>Discount Price</label>
                            <input class="form-control" type="text" placeholder="discount should be (10%)" name="discount">
                        </div>
                        
                         <div class="form-group mb-4">
                            <label>Custom Category <sup>*</sup></label>
                            <select class="form-control" id="custom_category" name="custom_category">
                            <option  selected value> select custom category </option>
                            <option  value="create_custom_category"> Create New Category </option>
                            
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
	                        <option  selected value> select sub category </option>
	                           
	                        </select>
	                    </div>
                        <div class="form-group mb-4">
                            <label>Product Title<sup>*</sup></label>
                            <input class="form-control" type="text" placeholder="product title" name="product_title" >
                        </div>
                         
                          <div class="form-group mb-4">
                            <label>Product Price <sup>*</sup></label>
                            <input class="form-control" type="text" placeholder="product price " name="product_price" >
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

 <!-- '''''''''''''''''''''''''Image Specfication ''''''''''''''''''''''''''''''-->
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
            Image Specfication
            </div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-6" class="">
                   <div class="form-group mb-4 text-center">
                        <label class="radio radio-outline-success" id="differentPrice">
                            <input type="radio" name="color" value="diff_price">
                            <span class="input-span"></span>Different Color Different Price
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group mb-4 text-center">
                        <label class="radio radio-outline-success" id="samePrice">
                            <input type="radio" name="color" value="same_price">
                            <span class="input-span"></span>Different Color Same Price
                        </label>
                    </div>
                </div>

                <div class="col-md-12" id="abc" style="display: none; border: 2px dotted orange;padding: 20px;">
                   <div class="field" align="left">
                      <input type="file" id="files" name="same_product_img[]" multiple />
                    </div>
                </div>
            </div>
        <div  id="myrep">
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
                     </table>
                     <div align="center">
                     
                     </div>
                    </div>
         </div>
         </div>
    </div>
 

   <!-- '''''''''''''''''''''''''Size Specfication ''''''''''''''''''''''''''''''-->
     <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">
                
                </div>
            </div>
            <div class="ibox-body">
            <div id="sizeSp">
                <div class="row">
                    <div class="col-md-6">
                      <input name="tags" id="tags" placeholder="Enter size" value="XS,S,M,L,XL,XXL,XXXL">
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
                            <select class="form-control" name="shipping_origin">
                            <option  selected value> Select Origin </option>
                            @foreach($ShopCountry as $shop_country)
                            <option value="{{$shop_country->shop_country}}"> {{$shop_country->shop_country}} </option>
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
                            <label class="col-sm-2 col-form-label">United States</label>
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
               
                </div>
            </div>
            <div class="ibox-body">
                <div class="row">
                    <div class="col-md-6">
                      <input name="tags2" id="tags" placeholder="Enter Tags" value="XS,S,M,L,XL,XXL,XXXL">
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group mb-4">
                            <input name="meterials" id="tags" placeholder="Enter Meterials" value="XS,S,M,L,XL,XXL,XXXL">
                        </div>
                    </div>
                     <div class="col-md-12">
                        <label>About Product <sup>*</sup></label>
                         <textarea id="summernote" data-plugin="summernote" data-air-mode="true"  name="product_details" required>
                        
                         </textarea>
                    </div> 

                </div>  
            </div>
             <div class="ibox-footer text-right">
                <button type="submit" class="btn btn-primary mr-2" type="button">
                    Save
                </button>
                <button class="btn btn-outline-secondary" id="testBtn" type="reset">Cancel</button>

           </div>
      </div>
</div>

 </form>
    <!-- end step 6 -->


@endsection
@section('page_level')
<script src="{{asset('users/assets/vendors/summernote/dist/summernote.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap-markdown/js/bootstrap-markdown.js')}}">
</script>
<script src="{{asset('users/assets/js/jQuery.tagify.js')}}"></script>
<script src="{{asset('users/assets/vendors/alertifyjs/dist/js/alertify.js')}}"></script>

@endsection

@section('core_script')

 <!-- '''''''''''''''''''''''''product specfication ''''''''''''''''''''''''''''''-->
<script type="text/javascript">

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


    $(document).ready(function(){
       $('#category').change(function(){
        var id  = $(this).val();
        $('#sub_category').val([]);
          $.ajax({
              type:'POST',
              url:'get-sub-category',
              data: {id:id},
              success:function(response){
                  $("#sub_category option:selected").prop("selected", false)
                  $('#sub_category').html(response);
                  console.log(response);
              }
          });
       });
    });
</script>









<!-- text editor -->
<script>
        $(function() {
            $('#summernote').summernote();
            $('#summernote_air').summernote({
                airMode: true
            });
        });
</script>

<!-- same and different price hide show -->
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

<!-- tag input -->
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
        $('#sub_category').val([]);
        $.ajax({
            type:'POST',
            url:'get-sub-category',
            data: {id:id},
            success:function(response){
                $("#sub_category option:selected").prop("selected", false)
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
        $('#basic-info').on('submit', function(){
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
      html += '<td><button type="button" name="remove" class="btn btn-gradient-aqua btn-fix remove">Remove</button></td></tr>';
      $('#item_table').append(html);
     });
     
     $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
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
      html += '<div class="form-group mb-4 row"><label class="col-sm-2 col-form-label">Location</label><div class="col-sm-3"><select class="form-control" name="shipping_location[]" required> <option value="rasel"> asdfasdf </option></select> <label class="checkbox checkbox-primary" style="margin-top: 14px;"><input type="checkbox" name="total_shipping_cost[]" value="Free Shipping"><span class="input-span"></span>Free Shipping</label></div>';
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
            "<br/><span class=\"remove\">Remove image</span>" +
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
@endsection

