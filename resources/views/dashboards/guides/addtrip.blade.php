@extends('layouts.appguide')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>add trip
                        <a href="{{route('Guide.dashboard')  }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('Guide.storetrip') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">thumbnail</label>
                            <input type="file" name="thumb" required class="form-control">
                        </div>


                        <div class="form-group mb-3">
                            <label for="">title</label>
                            <input type="text" name="title" required class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">description</label>
                            <input type="text" name="description" required class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">price per person in eur</label>
                            <input type="number" name="price" class="form-control" required min="0"  >
                        </div>

                        <div class="form-group mb-3">
                        <label for="day">Day:</label>
                        <select id="day" name="day">
                        <option value="monday">monday</option>
                        <option value="tuesday">tuesday</option>
                        <option value="wednesday">wednesday</option>
                        <option value="thursday">thursday</option>
                        <option value="friday">friday</option>
                        <option value="saturday">saturday</option>
                        <option value="Sunday">Sunday</option>
                        </select>
                        </div>

                        <div class="form-group mb-3">
                        <label for="time">Select a time:</label>
                        <input type="time" id="time" required name="time">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">admin District</label>
                            <input type="text" name="adminDistrict" required class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">city</label>
                            <input type="text" name="locality" required class="form-control">
                        </div>


                        <div class="form-group mb-3">
                            <label for="">postalCode</label>
                            <input type="text" name="postalCode" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">adress line</label>
                            <input type="text" name="addressLine" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">add trip</button>
                        </div>

                        

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

