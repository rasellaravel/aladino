@extends('users.dashboard.layout')
@section('otherStyle')
<link href="{{asset('users/assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" />
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


@section('content')
@if(session('fail'))
<div class="col-md-12">
    <div class="alert alert-danger">{{session('fail')}}</div>
</div>
@endif
<div class="col-md-12">
    <div class="ibox ibox-fullheight">
    <form action="{{url('user_create_shop_update')}}" method="post" enctype="multipart/form-data">
               @csrf
        <div class="ibox-body">
        <?php
        if(!$shops){
          
        
        ?>
            <div class="row">
                <div class="col-sm-1 form-group mb-4"></div>
                <div class="col-sm-7 form-group mb-4">
                    <label></label>
                    <input class="form-control" id="shopName" type="text" placeholder="Enter Shop Name" name="shopname" required>
                </div>
                <div class="col-sm-2 form-group mb-4">
                    <label></label>
                    <button type="button" id="checkShopName" class="btn btn-primary mr-2" type="button" style="margin-top: 21px">Check</button>  
                </div>
                <div class="col-sm-2 form-group mb-4"></div>
                <div class="col-sm-1 form-group mb-4"></div>
                <div class="col-sm-7 form-group mb-4">
                   <p class="Avaiable" style="color:#2d2810;display: none;">Shop Name is Avaiable you can take this.</p>
                   <p class="Not_avaiable" style="color: red;display: none;">Shop Name is not avaiable please try another.</p>
                </div>
            </div>
            <?php  } ?>
        </div>       
    </div>
</div>


<div class="col-md-6">
    <div class="ibox ibox-fullheight">
        <div class="ibox-head">
            <div class="ibox-title">Shop Basic</div>
        </div>
        <div class="ibox-body">
            <div class="row">
            
                <div class="col-sm-6 form-group mb-4">
                    <label>Shop Language</label>
                     <select class="form-control" name="language" required>
                        <option  selected value> Select Language </option>
                         @foreach($ShopLanguage as $ShopLanguage)
                             <option value="{{$ShopLanguage->id}}"
                             @if($shops)
                            @if($shops->language_id==$ShopLanguage->id)
                            selected
                            @endif
                            @endif
                            >{{$ShopLanguage->language}}</option>
                         @endforeach  
                        </select>
                </div>
                <div class="col-sm-6 form-group mb-4">
                    <label>Shop Currency</label>
                   <select class="form-control" name="currency" required>
                    <option  selected value> Select Currency </option>
                        @foreach($ShopCurrency as $ShopCurrency)
                          <option value="{{$ShopCurrency->id}}"
                          @if($shops)
                          @if($shops->currency_id==$ShopCurrency->id)
                            selected
                          @endif
                          @endif

                          >{{$ShopCurrency->currency}}</option>
                        @endforeach  
                    </select>
                </div>
                 <div class="col-sm-6 form-group mb-4">
                    <label>Shop Country</label>
                     <select class="form-control" name="country">
                    <option  selected value> Select Country </option>
                        @foreach($ShopCountry as $ShopCountry)
                          <option value="{{$ShopCountry->id}}"
                          @if($shops)
                            @if($shops->country_id==$ShopCountry->id)
                            selected
                            @endif
                            @endif
                          >{{$ShopCountry->shop_country}}</option>
                        @endforeach 
                    </select>
                </div>
                
                <div class="col-sm-6 form-group mb-4">
                    <label>Shop Title</label>
                     <input class="form-control" type="text" placeholder="Enter Email" value="@if($shops){{$shops->shop_title}}@endif" name="shoptitle" required>
                </div>

                <div class="col-md-12 shopImage" id="abc" style="border: 2px dotted orange;padding: 20px;">
                  <label>Shop Profile Image</label>
                  <div class="shopProfileImage" align="left">
                    <input type="file" id="shopProfileImage" name="shopProfileImage" />
                    @if($shops)
                    @if($shops->image)
                    <span class="pip">
                      <img class="imageThumb" src="{{asset('users/shop/'.$shops->image)}}">
                      <br>
                      <span class="shop_profile_image_delete remove" id="{{$shops->id}}">Remove</span>
                    </span>
                    @endif
                    @endif
                  </div>
                </div>
                
            </div> 
        </div>
    </div>
</div>
<!-- end basic shop -->

<div class="col-md-6">
    <div class="ibox ibox-fullheight">
        <div class="ibox-head">
            <div class="ibox-title">Shop Banner</div>
        </div>
        <div class="ibox-body">
            <div class="form-group mb-4 row">
                <label class="col-sm-2 col-form-label">Banner</label>
                <div class="col-sm-10 d-flex align-items-center">
                     <label class="radio radio-grey radio-primary radio-inline" id="banner">
                        <input type="radio" name="banner" value="banner" checked>
                        <span class="input-span"></span>Simple Banner</label>
                     <label class="radio radio-grey radio-primary radio-inline" id="carousel">
                        <input type="radio" name="banner" value="carousel">
                        <span class="input-span"></span>Carousel</label>
                </div>
            </div>
             <div class="col-md-12 banner" id="abc" style="border: 2px dotted orange;padding: 20px;">
               <div class="field" align="left">
                  <input type="file" id="bannerfiles" name="bannerFile" />
                   @if($shops)
                    @if($shops->banner)
                    <span class="pip">
                      <img class="imageThumb" src="{{asset('users/shop/'.$shops->banner)}}">
                      <br>
                      <span class="shop_banner_image_delete remove" id="{{$shops->id}}">Remove</span>
                    </span>
                    @endif
                    @endif

                </div>
            </div>

             <div class="col-md-12 carousel" id="abc" style="border: 2px dotted orange;padding: 20px;display: none;">
               <div class="field" align="left">
                  <input type="file" id="files" name="bannerCarousel[]" multiple />

                    @if($shops)
                    <?php
                      $shop_carousels = DB::table('shop_carousels')->where('shop_id',$shops->id)->get();
                      if($shop_carousels){
                        foreach ($shop_carousels as $key => $shop_carousels) {
                    ?>
                    <span class="pip">
                      <img class="imageThumb" src="{{asset('users/shop/'.$shop_carousels->image)}}">
                      <br>
                      <span class="shop_carousels_image_delete remove" id="{{$shop_carousels->id}}">Remove</span>
                    </span>
                   <?php } } ?>
                    @endif

                </div>
            </div>
            

        </div>       
    </div>
