@extends('layouts.appguide')

@section('content')
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>total_amount</th>
                                <th>number_of_person</th>
                                <th>image</th>
                                <th>title</th>
                                <th>date of purchase</th>
                                <th>profit</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                       <!--- {{$total_profit=0}}--->
                            @foreach ($order as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->total_amount }} Eur</td>
                                <td>{{ $item->number_of_person }}</td>
                                 <td>
                                    <img src="{{ asset('uploads/images/'.$item->thumbnail) }}" width="70px" height="70px" alt="Image">
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->created_at }}</td>
                                
                                <td>
                                {{$item->total_amount - $item->total_amount/10 }} eur
                              
                                </td>
                               <!---  {{ $total_profit = $item->total_amount - $item->total_amount/10 + $total_profit}}--->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-light">profit: {{$total_profit}} eur</button>
                </div>
@endsection