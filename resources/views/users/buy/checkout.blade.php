@extends('users.layout')
@section('page_style')

@endsection

@section('row_style')
<style type="text/css">
  .primary_address p{
    line-height: 8px;
  }
  .all_address a{
    color: #006EFC;
    font-size: 12px;
  }
</style>

@endsection

@section('content')

<?php
$array = array();
foreach(Cart::content() as $row){
    $array[] = $row->options->shop_id;
}

$unique_shop = array_unique($array);
$total_shop =  array_values($unique_shop);
?>

<section class="checkout_body" style="background-color: #E7EAED;">
     <div class="loading3" style="position:fixed;top:35%;left:30%;z-index: 9999;display: none">
       <img src="{{asset('users/loading.gif')}}"> 
    </div>
  <div class="container">
  <!-- start paymet method -->
    <div class="row">
      <div class="col-md-8" style="margin-bottom: 0px;">
          <div class="ibox" style="margin-top: 50px;">
              <div class="ibox-head">
                  <div class="ibox-title">Pay with</div>
              </div>
              <div class="ibox-body">
                  <div class="form-group">
                      <label class="radio radio-success">
                        <input type="radio" name="b">
                        <span class="input-span" style=""></span><img src="{{asset('users/assets/img/checkout/paysera.png')}}" style="height: 26px; width: 120px; margin-top: -3px;">
                      </label>
                  </div>
                  <div class="form-group">
                      <label class="radio radio-success">
                        <input type="radio" name="b">
                        <span class="input-span" style=""></span><img src="{{asset('users/assets/img/checkout/paypal.png')}}" style="height: 57px; width: 120px; margin-top: -18px;">
                      </label>
                  </div>
              </div>
          </div>
        </div>
        <div class="col-md-4">
         <div class="ibox" style="margin-top: 50px;">
            <div class="ibox-head">
                <div class="ibox-title">Pay Now</div>
            </div>
            <div class="ibox-body" id="paynowRefresh">
                <?php
                    $total_shipping_cost = 0;
                    $total_product_price = 0;

                    for ($i=0; $i < count($total_shop); $i++) { 
                        $shop_id = $total_shop[$i];
                        $shipping_cost = 0;
                        $amount = 0;

                        $item_count = 0;
                        foreach (Cart::content() as $key => $row) {
                        if($row->options->shop_id==$shop_id){
                            $item_count++;
                             if($row->options->shipping!='Free Shipping'){
                                if($row->options->extra_item==1 && $item_count>1 ){
                                    $shipping_cost = $shipping_cost + 2;
                             
                                }else{
                                    $shipping_cost = $shipping_cost + $row->options->shipping;
                                    
                                }
                                    
                            }else{
                                $shipping_cost = $row->options->shipping;
                               
                            }
                           
                            $amount = $amount+$row->total;


                         } } 
                         $total_product_price = $total_product_price + $amount;
                         $total_shipping_cost =  $total_shipping_cost + (int)$shipping_cost;


                    }

                ?>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-md-8">
                    Total Product Price
                  </div>
                  <div class="col-md-4">
                    USD <?php echo $total_product_price;?>
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px">
                  <div class="col-md-8">
                    Total Shipping Cost
                  </div>
                  <div class="col-md-4">
                    USD <?php echo $total_shipping_cost;?>
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px">
                  <div class="col-md-8">
                    Total Payble Including all
                  </div>
                  <div class="col-md-4">
                    <?php
                      if(is_numeric($total_shipping_cost)){
                            $final_cost = $total_product_price + $total_shipping_cost;
                        }
                       echo 'USD '.$final_cost;
                    ?>
                    <input type="hidden" id="product_total_coat" value="{{$final_cost}}">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                     <a href="javascript:;" onclick="gotoPayment();" class="btn btn-primary btn-block" style="color: white">Proced to checkout</a>
                  </div>
                </div>
            </div>
          </div>
      </div>
      </div>
      <!-- end payment method -->      

    <!-- Start ship to -->  
    <div class="row">
       <div class="col-md-8" style="margin-top: -55px;">
          <div class="ibox">
              <div class="ibox-head">
                  <div class="ibox-title">Ship to</div>
              </div>
              <div class="ibox-body" id="address_refresh">
                 <!-- primary Address -->
                 <div class="primary_address" style="">
                 <?php 
                  $shipped_address = DB::table('user_different_addresses')->where('user_id',Auth()->user()->id)->where('shipped_address',1)->first();
                  if(!$shipped_address){
                    $shipped_address = DB::table('user_different_addresses')->where('user_id',Auth()->user()->id)->where('primary_address',1)->first();
                  }

                 ?>
                   
                     @if($shipped_address)
                     <p> {{$shipped_address->f_name}}</p>
                      <p> {{$shipped_address->street_address1}} {{$shipped_address->street_address2}}</p>
                      <p> {{$shipped_address->city}}, {{$shipped_address->state}} {{$shipped_address->zip}}</p>
                      <p> {{$shipped_address->country}}</p>
                      <p> {{$shipped_address->phone}}</p>
                      <p><a href="javascript:;" style="color: #009EFD;font-size: 11px;" onclick="primary_address_change();">Change</a> </p>
                      <input type="hidden" id="address_id" value="{{$shipped_address->id}}">
                     @endif
                   
                 </div>
                  <!-- end primary Address -->

                   <!-- All Address -->
                  <div class="all_address" style="display: none">
                  <?php
                    $all_address = DB::table('user_different_addresses')->where('user_id',Auth()->user()->id)->get();
                  ?>
                  @if($all_address)
                  @foreach($all_address as $address)
                   <div class="form-group">
                      <label class="radio radio-success" id="{{$address->id}}" onclick="selectedItem(this.id);">
                          <input type="radio" name="b">
                          <span class="input-span" style=""></span>
                          {{$address->f_name}}<br>
                          {{$address->street_address1}} {{$address->street_address2}}<br>
                          {{$address->city}}, {{$address->state}}  {{$address->zip}} <br>
                          {{$address->country}}<br>
                          {{$address->phone}}<br>
                      </label>
                      <br>
                       <a href="javascript:;" id="{{$address->id}}" onclick="itemEdit(this.id);" style="margin-left: 26px;">Edit</a>
                  </div>
                  <hr>
                  @endforeach
                  @endif
                  <div class="add_new_item">
                    <a href="" id="add_new_address_shipping">Add New Address</a>
                  </div>
                  <hr>
                  <div class="cancle">
                    <a href="javascript:;" id="back_fist_page">Cancle</a>
                  </div>
                </div>
                <!-- End All Address -->

                 <!-- Add New Address -->
                <form id="SaveShippingAddress" method="post" style="display: none;">
                @csrf
                 <div class="add_new_address">
                   <div class="row">
                    <div class="loading" style="position:absolute;top:25%;left:34%;z-index: 9999;display: none;">
                       <img src="{{asset('users/loading.gif')}}"> 
                    </div>
                     <div class="col-sm-6 form-group mb-4">
                     <?php
                       $get_country = DB::table('countries')->get();
                      $location = geoip()->getLocation('45.248.151.251');
                     ?>
                       <select class="form-control form-control-line" name="country">
                           @foreach($get_country as $country)
                            <option value="{{$country->name}}"
                            @if($location['country']==$country->name)
                              selected
                            @endif
                            >{{$country->name}}</option>
                          @endforeach  
                      </select>
                    </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-6 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="First Name" name="f_name">
                      </div>
                       <div class="col-sm-6 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="Last Name" name="l_name">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-6 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="Street address" name="s_address">
                      </div>
                       <div class="col-sm-6 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="Street address1 (optional)" name="s_address2">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-4 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="City" name="city">
                      </div>
                       <div class="col-sm-4 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="State" name="state">
                      </div>
                      <div class="col-sm-4 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="Zip" name="zip">
                      </div>
                   </div>
                    <div class="row">
                      <div class="col-sm-6 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="Phone Number" name="phone">
                      </div>
                   </div>
                   <div class="form-group">
                      <label class="checkbox checkbox-success">
                      <input type="checkbox" name="isPrimary" value="1">
                      <span class="input-span"></span>Save as primary address</label>
                  </div>
                  <div class="saveandcanclebutton" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-gradient-blue-pink btn-fix" style="margin-right: 13px;">Add</button>
                    <a href="" id="back_fist_page2" class="btn btn-gradient-lime btn-fix">Cancel</a>
                  </div>
                 </div>
                 </form>
                 <!-- End Add New Address -->

                 <!-- Start Edit Address -->
              <form id="EditShippingAddress" method="post" style="display: none;">
               <?php
                  if(Session::has('edit_id')){
                    $editable_id = Session::get('edit_id');
                    $data = DB::table('user_different_addresses')->where('id',$editable_id)->first();
                    if($data){
                ?>
                 <div class="add_new_address">
                   <div class="row">

                   <div class="loading1" style="position:absolute;top:25%;left:34%;z-index: 9999;display: none;">
                       <img src="{{asset('users/loading.gif')}}"> 
                    </div>

                     <div class="col-sm-6 form-group mb-4">
                     <?php
                      $get_country = DB::table('countries')->get();
                      $location = geoip()->getLocation('45.248.151.251');
                     ?>
                       <select class="form-control form-control-line" name="country">
                           @foreach($get_country as $country)
                            <option value="{{$country->name}}"
                            @if($location['country']==$country->name)
                              selected
                            @endif
                            >{{$country->name}}</option>
                          @endforeach  
                      </select>
                    </div>
                   </div>
                   <input type="hidden" name="update_id" value="{{$data->id}}">
                   <div class="row">
                      <div class="col-sm-6 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="First Name" name="f_name" value="{{$data->f_name}}">
                      </div>
                       <div class="col-sm-6 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="Last Name" name="l_name" value="{{$data->l_name}}">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-6 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="Street address" name="s_address" value="{{$data->street_address1}}">
                      </div>
                       <div class="col-sm-6 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="Street address1 (optional)" name="s_address2" value="{{$data->street_address2}}">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-4 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="City" name="city" value="{{$data->city}}">
                      </div>
                       <div class="col-sm-4 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="State" name="state" value="{{$data->state}}">
                      </div>
                      <div class="col-sm-4 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="Zip" name="zip" value="{{$data->zip}}">
                      </div>
                   </div>
                    <div class="row">
                      <div class="col-sm-6 form-group mb-4">
                       <input class="form-control form-control-line" type="text" placeholder="Phone Number" name="phone" value="{{$data->phone}}">
                      </div>
                   </div>
                   <div class="form-group">
                      <label class="checkbox checkbox-success">
                      <input type="checkbox" name="isPrimary" value="1"
                      @if($data->primary_address==1)
                      checked
                      @endif
                      >
                      <span class="input-span"></span>Save as primary address</label>
                  </div>
                  <div class="saveandcanclebutton" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-gradient-blue-pink btn-fix" style="margin-right: 13px;">Update</button>
                    <a href="javascript:;" onclick="cancle();" id="back_fist_page3" class="btn btn-gradient-lime btn-fix">Cancel</a>
                  </div>
                 </div>
                 <?php } } ?>
                 </form>
                 <!-- end Edit Address -->
              </div>
          </div>
        </div>
      </div>
     <!--  end sipp to -->
         <!--  end all address changing  -->

 
         <!-- Start Product view -->
        <section id="refresh">
         <div class="product_view">
           <?php
                $total_shipping_cost = 0;
                $total_product_price = 0;

                for ($i=0; $i < count($total_shop); $i++) { 
                    $shop_id = $total_shop[$i];
                    $shipping_cost = 0;
                    $amount = 0;
            ?>
         
            <div class="row">
                <div class="col-md-8">
                    <div class="ibox">
                    <!-- about shop -->
                        <div class="ibox-head">
                            <div class="ibox-title"> <img src="{{asset('users/shop/shop-img.jpg')}}" style="height: 25px; width: 40px;">
                            <?php
                                $shop_name = DB::table('shops')->where('id',$shop_id)->first();
                            ?>
                            <a href="{{url('shop-public-profile',$shop_id)}}" style="margin-right: 5px; font-size: 14px;">{{$shop_name->shop_name}}</a>
                            </div>
                             <a href="{{url('shop-public-profile',$shop_id)}}" style="font-size: 12px;">Contact Shop</a>
                        </div>
                        <!-- end about shop -->

                        <!-- start product  -->
                        <?php 
                        $item_count = 0;
                            foreach (Cart::content() as $key => $row) {
                                if($row->options->shop_id==$shop_id){
                                    $item_count++;
                                     if($row->options->shipping!='Free Shipping'){
                                        if($row->options->extra_item==1 && $item_count>1 ){
                                            $shipping_cost = $shipping_cost + 2;
                                     
                                        }else{
                                            $shipping_cost = $shipping_cost + $row->options->shipping;
                                            
                                        }
                                            
                                    }else{
                                        $shipping_cost = $row->options->shipping;
                                       
                                    }
                                   
                                    $amount = $amount+$row->total;
                            ?>
                        <div class="ibox-body">
                            <div class="row">
                              <div class="col-md-3">
                                <img src="{{asset('users/product-image/'.$row->options->image)}}" style="height: 150px; width: 150px;">
                              </div>
                              <div class="col-md-4">
                                <a href="">{{$row->name}}</a>
                                <br><br>
                                <p>Size: XS (2 US) US women's numeric</p>
                                <a href="{{url('product_view',$row->id)}}">Edit</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:;" onclick="item_remove(this.id);" id="{{$row->rowId}}" >Remove</a>
                              </div>
                              <div class="col-md-3">
                                <select class="quentity" id="{{$row->rowId}}" style="width: 70px; height: 34px;border: none;text-align: right;padding: 8px; background-color: #E7EAED;" onchange="item_update(this.value,this.id);">
                                        <option value="1"
                                        <?php
                                            if($row->qty=='1'){
                                                echo'selected';
                                            }
                                        ?>
                                        >1</option>
                                        <option value="2"
                                        <?php
                                            if($row->qty=='2'){
                                                echo'selected';
                                            }
                                        ?>
                                        >2</option>
                                        <option value="3"
                                        <?php
                                            if($row->qty=='3'){
                                                echo'selected';
                                            }
                                        ?>
                                        >3</option>
                                        <option value="4"
                                        <?php
                                            if($row->qty=='4'){
                                                echo'selected';
                                            }
                                        ?>
                                        >4</option>
                                        <option value="5"
                                        <?php
                                            if($row->qty=='5'){
                                                echo'selected';
                                            }
                                        ?>>5</option>
                                        <option value="6"
                                        <?php
                                            if($row->qty=='6'){
                                                echo'selected';
                                            }
                                        ?>
                                        >6</option>
                                        <option value="7"
                                        <?php
                                            if($row->qty=='7'){
                                                echo'selected';
                                            }
                                        ?>
                                        >7</option>
                                        <option value="8"
                                        <?php
                                            if($row->qty=='8'){
                                                echo'selected';
                                            }
                                        ?>
                                        >8</option>
                                        <option value="9"
                                        <?php
                                            if($row->qty=='9'){
                                                echo'selected';
                                            }
                                        ?>
                                        >9</option>

                                    </select>
                              </div>
                              <div class="col-md-2">
                                 <b>USD {{$row->total}}</b>
                              </div>
                            </div>
                        </div>
                        <?php } } $total_product_price = $total_product_price + $amount; ?>
                         <div class="ibox-footer text-right">
                                <?php
                                    $total_shipping_cost =  $total_shipping_cost + (int)$shipping_cost;
                                ?>
                                 <p><b>Shipping to {{$row->options->shipping_location}} - USD {{$shipping_cost}}</b></p>
                                <p><b>Total Product Price - USD {{$amount}}</b></p>
                                <p><b>Total Amount including shipping - USD {{$amount+$shipping_cost}}</b></p>
                          </div>
                        <!-- end product -->
                    </div>
                </div>
            </div>
          </div>
          <?php } ?>
          </section> 
         <!-- end product View -->
      </div>
     
    </div>
  </div>
