@extends('layouts.appguide')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>My album
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>title</th>
                                <th>image</th>
                                
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($album as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                
                                <td>
                                    <img src="{{ asset('uploads/images/'.$item->image) }}" width="400px" height="400px" alt="Image">
                                </td>
                               
                                <td>
                                   
                                    <form action="{{ url('Guide/delete-image/'.$item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection