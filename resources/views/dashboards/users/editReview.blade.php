@extends('layouts.appuser')

@section('content')
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.checked {
    color: orange;
}
</style>
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Review
                        <a href="{{route('User.mytickets')  }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{url('User/review_edit/'.$id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')


                        <div class="form-group mb-3">
                            <label for="">title</label>
                            <input type="text" name="title"  value="{{$review->title}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                        <label for="">Rating</label>
                        <br>
                        
                        <span class="fa fa-star checked" id="star1" onclick="add(this,1)"></span>
                        <span class="fa fa-star checked" id="star2" onclick="add(this,2)"></span>
                        <span class="fa fa-star checked" id="star3" onclick="add(this,3)"></span>
                        <span class="fa fa-star checked" id="star4" onclick="add(this,4)"></span>
                        <span class="fa fa-star checked" id="star5" onclick="add(this,5)"></span>
                        <input type="number" id="Rating" name="Rating" value="5"></input>
                       
                        </div>
                         <script>
                             add(this, {{$review->rating}});
                        function add(ths,sno){
                        document.getElementById("Rating").setAttribute('value', sno);
                            


                        for (var i=1;i<=5;i++){
                        var cur=document.getElementById("star"+i)
                        cur.className="fa fa-star"
                                                            }

                        for (var i=1;i<=sno;i++){
                        var cur=document.getElementById("star"+i)
                        if(cur.className=="fa fa-star")
                        {
                        cur.className="fa fa-star checked"
                        }
                        }

                        }
                        
                        </script>
                       
                        <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" rows="5" id="comment"  name="comment">{{$review->comment}}</textarea>
                        </div>


                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">submit</button>
                        </div>

                        

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection