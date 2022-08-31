@extends('layouts.appuser')

@section('content')
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 400px;
  margin: auto;
  text-align: center;
  font-family: arial;
  
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}
#id{
  width: 100px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
#center{
  padding: 10px;
  margin: auto;

}


</style>


</head>
<body>
  <div id="center">
<form class="form-inline" action="{{route('User.search')}}">
    @csrf
    <input class="form-control mr-sm-2" type="text" name="search"/> 
    <button id="id" class="btn btn-primary" type="submit">Search</button>
</form>
</div>

<h2 style="text-align:center">trips</h2>
<div class="w3-row">
@foreach ($tripinfo as $tripinfo)
<div class="w3-third w3-container">

<div class="card">

  <img src="{{ asset('uploads/images/'.$tripinfo->thumbnail) }}" alt="John" height="300" style="width:100%">
  <h1>{{ $tripinfo->title }}</h1>
  <p class="title" ><a href="{{url('User/specific_guide/'.$tripinfo->gid)}}">{{ $tripinfo->name }}</a></p>
  <p>{{ $tripinfo->description }}</p>
  <p>{{ $tripinfo->Days}} {{$tripinfo->time}}</p>
  <div style="margin: 24px 0;">
    <a >price:{{$tripinfo->priceperperson}} eur</i></a> 
    
  </div>
  <form action="{{url('User/specific_trip/'.$tripinfo->id)}}">
  <p><button  >Details</button></p>
  </form>
 
  </div>

</div>

@endforeach
</div>


</body>
</html>
@endsection