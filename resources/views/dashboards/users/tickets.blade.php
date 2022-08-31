@extends('layouts.appuser')

@section('content')

                <div class="card-header">
                    <h4> tickets
                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                







                                
                                <th>total_amount</th>
                                <th>number_of_person</th>
                                <th>thumbnail trip</th>
                                <th>title</th>
                                <th>bank_transaction_id</th>
                                <th>date of purchase</th>
                                <th>review</th>
                                <th>Album</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                            <tr>
                                <td>{{ $item->total_amount }} Eur</td>
                                <td>{{ $item->number_of_person }}</td>
                                 <td>
                                    <img src="{{ asset('uploads/images/'.$item->thumbnail) }}" width="150px" height="150px" alt="Image">
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->bank_transaction_id }}</td>
                                <td>{{ $item->created_at }}</td>
                                
                                <td>
                                    <a href="{{ url('User/review/'.$item->id) }}" class="btn btn-primary btn-sm">add-Review</a>
                                </td>
                                
                                <td>
                                    <a href="{{ url('User/add_picture/'.$item->trip_id) }}" class="btn btn-primary btn-sm">add picture</a>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
           
@endsection