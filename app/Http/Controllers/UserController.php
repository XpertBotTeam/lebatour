<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\guiderequest;
use App\Models\guideinfo;
use App\Models\trip;
use App\Models\order;
use App\Models\Review;
use App\Models\album;
use DB;
use File;

class UserController extends Controller
{
    function index(){
        $trips = DB::table('trips')
                 ->where('trips.hold',false)
                 ->limit(3)
                 ->get();
                 

        $top_rated = DB::table('trips')
                 
                 ->join('orders','trips.id' , '=','orders.trip_id' )
                 ->join('reviews','orders.id' , '=','reviews.order_trip_id' )
                 ->where('trips.hold',false)
                 ->groupBy('trips.id','trips.title','trips.thumbnail')
                 ->select('trips.id','trips.thumbnail','trips.title',DB::raw('AVG(reviews.rating) as avgrating'))  
                 ->orderBy('avgrating', 'desc')
                 ->limit(4)
                 ->get();
        $most_recent = DB::table('trips')
                 ->where('trips.hold',false)
                 ->orderBy('created_at', 'desc')
                 ->limit(4)
                 ->get();
       return view('dashboards.users.index',compact('top_rated','trips','most_recent'));
    }
    function request(){
       
        return view('dashboards.users.guiderequest');
    }
    function store(Request $request){
        $guideinfo = DB::table('guideinfos')
                ->where('user_id', '=', auth()->user()->id)
                ->get();
                if ($guideinfo->isEmpty()){
        $guiderequest = new guiderequest;
        $guiderequest->birthdayoncard = $request->input('birthdayoncard');
        $guiderequest->nameoncard = $request->input('nameoncard');
        $guiderequest->idcard = $request->input('idcard');
        $guiderequest->phonenumber = $request->input('phonenumber');
        $guiderequest->experties = $request->input('experties');
        $guiderequest->user_id = auth()->user()->id;

        if($request->hasfile('profile'))
        {
            $file = $request->file('profile');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/images/', $filename);
            $guiderequest->profile = $filename;
        }
        try {
            $guiderequest->save();
            return redirect()->back()->with('status','request sent');
        }
        catch (\Exception $exception) {
            return redirect()->back()->with('status','you already sent a request wait for an email');
        }}else{
            return redirect()->back()->with('status','this account is banned');
        }
        
        
    }
    function trip(){
       $tripinfo = DB::table('trips')
            ->join('users', 'trips.user_id', '=', 'users.id')
            ->where('hold',false)
            ->select('trips.*', 'users.name','users.id AS gid' )
            ->get();
       
        return view('dashboards.users.trip',compact('tripinfo'));
    }

    function searchindex(Request $request){
      $search = $request->input('search');
        $tripinfo = DB::table('trips')
        ->join('users', 'trips.user_id', '=', 'users.id')
        ->where('hold',false)
        ->where(function($query) use ($search) {
		$query ->where('trips.title', 'like', "%{$search}%")
        ->orWhere('trips.description', 'like', "%{$search}%")
        ->orWhere('trips.priceperperson', 'like', "%{$search}%")
        ->orWhere('trips.Days', 'like', "%{$search}%")
        ->orWhere('trips.time', 'like', "%{$search}%")
        ->orWhere('trips.adminDistrict', 'like', "%{$search}%")
        ->orWhere('trips.city', 'like', "%{$search}%")
        ->orWhere('trips.postalcode', 'like', "%{$search}%")
        ->orWhere('trips.adressline', 'like', "%{$search}%")
        ->orWhere('trips.longitude', 'like', "%{$search}%")
        ->orWhere('trips.latitude', 'like', "%{$search}%")
        ->orWhere('users.name', 'like', "%{$search}%");
        })->select('trips.*', 'users.name','users.id AS gid' )->get();
        
        return view('dashboards.users.trip',compact('tripinfo'));
        
     }


