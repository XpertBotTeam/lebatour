
<!DOCTYPE html>
<html>
<head>
    <style>
.center {
position: absolute;
left: 50%;
top: 50%;
transform: translate(-50%, -50%);

padding: 10px;
}

        </style>
</head>
<body style="background-color:powderblue;">
<div class="center">
<script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$res['id']}}"></script>
<form action="{{route('offers.status', ['trip_id' => $id , 'quantity' => $quantity])}}" class="paymentWidgets" data-brands="VISA MASTER"></form>



<form action="{{url('User/specific_trip/'.$id)}}">
  <p><button  >cancel</button></p>
  </form>

</div>
</body>
</html>