</section>


@endsection

@section('page_level')

@endsection


@section('core_script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#quentity').change(function(){
            $(this).closest("#top_most").css( "opacity", "0.5" );
            $('.loading').css('display','block');

        });
    });
</script>
<script type="text/javascript">
   $.ajaxSetup({
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
      $('#SaveShippingAddress').on('submit',function(){
        $('.loading').css('display','block');
        $.ajax({
            type:'POST',
            url:'{{url("add_differect_shipping_address")}}',
            processData: false,
            contentType: false,
            data: new FormData(this),
            success:function(response){
              
                $("#address_refresh").load(location.href+" #address_refresh>*","");
                setTimeout(function(){ $('.loading').css('display','none'); }, 3000);
                $('#SaveShippingAddress')[0].reset();
                $('#SaveShippingAddress').css('display','none');
                $(".all_address").load(location.href+" .all_address>*","");
                $('.primary_address').css('display','block');
            }
        });
        return false;
      });
  });
</script>
<script type="text/javascript">
  function primary_address_change()
  {
     $('.primary_address').css('display','none');
     $('.all_address').css('display','block');
     return false;

  }
  // $(document).ready(function(){
  //   $('#primary_address_change').click(function(){
  //          return false;
  //   });
  // })
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#add_new_address_shipping').click(function(){
      $('.primary_address').css('display','none');
      $('.all_address').css('display','none');
      $('#SaveShippingAddress').css('display','block');
      return false;
    });
  })
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#back_fist_page').click(function(){
      $('.primary_address').css('display','block');
      $('.all_address').css('display','none');
      $('#SaveShippingAddress').css('display','none');
      return false;
    });
  })
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#back_fist_page2').click(function(){
      $('.primary_address').css('display','block');
      $('.all_address').css('display','none');
      $('#SaveShippingAddress').css('display','none');
      return false;
    });
  })
