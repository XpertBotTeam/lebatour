@extends('layouts.appguide')

@section('content')


@if ($trips->isEmpty())
@else

@foreach($trips as $tripinfo)
<div class="w3-content w3-display-container">


  
   
  </div>

  <div class="w3-display-container mySlides">
  <img src="{{ asset('uploads/images/'.$tripinfo->thumbnail) }}" height="650" style="width:100%">
  
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                   <h4> hi guide :{{Auth::user()->name}}</h4>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- our policy -->
<section class="w3-container w3-center w3-content" style="max-width:600px">
  <h2 class="w3-wide">Our policy</h2>
  <p class="w3-opacity"><i>We love music</i></p>
  <p class="w3-justify">We have created a this website in order to encourage tourism in lebanon and creating new job opportunity to the local .as guide you are the face of our company so we hope that you represent us well.being late on any trips we will have you banned.have a bad review by a lot of people will also get you banned.on the other hand having a lot of traction and good reviews you will be rwarded</p>
</section>




@endsection