@extends('front-end.layout')


@section('style')
<link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
@endsection


@section('content')
<br/>
<br/>
<br/>

<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">Upload profile picture</div>
    <div class="panel-body">


      <div class="row">
        <div class="col-md-4 text-center">
        <div id="upload-demo" style="width:350px"></div>
        </div>
        <div class="col-md-4" style="padding-top:30px;">
        <strong>Chose Image:</strong>
        <br/>
        <input type="file" id="upload">
        <br/>
        <button class="btn btn-success upload-result">Upload Image</button>
        <a href="{{url('home')}}">Back to profile</a>
        </div>
        <br/>
        <br/>



        <div class="col-md-4" style="">
        <div id="upload-demo-i" style="background:#e1e1e1;width:300px;padding:30px;height:300px;margin-top:30px"></div>
        </div>
      </div>


    </div>
  </div>
</div>
@endsection

@section('script')

<script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
<script type="text/javascript">


$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'circle'
    },
    boundary: {
        width: 300,
        height: 300
    }
});


$('#upload').on('change', function () { 
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});


$('.upload-result').on('click', function (ev) {
  alert(0);
  $uploadCrop.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (resp) {
    $.ajax({
      url: "/image-crop",
      type: "POST",
      data: {"image":resp},
      success: function (data) {
        html = '<img src="' + resp + '" />';
        $("#upload-demo-i").html(html);
        console.log(data);
      }
    });
  });
});

</script>

@endsection