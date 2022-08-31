@extends('layouts.appuser')

@section('content')
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
#id{
  width: 100px;
}
</style>
    <title></title>
    <meta charset="utf-8" />
	<script type='text/javascript'>
    var map, infobox;

    function GetMap() {
        map = new Microsoft.Maps.Map('#myMap', {});

        //Create an infobox at the center of the map but don't show it.
        infobox = new Microsoft.Maps.Infobox(map.getCenter(), {
            visible: false
        });

        //Assign the infobox to a map instance.
        infobox.setMap(map);

        //Create random locations in the map bounds.
        @foreach ($trip as $trip)
       var title = '{{ $trip->title }}';
       var des = '{{ $trip->description }}';
        var loc = new Microsoft.Maps.Location({{ $trip->latitude }}, {{ $trip->longitude }});
       
            var pin = new Microsoft.Maps.Pushpin(loc);
          
            //Store some metadata with the pushpin.
            pin.metadata = {
                title: title ,
                description: des 
            };

            //Add a click event handler to the pushpin.
            Microsoft.Maps.Events.addHandler(pin, 'click', pushpinClicked);

            //Add pushpin to the map.
            map.entities.push(pin);
        @endforeach
    }

    function pushpinClicked(e) {
        //Make sure the infobox has metadata to display.
        if (e.target.metadata) {
            //Set the infobox options with the metadata of the pushpin.
            infobox.setOptions({
                location: e.target.getLocation(),
                title: e.target.metadata.title,
                description: e.target.metadata.description,
                visible: true
            });
        }
    }
    </script>
    <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AvbiIeFn6oMhDKYaXE-NExTpceGs2wqTT3oVDYeZGwRlwSwCz2U6BrviGYlvPVKk' async defer></script>
</head>
<body>
    <div id="myMap" style="position:relative;width:max-width;height:400px;"></div>

    <div id="center">
<form class="form-inline" action="{{route('User.search2')}}">
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
  <img src="{{ asset('uploads/images/'.$tripinfo->thumbnail) }}"  height="300" style="width:100%">
  <h1>{{ $tripinfo->title }}</h1>
  <p class="title" ><a href="{{url('User/specific_guide/'.$tripinfo->gid)}}">{{ $tripinfo->name }}</a></p>
  <p>{{ $tripinfo->description }}</p>
  <p>{{ $tripinfo->Days}} {{$tripinfo->time}}</p>
  <div style="margin: 24px 0;">
    <a >price:{{$tripinfo->priceperperson}} eur</a> 
    
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