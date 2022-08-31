
@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Guide Request
                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>user_id</th>
                                <th>profile</th>
                                <th>name on card</th>
                                <th>idcard</th>
                                <th>birthday on card</th>
                                <th>phone number</th>
                                <th>experties</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guiderequest as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user_id }}</td>
                                <td>
                                    <img src="{{ asset('uploads/images/'.$item->profile) }}" width="150px" height="150px" alt="Image">
                                </td>
                                
                                <td>{{ $item->nameoncard }}</td>
                                
                                <td>{{ $item->idcard }}</td>
                                <td>{{ $item->birthdayoncard }}</td>
                                <td>{{ $item->phonenumber }}</td>
                                <td>{{ $item->experties }}</td>
                                <td>
                                
                                {{-- <a href="{{ url('admin/accept-guide/'.$item->user_id.'/'.$item->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                                    <form action="{{ url('admin/accept-guide/'.$item->user_id.'/'.$item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary btn-sm">accept</button>
                                    </form>
                                </td>
                                <td>
                                
                                
                                    <form action="{{ url('admin/deny-guide/'.$item->user_id.'/'.$item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">deny</button>
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