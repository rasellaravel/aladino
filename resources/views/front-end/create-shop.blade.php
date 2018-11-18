@extends('front-end.layout')


@section('style')

@endsection


@section('content')

<section class="create-shop well text-center">
  <h1>Create your one shop</h1>
<p>Let's get started! Tell us about you and your shop.</p>
</section>

<section class="container shop-value">
  <div class="row">
  <form action="{{url('shop-store')}}" method="post">
    @csrf
    <div class="col-md-6">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Shop Language</label>
        <div class="col-sm-8">
          <select class="form-control" name="language" required>
          <option  selected value> Select language </option>
          @foreach($ShopLanguage as $ShopLanguage)
            <option value="{{$ShopLanguage->id}}"
            @if($shops->language_id==$ShopLanguage->id)
            selected
            @endif
            >{{$ShopLanguage->language}}</option>
          @endforeach  
          </select>
        </div>
      </div>
      <br/>
      <br/>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Shop Country</label>
        <div class="col-sm-8">
          <select class="form-control" name="country" required>
            <option  selected value> Select Country </option>
            @foreach($ShopCountry as $ShopCountry)
              <option value="{{$ShopCountry->id}}"
                @if($shops->country_id==$ShopCountry->id)
                selected
                @endif
              >{{$ShopCountry->shop_country}}</option>
            @endforeach  
          </select>
        </div>
      </div>
      <br/>
      <br/>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Shop Currency</label>
        <div class="col-sm-8">
          <select class="form-control" name="currency" required>
           <option  selected value> Select Currency </option>
            @foreach($ShopCurrency as $ShopCurrency)
              <option value="{{$ShopCurrency->id}}"
              @if($shops->currency_id==$ShopCurrency->id)
                selected
              @endif

              >{{$ShopCurrency->currency}}</option>
            @endforeach  
          </select>
        </div>
      </div>
       <br/>
       <br/>
    </div>
    <div class="col-md-6 shop-des">
      <p>The default language you'll use to describe your items. Choose carefully! You cannot change this once you save it, but may add other languages later.</p>

      <p>Where is your shop based?</p>

      <p>The currency you'll use to price your items. Shoppers in other countries will automatically see prices in their local currency.</p>
    </div>
  </div>
  <hr/>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Shop Name</label>
        <div class="col-sm-8">
          <input type="text" class="check_shop_name form-control" id="inputEmail3" placeholder="Shop Name" name="shopname" value="{{$shops->shop_name}}" required>
        </div>
      </div>
      <br/>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Shop Title</label>
        <div class="col-sm-8">
          <input type="text" class="check_shop_name form-control" id="inputEmail3" placeholder="Shop Name" name="shoptitle" value="shop_title" required>
        </div>
      </div>
      <br/>
      <br/>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">About Shop</label>
        <div class="col-sm-8">
          <textarea class="form-control" rows="3" name="aboutshop" required>{{$shops->about_shop}}</textarea>
        </div>
      </div>
      <br/>
      <br/>
    </div>
    <div class="col-md-6 shop-des">
      <p>Your shop name will appear in your shop and next to each of your listings throughout Etsy. After you open your shop, you can change your name once</p>

      <p>Please Say about your shop</p>

     
    </div>
    <div class="create-shop-button text-right">
      <button type="submit" class="btn btn-danger">Create Shop</button>
    </div>
    </form>
  </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
  $('.check_shop_name').keyup(function(){
    var content = $(this).val();
    console.log(content);
    $.ajax({
      type:'POST',
      url:'check_shopname',
      data:{val:content},
      success:function(response){
          console.log(response);
      }
    });
  });
</script>
@endsection