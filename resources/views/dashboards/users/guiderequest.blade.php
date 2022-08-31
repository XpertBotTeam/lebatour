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
                    <h4>send request to become a guide
                        <a href="{{route('User.dashboard')  }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('User/add-request') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">profile</label>
                            <input type="file" name="profile" required class="form-control">
                        </div>


                        <div class="form-group mb-3">
                            <label for="">name on the card</label>
                            <input type="text" name="nameoncard" required class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">card id</label>
                            <input type="text" name="idcard" required class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">birthday on card</label>
                            <input type="date" name="birthdayoncard" required class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">phone</label>
                            <input type="text" name="phonenumber" required class="form-control">
                        </div>


                        <div class="form-group mb-3">
                            <label for="">experties</label>
                            <input type="text" name="experties" required class="form-control">
                        </div>
                        
                        

                        
                        


                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">send request</button>
                        </div>

                        

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection