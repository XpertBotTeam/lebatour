@extends('layouts.appguide')

@section('content')

                <div class="card-header">
                    <h4>My Trips
                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
	
                            <tr>
                                <th>user_id</th>
                                <th>thumbnail</th>
                                <th>title</th>
                                <th>description</th>
                                <th>price</th>
                                <th>Day</th>
                                <th>time</th>
                                <th>adminDistrict</th>
                                <th>city</th>
                                <th>postalcode</th>
                                <th>adressline</th>
                                <th></th>
                                <th>album</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trip as $item)
                            <tr>
                                <td>{{ $item->user_id }}</td>
                                <td>
                                    <img src="{{ asset('uploads/images/'.$item->thumbnail) }}" width="150px" height="150px" alt="Image">
                                </td>
                                
                                <td>{{ $item->title }}</td> 
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->priceperperson }}</td>
                                <td>{{ $item->Days }}</td>
                                <td>{{ $item->time }}</td>
                                <td>{{ $item->adminDistrict }}</td>
                                <td>{{ $item->city }}</td>
                                <td>{{ $item->postalcode }}</td>
                                <td>{{ $item->adressline }}</td>
                                <td>
                                
                                @if ( $item->hold == false )
                                    <form action="{{ url('Guide/hold/'.$item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm">hold</button>
                                    </form>
                                @else
                                    <form action="{{ url('Guide/hold/'.$item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary btn-sm">unhold</button>
                                    </form>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('Guide/add_picture/'.$item->id) }}" class="btn btn-primary btn-sm">add</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            

@endsection