@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Guide Ban
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guide as $item)
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
                                
                                @if ( $item->role == 3 )
                                    <form action="{{ url('admin/ban-guide/'.$item->user_id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm">Ban</button>
                                    </form>
                                    @else
                                    <form action="{{ url('admin/ban-guide/'.$item->user_id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary btn-sm">unBan</button>
                                    </form>
                                    @endif
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