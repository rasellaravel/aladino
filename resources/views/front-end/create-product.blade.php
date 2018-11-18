@extends('front-end.layout')


@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('front-end/autocomplete/css/amsify.suggestags.css')}}">
@endsection


@section('content')
<section class="listing">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h1>Add Product Listing</h1>
      </div>
      <form action="{{url('store-user-product')}}" method="post">
      @csrf
      <div class="col-md-9 add-product-listing">
         <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label">Product Title <br><small>Include keywords that buyers would use to search for your item.</small></label>
          <div class="col-sm-8">
            <input type="text" class="check_shop_name form-control" id="inputEmail3" placeholder="Product Title" name="product_title" value="" required>
          </div>
        </div>
        <br>
        <br>
        <br>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label">Product Price <br><small>Please Add your product price ($)</small></label>
          <div class="col-sm-8">
            <input type="text" class="check_shop_name form-control" id="inputEmail3" placeholder="($50)" name="product_price" value="" required>
          </div>
        </div>
        <br>
        <br>
        <br>
         <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label">About this listing <br><small><u>Learn more about what types of items are allowed on Aladino.</u></small></label>
          <div class="col-sm-4">
              <select class="form-control" name="who_made_it" required>
                 <option  selected value> Who made it?</option>
                  <option>I did</option>
                  <option>A mamber of my shop</option>
                  <option>Another company or person</option>
              </select>
          </div>
          <div class="col-sm-4">
               <select class="form-control" name="who_is_it" required>
                 <option  selected value>What is it?</option>
                  <option>A finished Product</option>
                  <option>A supply or tools to make thing</option>
              </select>
          </div>
        </div>
         <br>

        <br>
        <hr/>
        <br>


         <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label">Select Category<br><small>please select primiray category and subcategory</small></label>
          <div class="col-sm-4">
              <select class="form-control" id="category" name="category" required>
                 <option  selected value> Select Category </option>
                    @foreach($categories as $categories)
                      <option value="{{$categories->id}}">
                        {{$categories->category_name}}</option>
                    @endforeach  
              </select>
          </div>
          <div class="col-sm-4">
               <select class="form-control" id="sub_category" name="sub_category" required>
                <option  selected value> Select Category </option>
                   
              </select>
          </div>
        </div>
        <br>
        <br>
        <br>
         <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label">Select Tri sub Category<br><small>please select primiray category and subcategory</small></label>
          <div class="col-sm-8">
              <select class="form-control" id="tri_sub_category" name="tri_sub_category" required>
                 
              </select>
          </div>
        </div>

        <br>
        <br>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label">Select Size <br><small></small></label>
          <div class="col-sm-8">
              
                 
              </select>
          </div>
        </div>

        <hr>
        <div class="form-group">
         <!--  <label for="inputEmail3" class="col-sm-4 control-label">Select Tri sub Category<br><small>please select primiray category and subcategory</small></label> -->
          <div class="col-sm-12">
             <textarea class="form-control" id="summary-ckeditor" rows="3" name="aboutshop" required></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12 text-right">
             <button type="submit" value="Save" class="btn btn-success">Save</button>
          </div>
        </div>

      </form>

      </div>
    </div>
  </div>
</section>




    <div class="form-group">
      <input type="text" class="form-control" name="color" value="Orange,Black"/>
    </div>


@endsection

@section('script')
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('front-end/autocomplete/js/jquery.amsify.suggestags.js') }}"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor' );
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
        $.ajax({
      type:'POST',
      url:'get-sub-category',
      data: {id:id},
      success:function(response){
        console.log(response);
        $("#sub_category option:selected").prop("selected", false)
        $('#sub_category').html(response);
        
      }
    });

       });
  });

  $(document).ready(function(){
       $('#sub_category').change(function(){
        var id  = $(this).val();
        alert(id);
        $.ajax({
      type:'POST',
      url:'get-tri_sub-category',
      data: {id:id},
      success:function(response){
        $('#tri_sub_category').html(response);
        alert(response);
        
      }
    });

       });
  });
</script>

<script type="text/javascript">
  $('input[name="color"]').amsifySuggestags({
    type : 'amsify',
    suggestions: ['Black', 'White', 'Red', 'Blue', 'Green', 'Orange']
  });

</script>
@endsection