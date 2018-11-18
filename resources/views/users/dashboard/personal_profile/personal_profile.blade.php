@extends('users.dashboard.layout')
@section('otherStyle')
<link href="{{asset('users/assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" />

<link href="{{asset('users/assets/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/ion.rangeSlider/css/ion.rangeSlider.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/smalot-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/clockpicker/dist/bootstrap-clockpicker.min.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/jquery-minicolors/jquery.minicolors.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/multiselect/css/multi-select.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet" />
<link href="{{asset('users/assets/vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
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
    
    <?php
        $profile_info = DB::table('users')->where('id',Auth()->user()->id)->first();
    ?>
    <div class="col-md-12">
    <form action="{{url('personalProfileUpdate')}}" method="post" enctype="multipart/form-data">
      @csrf
        <div class="ibox">
           <div class="ibox-head">
              <div class="ibox-title">
              Update Public Profile
              </div>
           </div>
           <div class="ibox-body">
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Name</label>
                            <input class="form-control" type="text" placeholder="Name" name="name" value="{{$profile_info->name}}">
                        </div>
                        <div class="form-group mb-4">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="London, England, United Kingdom" name="city" value="{{$profile_info->city}}">
                        </div>
                        <div class="form-group mb-0">
                            <label>Gender</label>
                            <div>
                                <label class="radio radio-inline radio-info">
                                    <input type="radio" name="gender" value="Male" <?php if($profile_info->gender=='Male'){ echo 'checked'; }?> >
                                    <span class="input-span"></span>Male</label>
                                <label class="radio radio-inline radio-info">
                                    <input type="radio" name="gender" value="Female" <?php if($profile_info->gender=='Female'){ echo 'checked'; }?>>
                                    <span class="input-span"></span>Female</label>
                                <label class="radio radio-inline radio-info">
                                    <input type="radio" name="gender" value="Custom" <?php if($profile_info->gender=='Custom'){ echo 'checked'; }?> >
                                    <span class="input-span"></span>Custom</label>
                                <label class="radio radio-inline radio-info">
                                    <input type="radio" name="gender" value="not to say" <?php if($profile_info->gender=='not to say'){ echo 'checked'; }?>>
                                    <span class="input-span"></span>Prefer not to say</label>
                                    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Email</label>
                            <input class="form-control" type="email" placeholder="Email" name="email" value="{{$profile_info->email}}" readonly>
                        </div>
                      
                        <div class="form-group" id="date_2">
                            <label class="font-normal">Birth Date</label>
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input class="form-control" type="text" value="{{$profile_info->   birth_date}}" name="brith_date">
                            </div> 
                        </div>
                    </div>

                     <div class="col-md-12 shopImage" style="border: 1px dotted orange;padding: 20px; margin-top: 20px;">
                          <label>Profile Image</label>
                          <div class="shopProfileImage" align="left">
                            <input type="file" id="shopProfileImage" name="progile_image" />
                            @if($profile_info->image)
                            <span class="pip">
                                <img src="{{asset('users/profile_image/'.$profile_info->image)}}" class="imageThumb">
                                <br>
                                <span class="remove">remove</span>
                            </span>.

                            @endif
                           
                          </div>
                        </div>
                </div>
           </div>
           <div class="ibox-footer">
                <button type="submit" class="btn btn-primary mr-2" type="button">
                Update
                </button>
                <button class="btn btn-outline-secondary" type="reset">Back</button>
                
            </div>
        </div>

        </form>
    </div>

@endsection
@section('otherScript')
<script src="{{asset('users/assets/vendors/summernote/dist/summernote.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap-markdown/js/bootstrap-markdown.js')}}"></script>

<script src="{{asset('users/assets/vendors/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/smalot-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('users/assets/vendors/clockpicker/dist/bootstrap-clockpicker.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/jquery-minicolors/jquery.minicolors.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/multiselect/js/jquery.multi-select.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap-maxlength/src/bootstrap-maxlength.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('users/assets/js/scripts/form-plugins.js')}}"></script>
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
<?php if(session('success')){?>
<script type="text/javascript">


            toastr["success"]("Prifile information successfully updated");


</script>
<?php } ?>
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

@endsection



