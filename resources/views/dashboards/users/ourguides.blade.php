@extends('layouts.appuser')

@section('content')
<!DOCTYPE html>
<html>
<head>

<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
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

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>
</head>
<body>

<h2 style="text-align:center">Guides</h2>
    <div class="w3-row">
    @foreach($guides as $guides)
<div class="w3-third w3-container">
<div class="card">
  <img src="{{ asset('uploads/images/'.$guides->profile) }}"  height="300" style="width:100%">
  <h1>{{$guides->nameoncard}}</h1>
  
  
  
  
  <form action="{{url('User/specific_guide/'.$guides->user_id)}}">
  <p><button  >Details</button></p>
  </form>
</div>
</div>
@endforeach  
  </div>

</body>
</html>
@endsection