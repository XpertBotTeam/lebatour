@extends('layouts.appuser')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>add picture
                        <a href="{{route('User.mytickets')  }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('User.storepicture',$id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">title</label>
                            <input type="text" name="title" required class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">image</label>
                            <input type="file" name="image" required class="form-control">
                        </div>


                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">upload</button>
                        </div>

                        

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection