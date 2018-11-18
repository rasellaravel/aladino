@extends('users.layout')
@section('page_style')
 <link href="{{asset('users/assets/phone-plugin/css/intlTelInput.css')}}" rel="stylesheet" />
@endsection

@section('row_style')
<style type="text/css">
.iti-flag {
    background-image: url("users/assets/phone-plugin/img/flags.png");
}

@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .iti-flag {background-image: url("users/assets/phone-plugin/img/flags.png");}
}
.errors{
  color: red;
  font-size: 12px;
}
</style>
@endsection

@section('content')
<?php
    $country = DB::table('countries')->get();
?>
<section class="buing_info_page" style="background-color: #E7EAED;">
    <div class="container">
        <div class="row justify-content-center">
             <div class="col-md-6" style="margin-bottom: 68px;">
                <div class="ibox ibox-fullheight" style="margin-top: 40px;">
                    <div class="ibox-head text-center">
                        <div class="ibox-title text-center">Provide your contact info</div>
                    </div>
                    <form class="form-info" action="{{url('save_user_info')}}" method="post">
                    @csrf
                        <div class="ibox-body">
                            <?php
                             $location = geoip()->getLocation('45.248.151.251');
                              $get_country = DB::table('countries')->get();
                            ?>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group mb-4">
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
                              <div class="col-md-6">
                                <div class="form-group mb-4">
                                <input class="form-control form-control-line" type="text" placeholder="City" name="city" value="{{old('city')}}">
                                <span class="errors">{{ $errors->first('city') }}</span>
                                </div>
                              </div>
                            </div>
                            
                            <div class="form-group mb-4">
                                <input class="form-control form-control-line" type="text" placeholder="Enter  Address" name="address" value="{{old('address')}}">
                                <span class="errors">{{ $errors->first('address') }}</span>
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control form-control-line" type="text" placeholder="Aditionl Infomrmation(optional)" name="additional" value="{{old('additional')}}">
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-8 form-group mb-4">
                                    <input class="form-control form-control-line" type="text" placeholder="State / Province / Region" name="state" value="{{old('state')}}">
                                    <span class="errors">{{ $errors->first('state') }}</span>
                                </div>
                                <div class="col-sm-4 form-group mb-4">
                                    <input class="form-control form-control-line" type="text" placeholder="Postal Code" name="postal_code" value="{{old('postal_code')}}">
                                     <span class="errors">{{ $errors->first('postal_code') }}</span>
                                </div>
                            </div>
                             <div class="form-group mb-4">
                                <input class="form-control form-control-line" type="tel" id="phone" name="phone" value="{{old('phone')}}">
                                <span class="errors">{{ $errors->first('phone') }}</span>
                            </div>
                        </div>
                        <div class="ibox-footer">
                            <button class="btn btn-info mr-2" type="submit">Continue</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
    </div>
</section>    
@endsection

@section('page_level')
<script src="{{asset('users/assets/phone-plugin/js/intlTelInput.js')}}"></script>
@endsection


@section('core_script')
<!-- phone number javascript -->
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "polite",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: true,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "build/js/utils.js",
    });
</script>


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

@endsection



