@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                   <h4> hi admin :{{Auth::user()->name}}</h4>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                
                                <th>total_amount</th>
                                <th>number_of_person</th>
                                
                                <th>date of purchase</th>
                                <th>profit</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                       <!--- {{$total_profit=0}}--->
                            @foreach ($order as $item)
                            <tr>
                                
                                <td>{{ $item->total_amount }} Eur</td>
                                <td>{{ $item->number_of_person }}</td>
                                
                                
                                <td>{{ $item->created_at }}</td>
                                
                                <td>
                                {{$item->total_amount - $item->total_amount*0.9 }} eur
                              
                                </td>
                               <!---  {{ $total_profit = $item->total_amount - $item->total_amount*0.9 + $total_profit}}--->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-light">profit: {{$total_profit}} eur</button>
                </div>


@endsection