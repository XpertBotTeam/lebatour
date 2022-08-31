<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\guiderequest;
use App\Models\User;
use App\Models\guideinfo;
use App\Models\trip;
use App\Models\album;
use DB;
use File;

class GuideController extends Controller
{
    function index(){
        $trips = DB::table('trips')
                 ->where('trips.hold',false)
                 ->limit(3)
                 ->get();
        return view('dashboards.Guides.index',compact('trips'));
    }
    function addtrip(){
       
        return view('dashboards.Guides.addtrip');
    }

    function storetrip(Request $request){

        

        // URL of Bing Maps REST Services Locations API   
$baseURL = "http://dev.virtualearth.net/REST/v1/Locations";  
  
// Create variables for search parameters (encode all spaces by specifying '%20' in the URI)  
$key = 'AkBEHz_LVCd7wNJvmpZRe_5DW8E0CDc2UnGMGx87bzkYPeS8pN1zRqAV7kWqfZ8U';  
$country = "LB";   
$addressLine = str_ireplace(" ","%20",$request->input('addressLine'));  
$adminDistrict = str_ireplace(" ","%20",$request->input('adminDistrict'));  
$locality = str_ireplace(" ","%20",$request->input('locality'));  
$postalCode = str_ireplace(" ","%20",$request->input('postalCode'));  
  
// Compose URI for Locations API request  
$findURL = $baseURL."/".$country."/".$adminDistrict."/".$postalCode."/".$locality."/"  
 .$addressLine."?output=xml&maxResults=1&key=".$key; 
        $output = file_get_contents($findURL);
        $response = new \SimpleXMLElement($output);
        $latitude =  
        $response->ResourceSets->ResourceSet->Resources->Location->Point->Latitude;  
        $longitude =  
        $response->ResourceSets->ResourceSet->Resources->Location->Point->Longitude;
//inset in trip the value
        $trip = new trip;
        $trip->adressline =$request->input('addressLine');
        $trip->adminDistrict = $request->input('adminDistrict');
        $trip->city = $request->input('locality');
        $trip->postalcode = $request->input('postalCode');
        $trip->longitude = $longitude;
        $trip->latitude = $latitude;
        
        $trip->user_id =auth()->user()->id; 
        $trip->title = $request->input('title');
        $trip->description = $request->input('description');
        $trip->priceperperson = $request->input('price');
        $trip->Days = $request->input('day');
        $trip->time = $request->input('time');
        if($request->hasfile('thumb'))
        {
        $file = $request->file('thumb');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('uploads/images/', $filename);
        $trip->thumbnail = $filename;
        }
        $trip->save();
        return redirect()->back()->with('status','trip Added Successfully');
        
    }

    function viewmytrip(){
       
        $trip = trip::query()
         ->where('user_id', 'like', auth()->user()->id)
         ->get();
         return view('dashboards.guides.mytrip',compact('trip'));
    }
    function hold($id){
        $trip = trip::find($id);
        if($trip->hold == false){
            $trip->hold=true;
        }else{
            $trip->hold=false;
        }
        $trip->update();
        return redirect()->back();
        
         return view('dashboards.guides.mytrip');
    }
    function profit(){

        $order = DB::table('orders')
        ->join('trips', 'orders.trip_id', '=', 'trips.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.*', 'trips.thumbnail','trips.title','users.name')
        ->where('trips.user_id','=',auth()->user()->id)
        ->get();

        return view('dashboards.guides.profit',compact('order'));
    }

    function addimage($id){
        
              
        return view('dashboards.guides.add_image',compact('id'));
          
      }

      function storeimage(Request $request,$id){
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

     function view(){

        $album =DB::table('albums')
                ->where('albums.user_id','=',auth()->user()->id)
                ->get();
                return view('dashboards.guides.editalbum',compact('album'));

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
