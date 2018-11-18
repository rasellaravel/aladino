@extends('users.layout')
@section('page_style')
    <link href="{{asset('users/assets/slim/slim.min.css')}}" rel="stylesheet" />
@endsection

@section('row_style')

@endsection


@section('content')
<div class="container">
    <!-- <form action="{{url('slim_upload')}}" method="post" enctype= multipart/form-data>
    @csrf
    <div class="slim"
     data-ratio="16:9"
     data-size="640,640">
     <input type="file" name="slim"/>
    </div>
     <input type="submit" name="submit" value="submit">
    </form> -->

    <form action="{{url('slim_upload')}}" method="post" enctype="multipart/form-data" class="avatar">
    @csrf
     <div class="slim" data-label="Drop profile photo" data-size="1920, 1280" style="height: 200px; width: 200px;">
    <input type="file" name="avatar[]" />
    </div>
    <div class="slim" data-label="Drop profile photo" data-size="1920, 1280" style="height: 200px; width: 200px;">
    <input type="file" name="avatar[]" />
    </div>
    </div>
    <button type="submit">Upload now!</button>

    </form>


   


</div>


@endsection
@section('page_level')
<script src="{{asset('users/assets/slim/slim.kickstart.min.js')}}"></script>

@endsection

@section('core_script')

@endsection