</div>

<!-- end banner -->


<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
            About Shop
            </div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-12">
                    <label>About Shop <sup>*</sup></label>
                     <textarea id="summernote" data-plugin="summernote" data-air-mode="true"  name="aboutshop" required>
                     @if($shops){{$shops->about_shop}}@endif
                     </textarea>
                </div>   
            </div>
        </div>
    </div>
</div>


<!-- end about shop -->

<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
            Announcement
            </div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-12">
                    <label>Announcement <sup>*</sup></label>
                     <textarea id="summernote1" data-plugin="summernote" data-air-mode="true"  name="announcement" required>
                     @if($shops){{$shops->announcement}}@endif
                     </textarea>
                </div>  
            </div>
        </div>
    </div>
</div>

<!-- end announcement -->

<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
           Police
            </div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-12">
                    <label>Police <sup>*</sup></label>
                     <textarea id="summernote2" data-plugin="summernote" data-air-mode="true"  name="police" required>
                     @if($shops){{$shops->police}}@endif
                     </textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end policis -->

<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
               More
            </div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-12">
                    <label>More About Shop <sup>*</sup></label>
                     <textarea id="summernote3" data-plugin="summernote" data-air-mode="true"  name="more" required>
                     @if($shops){{$shops->more}}@endif
                     </textarea>
                </div>
            </div>
        </div>
        <div class="ibox-footer">
            <button type="submit" class="btn btn-primary mr-2" type="button">
                @if($shops)
                Update Shop
                @else
                Create Shop
                @endif
            </button>
            <button class="btn btn-outline-secondary" type="reset">Cancel</button>
        </div>
        </form>
    </div>
</div>

<!-- end more content -->
@endsection
@section('otherScript')
<script src="{{asset('users/assets/vendors/summernote/dist/summernote.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap-markdown/js/bootstrap-markdown.js')}}"></script>
@endsection

@section('otherJs')
<script>
        $(function() {
            $('#summernote').summernote();
            $('#summernote1').summernote();
            $('#summernote2').summernote();
            $('#summernote3').summernote();
            $('#summernote_air').summernote({
                airMode: true
            });
        });
</script>
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
</script>
<script type="text/javascript">
        $(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#bannerfiles").on("change", function(e) {
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
            "</span>").insertAfter("#bannerfiles");
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
</script>


<script type="text/javascript">
        $(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#shopProfileImage").on("change", function(e) {
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
            "</span>").insertAfter("#shopProfileImage");
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
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#carousel').click(function(){
            $('.banner').css('display','none');
            $('.carousel').show();
        });
         $('#banner').click(function(){
            $('.carousel').css('display','none');
            $('.banner').show();
        });
    });
</script>
<?php if(session('updated')){?>
<script type="text/javascript">
            toastr["success"]("Shop information successfully updated");
</script>
<?php } ?>
<?php if(session('saved')){?>
<script type="text/javascript">
            toastr["success"]("Shop information successfully Saved");
</script>
<?php } ?>


<script type="text/javascript">
 $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $(document).ready(function(){
        $('#checkShopName').on('click', function(){
            var shopName = $('#shopName').val();
            if(shopName==''){
                exit();
            }
            $.ajax({
                type:'POST',
                url:'check_shop_name',
                data: {shopName : shopName},
                success:function(response){
                    if(response=='available'){
                        $('.Not_avaiable').css('display','none');
                        $('.Avaiable').show();
                        
                    }else if(response=='not_available'){
                        $('.Avaiable').css('display','none');
                        $('.Not_avaiable').show();
                        
                    }
                    console.log(response);
                    
                }
            });

            return false;
        });
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
   $(".shop_profile_image_delete").click(function(){
       $(this).parent(".pip").remove();
      var id = $(this).attr('id');
            $.ajax({
                type:'POST',
                url:'{{url("delete_shop_profile_image")}}',
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

<script type="text/javascript">
  $(document).ready(function(){
   $(".shop_banner_image_delete").click(function(){
       $(this).parent(".pip").remove();
      var id = $(this).attr('id');
            $.ajax({
                type:'POST',
                url:'{{url("delete_shop_banner_image")}}',
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

<script type="text/javascript">
  $(document).ready(function(){
   $(".shop_carousels_image_delete").click(function(){
       $(this).parent(".pip").remove();
      var id = $(this).attr('id');
            $.ajax({
                type:'POST',
                url:'{{url("delete_shop_carousels_image")}}',
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