    function selecttrip($id){
       
        $trip = DB::table('trips')
        ->join('users', 'trips.user_id', '=', 'users.id')
        ->select('trips.*', 'users.name')
        ->where('trips.id','=',$id)
        ->get();
       $rev = DB::table('reviews')
        ->join('orders', 'reviews.order_trip_id', '=', 'orders.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
         ->select('reviews.*', 'users.name')
         ->where('orders.trip_id','=',$id)
         ->get();
        $rat = DB::table('reviews')
        ->join('orders', 'reviews.order_trip_id', '=', 'orders.id')
        ->where('orders.trip_id','=',$id)->avg('rating');
        
        $sample = DB::table('albums')
        ->where('albums.trip_id','=',$id)
        ->limit(3)
        ->get();

         return view('dashboards.users.specific-trip',compact('trip','rev','rat','sample'));
     }

     function map(){
        $trip = DB::table('trips')
        ->where('hold',false)
        ->get();
        $tripinfo = DB::table('trips')
            ->join('users', 'trips.user_id', '=', 'users.id')
            ->where('hold',false)
            ->select('trips.*', 'users.name','users.id AS gid' )
            ->get();
      return  view('dashboards.users.map',compact('trip','tripinfo'));
        
    }
    function searchindex2(Request $request){
        $search = $request->input('search');
          $tripinfo = DB::table('trips')
          ->join('users', 'trips.user_id', '=', 'users.id')
          ->where('hold',false)
          ->where(function($query) use ($search) {
          $query ->where('trips.title', 'like', "%{$search}%")
          ->orWhere('trips.description', 'like', "%{$search}%")
          ->orWhere('trips.priceperperson', 'like', "%{$search}%")
          ->orWhere('trips.Days', 'like', "%{$search}%")
          ->orWhere('trips.time', 'like', "%{$search}%")
          ->orWhere('trips.adminDistrict', 'like', "%{$search}%")
          ->orWhere('trips.city', 'like', "%{$search}%")
          ->orWhere('trips.postalcode', 'like', "%{$search}%")
          ->orWhere('trips.adressline', 'like', "%{$search}%")
          ->orWhere('trips.longitude', 'like', "%{$search}%")
          ->orWhere('trips.latitude', 'like', "%{$search}%")
          ->orWhere('users.name', 'like', "%{$search}%");
          })->select('trips.*', 'users.name','users.id AS gid' )->get();

          $trip = DB::table('trips')
        ->join('users', 'trips.user_id', '=', 'users.id')
        ->where('hold',false)
        ->where(function($query) use ($search) {
            $query ->where('trips.title', 'like', "%{$search}%")
            ->orWhere('trips.description', 'like', "%{$search}%")
            ->orWhere('trips.priceperperson', 'like', "%{$search}%")
            ->orWhere('trips.Days', 'like', "%{$search}%")
            ->orWhere('trips.time', 'like', "%{$search}%")
            ->orWhere('trips.adminDistrict', 'like', "%{$search}%")
            ->orWhere('trips.city', 'like', "%{$search}%")
            ->orWhere('trips.postalcode', 'like', "%{$search}%")
            ->orWhere('trips.adressline', 'like', "%{$search}%")
            ->orWhere('trips.longitude', 'like', "%{$search}%")
            ->orWhere('trips.latitude', 'like', "%{$search}%")
            ->orWhere('users.name', 'like', "%{$search}%");
            })->select('trips.*', 'users.name','users.id AS gid' )->get();
          
          return  view('dashboards.users.map',compact('trip','tripinfo'));
          
       }
    function orders(){
        $userid = auth()->user()->id ;
     
        $order = DB::table('orders')
        ->join('trips', 'orders.trip_id', '=', 'trips.id')
        ->select('orders.*', 'trips.thumbnail','trips.title')
        ->where('orders.user_id','=',$userid)
        ->get();
        
      return  view('dashboards.users.tickets',compact('order'));
        
    }
    function review( $order_id){
        
        $reviews = DB::table('reviews')
        ->where('order_trip_id','=',$order_id)
        ->limit(1)
        ->get();
        foreach($reviews as $rev){
          $review=$rev;
        }
       $review;
        
        if (isset($review)) {
            return view('dashboards.users.editReview',compact('review'))->with(['id' => $order_id]);
           
    
        } else {
            return view('dashboards.users.Reviewtemplate')->with(['id' => $order_id]);
        }    
    }

    function review_store(Request $request,$order_id){
        $review = new Review;
        $review->title = $request->input('title');
        $review->rating = $request->input('Rating');
        $review->comment = $request->input('comment');
     $review->order_trip_id = $order_id;
        
        $review->save();
        return redirect()->route('User.review',[$order_id])->with('status','review was added');
        

        }

        function review_edit(Request $request,$order_id){
            $review = Review::find($order_id);
            $review->title = $request->input('title');
            $review->rating = $request->input('Rating');
            $review->comment = $request->input('comment');
            $review->order_trip_id = $order_id;
            
            $review->update();
            return redirect()->back()->with('status','review was updated');
    
            }
        
            function selectguide($id){
              $guide =DB::table('users')
                ->join('guideinfos', 'users.id', '=', 'guideinfos.user_id')
                ->select('guideinfos.*', 'users.email')
                ->where('users.id','=',$id)
                ->get();
               $trip = DB::table('trips')
                ->where('user_id',$id)
                ->where('hold',false)
                ->get();

                $c = collect();
               foreach($trip as $Trip){
              $c->add($Trip->id);
            }
           
           
                
            $album =DB::table('albums')
                   ->whereIn('albums.trip_id',$c)
                   ->get();
              return  view('dashboards.users.guideview',compact('guide','trip','album'));
                
            }

            function addform($id){
                
                return view('dashboards.users.add_picture',compact('id'));
                  
              }

              function storepicture(Request $request,$id){
                 $album = new album;
                 $album->title = $request->input('title');
                 $album->user_id=auth()->user()->id ;
                 $album->trip_id=$id ;

                if($request->hasfile('image'))
                {
                    $file = $request->file('image');
                    $extention = $file->getClientOriginalExtension();
                    $filename = time().'.'.$extention;
                    $file->move('uploads/images/', $filename);
                    $album->image = $filename;
                }
                $album->save();
                return redirect()->back()->with('status','uploaded');
                  
              }

              function album($id){
              
            $album =DB::table('albums')
                ->where('albums.trip_id','=',$id)
                ->get();
                return view('dashboards.users.album',compact('album'));
                  
              }

              function guides(){

              $guides =DB::table('users')
                ->join('guideinfos', 'users.id', '=', 'guideinfos.user_id')
                ->where('users.role','=',3)
                ->select('guideinfos.*')
                ->get();
                return view('dashboards.users.ourguides',compact('guides'));
             
                    
                    
                      
                  }

                  function view(){

                $album =DB::table('albums')
                ->where('albums.user_id','=',auth()->user()->id)
                ->get();
                return view('dashboards.users.editalbum',compact('album'));
    
                        }

                        public function destroy($id)
                        {
                            $album = album::find($id);
                            $destination = 'uploads/images/'.$album->image;
                            if(File::exists($destination))
                            {
                                File::delete($destination);
                            }
                            $album->delete();
                            return redirect()->back()->with('status','Image Deleted Successfully');
                        }       
     
       
    

        }