@extends('layouts.appuser')

@section('content')


<html>
    <head>
    <style>
.checked {
    color: orange;

    
}
.center {
  display: flex;
  justify-content: center;
  align-items: center;
 
 
}

body{
background:#00CED1;
font-family: 'Barlow Semi Condensed', sans-serif;
}
.main-section{
background:#FFFFFF;
width:80%;
margin: 0 auto;
padding: 10px;
margin-top:50px;
box-shadow:0px 2px 7px 1px #aa9191;
}
.hedding-title h1{
margin:0px;
padding:0px 0px 10px 0px;
font-size:25px;
}
.average-rating{
float:left;
text-align: center;
width:30%;
}
.average-rating h2{
margin:0px;
font-size:80px;

}
.average-rating p{
margin:0px;
font-size:20px;

}

.progress,.progress-2,.progress-3,.progress-4,.progress-5{
background:#F5F5F5;
border-radius: 13px;
height:18px;
width:97%;
padding:3px;
margin:5px 0px 3px 0px;
}
.progress:after,.progress-2:after,.progress-3:after,.progress-4:after,.progress-5:after{
content: '';
display: block;
background: #337AB7;
width:80%;
height: 100%;
border-radius: 9px;
}
.progress-2:after{
width: 60%;
}
.progress-3:after{
width:40%;
}
.progress-4:after{
width:20%;
}
.progress-5:after{
width:10%;
}
.loder-ratimg{
display: inline-block;
width:40%;
}
.start-part{
float:right;
width:30%;
text-align: center;
}
.start-part span{
color:#337AB7;
font-size:23px;
}
.reviews h1{
margin:10px 0px 20px 30px;
}
.user-img img{
height: 80px;
width: 80px;
border:1px solid blue;
border-radius: 50%;
}
.user-img-part{
width:30%;
float:left;
}
.user-img{
width:48%;
float:left;
text-align: center;
}
.user-text{
float:left;
}
.user-text h4,.user-text p{
margin:0px 0px 5px 0px;
}
.user-text p{
font-size: 20px;
font-weight: bold;
}
.user-text h4,.user-text span{
color:#B3B5B4;
}
.comment{
width:68%;
float:right;
width:
}



</style>

    @foreach ($trip as $trip)

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        


        
        <title></title>
    <meta charset="utf-8" />
	<script type='text/javascript'>
    var map;

    var defaultColor = 'blue';
    var hoverColor = 'red';
    var mouseDownColor = 'purple';

    function GetMap()
    {
        map = new Microsoft.Maps.Map('#myMap', {center: new Microsoft.Maps.Location({{ $trip->latitude }}, {{ $trip->longitude }})});
 
        var pin = new Microsoft.Maps.Pushpin(map.getCenter(), {
            color: defaultColor,
        });
       

        map.entities.push(pin);

        Microsoft.Maps.Events.addHandler(pin, 'mouseover', function (e) {
            e.target.setOptions({ color: hoverColor });
        });

        Microsoft.Maps.Events.addHandler(pin, 'mousedown', function (e) {
            e.target.setOptions({ color: mouseDownColor });
        });

        Microsoft.Maps.Events.addHandler(pin, 'mouseout', function (e) {
            e.target.setOptions({ color: defaultColor });
        });
    }
    </script>
    <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AvbiIeFn6oMhDKYaXE-NExTpceGs2wqTT3oVDYeZGwRlwSwCz2U6BrviGYlvPVKk' async defer></script>
    

    </head>
    <body>
    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          
          <div class="w3-display-bottomleft w3-container w3-text-black">
            
          </div>
        </div>
        <div class="w3-container">
        <h1>{{ $trip->title }}</h1>
        <br>
        <h3>Price per person:    {{ $trip->priceperperson }}<i class="fas fa-euro-sign fa-fw w3-margin-right w3-large w3-text-teal"></i></h3>
        <br>  
        <h4><i class="fa fa-calendar fa-fw  w3-margin-right w3-large w3-text-teal"></i>Day:    {{ $trip->Days }}</h4>
        <br>  
        <h4><i class="fa fa-clock fa-fw  w3-margin-right w3-large w3-text-teal"></i>Time:    {{ $trip->time }}</h4>
        <br>  
        <h4><i class="fa fa-map fa-fw  w3-margin-right w3-large w3-text-teal"></i>Address:{{ $trip->adminDistrict}}-{{$trip->city}}</h4>
        <br>  
        <h4    ><i class="fa fa-user-alt fa-fw  w3-margin-right w3-large w3-text-teal"></i>Guide:<a href="{{url('User/specific_guide/'.$trip->user_id)}}">{{$trip->name}}</a></h4>
        <br>
        <h4><i class="fa fa-file-invoice fa-fw  w3-margin-right w3-large w3-text-teal"></i>Description:{{$trip->description}}</h4>
        <br>
        <h2>Rating {{$rat}} <h2>
                               
                        <span class="fa fa-star checked" id="star1" ></span>
                        <span class="fa fa-star checked" id="star2" ></span>
                        <span class="fa fa-star checked" id="star3" ></span>
                        <span class="fa fa-star checked" id="star4" ></span>
                        <span class="fa fa-star checked" id="star5" ></span>
                        <input type="hidden" id="Rating" name="Rating" value="5" ></input>
                        
                         <script>
                             add(this,{{$rat}})
                        function add(ths,sno){
                        document.getElementById("Rating").setAttribute('value', sno);
                            


                        for (var i=1;i<=5;i++){
                        var cur=document.getElementById("star"+i)
                        cur.className="fa fa-star"
                                                            }

                        for (var i=1;i<=sno;i++){
                        var cur=document.getElementById("star"+i)
                        if(cur.className=="fa fa-star")
                        {
                        cur.className="fa fa-star checked"
                        }
                        }

                        }
                        
                        </script> 
                        
                 <form action="{{  url('User/get-checkout-id/'.$trip->priceperperson.'/'.$trip->id) }}">
                     <br>
                                 <label for="quantity">choose the number of persons:</label>
                                 <div class="form-group mb-3">
                               
                                 <input type="number" name="quantity" min="1" max="10" id="quantity" required class="form-control">
                                 <button type="submit" class="btn btn-primary">Book</button>
                                 </div>
                                 
                           
                        

                                 </form>  
                                 
                                 

         
          
          <br>
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        
        <img src="{{ asset('uploads/images/'.$trip->thumbnail) }}" alt="Image" style="width:100%; max-height: 720px;"  alt="Image" >
      </div>

      

    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>

  <h2 style="text-align: center">Gallery</h2>
  <br>
  
  


