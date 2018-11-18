@extends('users.layout')
@section('page_style')
    <link href="{{asset('users/assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" />

    <link href="{{asset('users/assets/css/jquery.masterblaster.css')}}" rel="stylesheet" />

    <link href="{{asset('users/assets/vendors/dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/dropzone/dist/min/basic.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/css/tagify.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/alertifyjs/dist/css/alertify.css')}}" rel="stylesheet" />
   
@endsection

@section('row_style')
<style type="text/css">
	sup{
		color:red;
	}
</style>
@endsection


@section('content')
@if(session('product_id'))
<input type="text" name="global_id" id="global_id" value="{{session('product_id')}}">
@endif

   <div class="container" style="margin-top: 50px;">
	   <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">
                Product Specfication
                </div>
            </div>
            <div class="ibox-body">
            <form id="basic-info" enctype= multipart/form-data>
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
	                        <select class="form-control" id="category" name="category" required>
	                        <option  selected value> select category </option>
                            @foreach($categories as $cat)
                              <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                            @endforeach
	                        
	                        </select>
	                    </div>
	                    <div class="form-group mb-4">
	                        <label>Product Final Category <sup>*</sup></label>
	                        <select class="form-control" id="tri_sub_category" name="tri_sub_category" required>
	                        <option  selected value> select final category </option>
	                           
	                        </select>
	                    </div>
                       
                         <div class="form-group mb-4">
                            <label>Discount Price</label>
                            <input class="form-control" type="text" placeholder="discount should be (10%)" name="discount">
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
                    <div class="col-md-6">
                       <div class="form-group mb-4">
	                        <label>Product Sub Category <sup>*</sup></label>
	                        <select class="form-control" id="sub_category" name="sub_category">
	                        <option  selected value> select sub category </option>
	                           
	                        </select>
	                    </div>
                        <div class="form-group mb-4">
                            <label>Product Title<sup>*</sup></label>
                            <input class="form-control" type="text" placeholder="product title" name="product_title" required>
                        </div>
                         
                          <div class="form-group mb-4">
                            <label>Product Price <sup>*</sup></label>
                            <input class="form-control" type="text" placeholder="product price " name="product_price" required>
                        </div>
                    </div> 
                </div> 
            </div>
            
              <div class="ibox-footer text-right">
                    <button type="submit" class="btn btn-primary mr-2" type="button">
                        Save
                    </button>
                    <button class="btn btn-outline-secondary" id="testBtn" type="reset">Cancel</button>
               </div>
         </form>
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
                <div class="col-md-6" class="">
                   <div class="form-group mb-4 text-center">
                        <label class="radio radio-outline-success" id="differentPrice">
                            <input type="radio" name="">
                            <span class="input-span"></span>Different Color Different Price
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group mb-4 text-center">
                        <label class="radio radio-outline-success" id="samePrice">
                            <input type="radio" name="d">
                            <span class="input-span"></span>Different Color Same Price
                        </label>
                    </div>
                </div>

                <div class="col-md-12" id="multiupload" style="display: none">
                    <form class="dropzone" id="mydropzone" action="">
                        <div class="fallback">
                            <input name="file" type="file" multiple="multiple">
                        </div>
                    </form><br>
                </div>
            </div>
        <form class="repeater colorRep" id="repeter" method="post" style="display: none;margin-top: 35px;">
              @csrf
                  <div data-repeater-list="outer-list">
                      <div data-repeater-item>
                          <div class="row" style="">
                                <div class="col-md-2"></div>
                                <div class="col-md-2" class="text-right">
                                   <div class="form-group">
                                         <label class="btn btn-primary file-input">
                                            <span class="btn-icon"><i class="la la-cloud-upload"></i>Browse file</span>
                                            <input type="file" name="image[]">
                                         </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                   <div class="form-group">
                                        <input class="form-control" type="text" placeholder="price" name="group[][price]" required>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <input data-repeater-delete type="button" value="Delete" class="btn btn-gradient-aqua btn-fix" /> 
                                </div>
                            </div>
                       </div>
                   </div>
                   <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                             <input data-repeater-create type="button" class="btn btn-gradient-lime btn-rounded btn-fix" value="Add"/>
                        </div>
                    </div> 
                   
              
         </div>
          <div class="ibox-footer text-right">
            <button type="submit" class="btn btn-primary mr-2" type="button">
                Save
            </button>
            <button class="btn btn-outline-secondary" id="testBtn" type="reset">Cancel</button>
        </form>
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
            <form method="post" id="sizeSp" enctype="multipart/form-data">
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
             <div class="ibox-footer text-right">
            <button type="submit" class="btn btn-primary mr-2" type="button">
                Save
            </button>
            <button class="btn btn-outline-secondary" id="testBtn" type="reset">Cancel</button>
        </form>
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
                            <select class="form-control" name="language" required>
                            <option  selected value> Select Shipping </option>
                            <option> I will enter fixed cost manually </option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label>Shipping Origin</label>
                            <select class="form-control" name="language" required>
                            <option  selected value> Select Origin </option>
                            <option> United State </option>
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
                            <select class="form-control" id="custom_range" name="language" required>
                            <option  selected value> Select processing time </option>
                            <option value="">1 business day</option>
                            <option value="">1-2 business day</option>
                            <option value="">2-3 business day</option>
                            <option value="">3-5 business day</option>
                            <option value="">1-2 weeks</option>
                            <option value="">2-3 weeks</option>
                            <option value="">3-4 weeks</option>
                            <option value="">4-6 weeks</option>
                            <option value="">6-8 weeks</option>
                            <option value="custom_range"> Custom Range </option>
                            <option value=""> Unknon</option>
                            </select>
                        </div>
                         

                         <form class="form-inline form-success mb-4 from-to" action="javascript:;" style="display: none">
                           <label class="sr-only" for="ex-pass">Email</label>
                            <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="ex-pass"  placeholder="From" style="width: 244px">
                            <option>From</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            </select>

                            
                            <label class="sr-only" for="ex-pass">To</label>
                            <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="ex-pass"  placeholder="From" style="width: 257px">
                            <option>To</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            </select>
                            
                            <label class="radio radio-outline-success" id="differentPrice" style="margin-top: 19px; margin-right: 27px">
                                <input type="radio" name="d">
                                <span class="input-span"></span>business days
                            </label>
                             <label class="radio radio-outline-success" id="differentPrice" style="margin-top: 19px;">
                                <input type="radio" name="d">
                                <span class="input-span"></span>weeks
                            </label>

                            
                        </form>

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
                
                 <form class="form-horizontal repeater" id="repeter" action="javascript:;">
                    <div class="ibox-body">
                        <div class="form-group mb-4 row">
                            <label class="col-sm-2 col-form-label">United States</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" placeholder="price ($)">

                                <label class="checkbox checkbox-primary" style="margin-top: 14px;">
                                    <input type="checkbox">
                                    <span class="input-span"></span>Free Shipping
                                </label>
                            </div>
                             <div class="col-sm-4">
                                <input class="form-control" type="text" placeholder="price ($)">
                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <label class="col-sm-2 col-form-label">Everywhere Else</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" placeholder="price ($)">

                                <label class="checkbox checkbox-primary" style="margin-top: 14px;">
                                    <input type="checkbox">
                                    <span class="input-span"></span>Free Shipping
                                </label>
                            </div>
                             <div class="col-sm-4">
                                <input class="form-control" type="text" placeholder="price ($)">
                            </div>
                        </div>


                        
                    <div class="locationRept">
                       
                          
                        </div>
                      <input type="button" id="locationRepter" class="btn btn-gradient-lime btn-rounded btn-fix" value="Add a Location"/>
                        
                    </div>
                  
                </form>

          </div>
       </div>
       

    <!-- end step 5 -->

    <!-- start step 6 -->
         <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">
                Metirial and  Description
                </div>
            </div>
            <div class="ibox-body">
            <form method="post" id="productDetails" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                      <input name="tags" id="tags" placeholder="Enter Tags" value="XS,S,M,L,XL,XXL,XXXL">
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
            </form>
           </div>
      </div>


