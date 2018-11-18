<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{asset('users/assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/line-awesome/css/line-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/themify-icons/css/themify-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/animate.css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/toastr/toastr.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/vendors/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/css/main.min.css')}}" rel="stylesheet" />
    <link href="{{asset('users/assets/css/custom.css')}}" rel="stylesheet" />
  
</head>
<body style="background-color: #271e1e21;">
<!-- 4000000760000002 -->
<div class="container">
  <div class="row" style="margin-top: 10%;">
    <div class="col-md-6 col-md-offset-3">
     <div class="ibox" style="margin-top: 50px;">
        <div class="ibox-head">
            <div class="ibox-title">Credit or debit card</div>
            <b>USD {{Session::get('total_amount')}}</b>
        </div>
        <div class="ibox-body">
          <form action="{{url('payment')}}" method="post" id="payment-form">
           @csrf
            <div class="form-row">
              <label for="card-element">
                
              </label>
              <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
              </div>

              <!-- Used to display form errors. -->
              <div id="card-errors" role="alert"></div>
            </div>

           
          
        </div>
        <div class="ibox-footer">
             <button class="btn btn-gradient-silver btn-fix">Pay Now</button>
        </div>
        </form>
      </div>  
    </div>
  </div>
</div>

<script src="{{asset('users/assets/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/metisMenu/dist/metisMenu.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/jquery-idletimer/dist/idle-timer.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/toastr/toastr.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('users/assets/vendors/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('users/assets/js/app.min.js')}}"></script>
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
  var stripe = Stripe('pk_test_z5b82vjYLpDXDQaWILGknvyR');
  var elements = stripe.elements();
  var style = {
  base: {
    // Add your base input styles here. For example:
    fontSize: '16px',
    color: "#32325d",
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});


var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the customer that there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

function stripeTokenHandler(token) {
  console.log(token);
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();

}
</script>

</body>
</html>