</script>
<script type="text/javascript">
  function cancle()
  {
    $('.all_address').css('display','none');
    $('#SaveShippingAddress').css('display','none');
    $('#EditShippingAddress').css('display','none');
    $('.primary_address').css('display','block');

  }
</script>
<script type="text/javascript">
   function itemEdit(id)
   {
     $.ajax({
          type:'POST',
          url:'{{url("buying_shipping_add_edit")}}',
          data: {id:id},
          success:function(response){
            $('.primary_address').css('display','none');
            $('.all_address').css('display','none');
            $('#SaveShippingAddress').css('display','none');
            $("#EditShippingAddress").load(location.href+" #EditShippingAddress>*","");
            $('#EditShippingAddress').css('display','block');  
            console.log(response);
          }
      });
   }
</script>
<script type="text/javascript">
  $(document).ready(function(){
      $('#EditShippingAddress').on('submit',function(){
         $('.loading1').css('display','block');
        $.ajax({
            type:'POST',
            url:'{{url("edit_differect_shipping_address")}}',
            processData: false,
            contentType: false,
            data: new FormData(this),
            success:function(response){
                setTimeout(function(){ $('.loading1').css('display','none'); }, 3000);
                $('#SaveShippingAddress').css('display','none');
                $(".all_address").load(location.href+" .all_address>*","");
                $('.primary_address').css('display','none');
                $('#EditShippingAddress').css('display','none');
                $(".all_address").css('display','block');

                
            }
        });
        return false;
      });
  });
