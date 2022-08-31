@extends('layouts.appuser')

@section('content')

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>







<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
 
}

.price {
  color: grey;
  font-size: 22px;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: black;
  background-color: #C0C0C0;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}

.mySlides {display:none;}
</style>
</head>
<body>
@if ($trips->isEmpty())
@else

@foreach($trips as $tripinfo)
<div class="w3-content w3-display-container">


  
   
  </div>

  <div class="w3-display-container mySlides">
  <img src="{{ asset('uploads/images/'.$tripinfo->thumbnail) }}" height="650" style="width:100%">
  <div class="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-black" >
 <a href="{{url('User/specific_trip/'.$tripinfo->id)}}"> {{$tripinfo->title}}</a>
  </div>
</div>

  @endforeach

  <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>
@endif
<h2 style="text-align:center">Most Rated</h2>

<div class="w3-row w3-border">
@foreach($top_rated as $top_rated)
<div class="w3-quarter w3-container ">
<div class="card">
  <img src="{{ asset('uploads/images/'.$top_rated->thumbnail) }}" alt="Denim Jeans" height="350" style="width:100%;">
 
  
  <form action="{{url('User/specific_trip/'.$top_rated->id)}}">
  <p><button>Details</button></p>
</form>
</div>
</div>

@endforeach
</div>
<br>
<br>
<br>

<h2 style="text-align:center">New trips</h2>

<div class="w3-row w3-border">
@foreach($most_recent as $most_recent)
<div class="w3-quarter w3-container ">
<div class="card">
  <img src="{{ asset('uploads/images/'.$most_recent->thumbnail) }}" alt="Denim Jeans" height="350" style="width:100%;">
 
  <form action="{{url('User/specific_trip/'.$most_recent->id)}}">
  <p><button>details</button></p>
</form>
</div>
</div>
@endforeach


</div>
<!-- Our Advantages-->
<br>
          <br>
          <br>
          <br>
          <br>
<section class="section section-lg bg-default text-center" id="advantages">
        <div class="container">
          <h1>Our Advantages</h1>
          <br>
          

          <h3><span style="max-width: 570px;">You can rely on our experience and the quality of services we provide. Here are other reasons to book tours at ExploreTour.</span></h3>
          <br>
          <br>
          <div class="row row-50 justify-content-center">
            <div class="col-sm-6 col-lg-4 col-xl-3 wow fadeIn" data-wow-delay=".2s">
              <!-- Box Classic-->
              <article class="box-classic"><i class="fas fa-wallet fa-9x"></i><a class="box-classic-main" href="#">
                  <h4 class="box-classic-title">Lowest Prices</h4>
                  <div class="box-classic-inner">
                   
                  </div></a></article>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3 wow fadeIn" data-wow-delay=".3s">
              <!-- Box Classic-->
              <article class="box-classic"><i class="fas fa-check-double fa-9x"></i><a class="box-classic-main" href="#">
                  <h4 class="box-classic-title">Variety of Tours</h4>
                  <div class="box-classic-inner">
                    
                  </div></a></article>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3 wow fadeIn" data-wow-delay=".4s">
              <!-- Box Classic-->
              <article class="box-classic"><i class="far fa-thumbs-up fa-9x"></i><a class="box-classic-main" href="#">
                  <h4 class="box-classic-title">Easy Booking</h4>
                  <div class="box-classic-inner">
                    
                  </div></a></article>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3 wow fadeIn" data-wow-delay=".5s">
              <!-- Box Classic-->
              <article class="box-classic"><i class="far fa-gem fa-9x"></i></a><a class="box-classic-main" href="#">
                  <h4 >Most Popular Agency</h4>
                  <div >
                    
                  </div></a></article>
            </div>
          </div>
        </div>
      </section>
      <br>
          <br>
          <br>
          <br>
          <br>

</body>
</html>
@endsection