</div>
    <!-- end step 6 -->





        <!-- start step 6 -->
<div class="container">
         <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">
                Test
                </div>
            </div>
            <div class="ibox-body">
                <h3 align="center"></h3>
                   <br />
                   <h4 align="center">Enter Item Details</h4>
                   <br />
                   <form method="post" id="insert_form" enctype="multipart/form-data">
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
                      <input type="submit" name="submit" class="btn btn-info" value="Insert" />
                     </div>
                    </div>
                   </form>
            </div>
             <div class="ibox-footer text-right">
                <button type="submit" class="btn btn-primary mr-2" type="button">
                    Save
                </button>
                <button class="btn btn-outline-secondary" id="testBtn" type="reset">Cancel</button>
            </form>
           </div>
      </div>
</div>
</div>


@endsection
@section('page_level')
<script src="{{asset('users/assets/vendors/summernote/dist/summernote.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap-markdown/js/bootstrap-markdown.js')}}">
</script>
<script src="{{asset('users/assets/vendors/dropzone/dist/min/dropzone.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"></script>

<script src="{{asset('users/assets/js/jQuery.tagify.js')}}"></script>
<script src="{{asset('users/assets/vendors/alertifyjs/dist/js/alertify.js')}}"></script>

@endsection

@section('core_script')
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
            $('#multiupload').fadeIn('1000');
            $('#repeter').hide(); 
        });
         $('#differentPrice').click(function(){
            $('#multiupload').hide();
            $('#repeter').fadeIn('1000'); 
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
                url:'store-primary-product',
                processData: false,
                contentType: false,
                data: new FormData(this),
                success:function(response){
                    if(response.save == 'save'){
                        alertify.success('Product Successfully Saved');
                    }
                    if(response.update == 'update'){
                        alertify.success('Product Successfully Update');
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
      html += '<div class="form-group mb-4 row"><label class="col-sm-2 col-form-label">Location</label><div class="col-sm-3"><select class="form-control" name="language" required> <option> asdfasdf </option></select> <label class="checkbox checkbox-primary" style="margin-top: 14px;"><input type="checkbox"><span class="input-span"></span>Free Shipping</label></div>';
      html += '<div class="col-sm-3"> <input class="form-control" type="text" placeholder="price ($)"> </div>';
      html += '<div class="col-sm-2"><input class="form-control" type="text" placeholder="price ($)"></div>';
        html += '<div class="col-sm-2"><input type="button" id="locationRemove"value="Delete" class="btn btn-gradient-aqua btn-fix" /></div></div>';
                            
      $('.locationRept').append(html);
      console.log(html);

  });
     
     $(document).on('click', '#locationRemove', function(){
      $(this).closest('.form-group').remove();
     });

    









</script>
@endsection

