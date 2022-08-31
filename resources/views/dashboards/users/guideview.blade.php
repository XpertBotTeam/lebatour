@extends('layouts.appuser')

@section('content')
@foreach( $guide as $guide )
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
</head>
<body class="w3-theme-l5">


<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">My Profile</h4>
         <p class="w3-center"><img src="{{ asset('uploads/images/'.$guide->profile) }}" class="w3-circle" style="height:450px;width:450px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-text-theme"></i> Guide</p>
         <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i>{{$guide->nameoncard}}</p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>{{$guide->birthdayoncard}}</p>
         <p><i class="fa fa-phone fa-fw w3-margin-right w3-text-theme"></i>{{$guide->phonenumber}}</p>

        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">


        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>My experties</button>
          <div id="Demo1" class="w3-hide w3-container">
            <p>{{$guide->experties}}</p>
          </div>
          
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My trips</button>
          <div id="Demo2" class="w3-hide w3-container">
          @foreach($trip as $trip)
          <div class="w3-half">
             <img src="{{ asset('uploads/images/'.$trip->thumbnail) }}" style="width:80%;max-height:200px" class="w3-margin-bottom">
           
          <h5><a href="{{url('User/specific_trip/'.$trip->id)}}">{{$trip->title}}</a></h5>
          <p>{{$trip->description}}</p>
          <p>price:{{$trip->priceperperson}} eur</p>
          <p>time:{{$trip->time}}</p>
          </div>
           @endforeach
          </div>
          <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>photo of My trips</button>
          <div id="Demo3" class="w3-hide w3-container">
         <div class="w3-row-padding">
         <br>
         @foreach($album as $album)
           <div class="w3-half">
             <img src="{{ asset('uploads/images/'.$album->image) }}" style="width:100%;max-height:300px" class="w3-margin-bottom">
           </div>
           @endforeach
         </div>
          </div>
        </div>      
      </div>
      <br>
      
      
      </div>
      <br>
      
     
    
    <!-- End Left Column -->
    
    
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>
<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>


</body>
</html>
@endforeach
@endsection