@extends('front-end.layout')


@section('style')

@endsection


@section('content')

<section id="profile-section" style="margin-top: 40px;">
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php
              $get_image = DB::table('update_profiles')->where('user_id',Auth()->user()->id)->first();
                if($get_image){?>
                    <img src="{{asset('user-image/'.$get_image->image)}}" class="img-circle img-responsive">
               <?php } else{ ?>
              
                  <img src="{{asset('user-img.png')}}" class="img-circle img-responsive">
             <?php } ?>
            
          


            <div class="take-photo text-right">
                <a href="{{url('image-crop')}}"><i class="fas fa-camera"></i></a>
            </div>
        </div>
        <div class="col-md-4">
         <div class="edit-profile">
            <h1>{{Auth()->user()->name}}</h1>
             <p><b>0</b> Following   <b>0</b> Followers</p>
             <a href="{{url('edit-profile')}}" class="btn btn-default edit-button" style="border: 1px solid #dac6c6;><i class="fas fa-pencil-alt">  </i>Edit Profile</a>
         </div>
        </div>
         <div class="col-md-5">
         <div class="shop-about">
            <h1>About</h1>
             <p>Joined August 8, 2018</p>
         </div>
         <div class="shop-icon">
             <i class="fas fa-store"></i>
         </div>
         <div class="shop-content">
            <a href=""><p>Shop</p>
             <h4>Visit your shop <i class="fas fa-angle-right"></i></h4> </a> 
         </div>


        </div>
    </div>
</div>
</section>

<section class="profile-tab">
   <nav>
  <div class="nav nav-tabs fava-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Favorite Items  (0)</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Favorite shops  (0)</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Lists (0)</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active text-center" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <img src="{{asset('empty_favorite_items.svg')}}" class="img-fluid">
  </div>
  <div class="tab-pane fade text-center" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <img src="{{asset('empty_favorite_items.svg')}}" class="img-fluid" style="margin-top: -422px;">
  </div>
  <div class="tab-pane fade text-center" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"><img src="{{asset('empty_favorite_items.svg')}}" class="img-fluid" style="    margin-top: -422px;">
  </div>
</div>
</section>


<!-- upload profile image modal -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profile-picture-model">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="profile-picture-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="row">
          <div class="col-md-4 text-center">
          <div id="upload-demo" style="width:350px"></div>
          </div>
          <div class="col-md-4" style="padding-top:30px;">
          <strong>Select Image:</strong>
          <br/>
          <input type="file" id="upload">
          <br/>
          <button class="btn btn-success upload-result">Upload Image</button>
          </div>


          <div class="col-md-4" style="">
          <div id="upload-demo-i" style="background:#e1e1e1;width:300px;padding:30px;height:300px;margin-top:30px"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- end upload profile image modal -->
@endsection

@section('script')



@endsection