<div class="w3-content" style="max-width:1200px">
@foreach ($sample as $trips)
  
  <img class="mySlides" src="{{ asset('uploads/images/'.$trips->image) }}" style="width:100% ;display:none; max-height: 720px;">
  @endforeach

  <div class="w3-row-padding w3-section">
  <!--{{$i=0}}-->
  @foreach ($sample as $trips)
   
    <div class="w3-col s4">
      <img class="demo w3-opacity w3-hover-opacity-off" src="{{ asset('uploads/images/'.$trips->image) }} " width="280px" height="280px" style="width:100%;cursor:pointer" onclick="currentDiv({{$i=$i+1}})">
    </div>
    @endforeach 
  </div>
</div>
<div class="center">
<a href="{{url('User/album/'.$trip->id)}}" class="btn btn-primary btn-sm" style="font-size : 25px;width: 200px;height: 50px;" >View Album</a>
 </div>
<script>
function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}
</script> 
<!-- start of rev-->
<div class="main-section">

<div class="hedding-title"><h1><center>Comments</center></h1></div>

<div class="rating-part">




<div style="clear: both;"></div>
<div class="reviews"><h1>Reviews</h1></div>

<div class="comment-part">
<div class="user-img-part">
<div class="user-img">

</div>
@foreach($rev as $rev)
<div class="user-text">
<h4>{{$rev->created_at}}</h4>
<p>{{$rev->name}}</p>

</div>
<div style="clear: both;"></div>
</div>
<div class="comment">

@for ($i = 0; $i < $rev->rating; $i++)
<i aria-hidden="true" class="fa fa-star checked"></i>
@endfor
@for ($i = 5; $i > $rev->rating; $i--)
<i aria-hidden="true" class="fa fa-star"></i>
@endfor

<h4>{{$rev->title}}</h4>
<p>{{$rev->comment}}.</p>
</div>
<div style="clear: both;"></div>
</div>
@endforeach


</div>


</div>



<br>
<br><br><br>
<!-- end of rev-->
   <h1><center>Map</center></h1> 
   <br>
<div id="myMap" style="position:relative;width:max-width;height:600px;"></div>
<br>


                   


    </div>
    </body>
    @endforeach
@endsection

