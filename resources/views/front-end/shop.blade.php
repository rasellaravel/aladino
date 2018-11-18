@extends('front-end.layout')


@section('style')

@endsection


@section('content')

<section class="shop-banner">
  <img src="{{asset('user-image/shop-banner2.jpg')}}" style="height: 250px !important; width: 100%;" ; 
  class="img-responsive">
  <div class="upload-banner"><i class="fas fa-camera"></i></div>
</section>

<section class="shop">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="col-md-4 shop-images">
          <img src="{{asset('user-image/shop-image.png')}}" class="img-responsive">
          <div class="shop-image-upload text-right"><i class="fas fa-camera"></i></div>
        </div>
        <div class="col-md-8">
          <h2>Shop Name</h2>
          <p>Shop title</p>
          <p>(0) Sales</p>
          <button class="btn btn-default"><i class="far fa-heart"></i>&nbsp;&nbsp;&nbsp;Favorite Shop (0)</button>
          <button class="btn btn-default"><i class="fab fa-facebook"></i></button>
          <button class="btn btn-default"><i class="fab fa-pinterest-square"></i></button>
          <button class="btn btn-default"><i class="fab fa-twitter-square"></i></button>
          <a href="{{url('create-product')}}"><button class="btn btn-default">Add Listing</button></a>
        </div>
      </div>
      <div class="col-md-4 text-center">
      <p><small>SHOP OWNER</small></p>
        <img src="{{asset('user-image/1534158484.png')}}">
        <p>{{auth()->user()->name}}</p>
        <p><i class="far fa-envelope"></i>&nbsp;&nbsp;Contact</p>
      </div>
    </div>
  </div>
</section>


<section class="item">
  <div class="container">
    <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading"><h3>Product Item</h3></div>
      <div class="panel-body">
         <div class="col-md-3">
            <div class="main-item">
              <img src="{{asset('user-image/item.jpg')}}" class="img-responsive">
              <h4>product title</h4>
              <p>Shop name</p>
              <p><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>(1094)</p>
              <p><u>USD 15.00</u></p>

            </div>
          </div>
           <div class="col-md-3">
            <div class="main-item">
              <img src="{{asset('user-image/item.jpg')}}" class="img-responsive">
              <h4>product title</h4>
              <p>Shop name</p>
              <p><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>(1094)</p>
              <p><u>USD 15.00</u></p>

            </div>
          </div>
           <div class="col-md-3">
            <div class="main-item">
              <img src="{{asset('user-image/item.jpg')}}" class="img-responsive">
              <h4>product title</h4>
              <p>Shop name</p>
              <p><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>(1094)</p>
              <p><u>USD 15.00</u></p>

            </div>
          </div>
           <div class="col-md-3">
            <div class="main-item">
              <img src="{{asset('user-image/item.jpg')}}" class="img-responsive">
              <h4>product title</h4>
              <p>Shop name</p>
              <p><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>(1094)</p>
              <p><u>USD 15.00</u></p>

            </div>
          </div>
           <div class="col-md-3">
            <div class="main-item">
              <img src="{{asset('user-image/item.jpg')}}" class="img-responsive">
              <h4>product title</h4>
              <p>Shop name</p>
              <p><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>(1094)</p>
              <p><u>USD 15.00</u></p>

            </div>
          </div>
           <div class="col-md-3">
            <div class="main-item">
              <img src="{{asset('user-image/item.jpg')}}" class="img-responsive">
              <h4>product title</h4>
              <p>Shop name</p>
              <p><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>(1094)</p>
              <p><u>USD 15.00</u></p>

            </div>
          </div>
           <div class="col-md-3">
            <div class="main-item">
              <img src="{{asset('user-image/item.jpg')}}" class="img-responsive">
              <h4>product title</h4>
              <p>Shop name</p>
              <p><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>(1094)</p>
              <p><u>USD 15.00</u></p>

            </div>
          </div>
           <div class="col-md-3">
            <div class="main-item">
              <img src="{{asset('user-image/item.jpg')}}" class="img-responsive">
              <h4>product title</h4>
              <p>Shop name</p>
              <p><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>(1094)</p>
              <p><u>USD 15.00</u></p>

            </div>
          </div>

      </div>
    </div>
     
    </div>
  </div>
</section>

@endsection

@section('script')



@endsection