</script>
<script type="text/javascript">
    function item_remove(rowid)
    {
      $('.loading3').css('display','block');
        $.ajax({
            type:'POST',
            url:'{{url("remove_cart_item")}}',
            data: {rowid:rowid},
            success:function(response){
                $("#refresh").load(location.href+" #refresh>*","");
                $("#paynowRefresh").load(location.href+" #paynowRefresh>*","");
                $('.loading3').css('display','none');
                // $("#shopping_card_ref").load(location.href+" #shopping_card_ref>*","");
                
            }
        });
    }
</script>
<script type="text/javascript">
    function item_update(item,rowid)
    {  
     $('.loading3').css('display','block');
        $.ajax({
            type:'POST',
            url:'{{url("update_item")}}',
            data: {rowid:rowid,item:item},
            success:function(response){
                console.log(response);
                $("#refresh").load(location.href+" #refresh>*","");
                $("#paynowRefresh").load(location.href+" #paynowRefresh>*","");
                $('.loading3').css('display','none');
                
            }
        });
    }
</script>


<script type="text/javascript">
  function selectedItem(id)
  {
      $.ajax({
            type:'post',
            url:'{{url("shipping_selected_address")}}',
            data: {id:id},
            success:function(response){
                console.log(response);
                // $("#refresh").load(location.href+" #refresh>*","");
                // $("#paynowRefresh").load(location.href+" #paynowRefresh>*","");
                // $('.loading3').css('display','none');

                $('#SaveShippingAddress').css('display','none');
               
                $('#EditShippingAddress').css('display','none');
                $(".all_address").css('display','none');
                $(".primary_address").load(location.href+" .primary_address>*","");
                $('.primary_address').css('display','block');
                
            }
        });
  }
</script>
<script type="text/javascript">
  function gotoPayment()
  {
    var address_id = $('#address_id').val();
    var total_amount = $('#product_total_coat').val();
    $.ajax({
            type:'POST',
            url:'{{url("goForPayment")}}',
            data: {address_id:address_id,total_amount:total_amount},
            success:function(response){
                console.log(response);
                // $("#refresh").load(location.href+" #refresh>*","");
                // $("#paynowRefresh").load(location.href+" #paynowRefresh>*","");
                // $('.loading3').css('display','none');
                window.location ='{{url("gotoPayment")}}';
                
            }
        });

  }
</script>


@endsection



