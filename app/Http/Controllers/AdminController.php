<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\guiderequest;
use App\Models\order;
use App\Models\User;
use App\Models\guideinfo;
use App\Mail\BanMail;
use App\Mail\acceptMail;
use App\Mail\denyMail;
use App\Mail\unBanMail;
use DB;
use Illuminate\Support\Facades\Mail;



class AdminController extends Controller
{
    function index(){
        $order = order::All();
        return view('dashboards.admins.index',compact('order'));
    }
    function viewrequest(){
     $guiderequest = guiderequest::all();
      return view('dashboards.admins.request',compact('guiderequest'));
    }

    public function accept($user_id,$id)
    {
      
        $user = User::find($user_id);
        $user->role = 3;
        $user->update();
   $guiderequest=guiderequest::find($id);
  
        $guideinfo = new guideinfo ;
        
        $guideinfo->user_id = $guiderequest->user_id;
        $guideinfo->profile = $guiderequest->profile;
        $guideinfo->nameoncard = $guiderequest->nameoncard;
        $guideinfo->idcard = $guiderequest->idcard;
        $guideinfo->birthdayoncard = $guiderequest->birthdayoncard;
        $guideinfo->phonenumber = $guiderequest->phonenumber;
        $guideinfo->experties = $guiderequest->experties;
        $guideinfo->save();
        $guiderequest = guiderequest::query()
        ->where('user_id', 'like', "{$user_id}")->get();
        $guiderequest->each->delete();

        Mail::to($user->email)->send(new acceptMail());
        return redirect()->back()->with('status',' Success');
        
    }
    public function deny($user_id,$id)
    {
        $user = User::find($user_id);
        $guiderequest = guiderequest::query()
        ->where('user_id', 'like', "{$user_id}")->get();
        $guiderequest->each->delete();
        
        Mail::to($user->email)->send(new denyMail());
        return redirect()->back()->with('status',' Success');   
    }




    function ban(){
         
         $guide = DB::table('guideinfos')
            ->join('users', 'guideinfos.user_id', '=', 'users.id')   
            ->select('guideinfos.*', 'users.role')
            ->get();
        return view('dashboards.admins.ban',compact('guide'));
    }

    function ban_update($id){
       $user = user::find($id);
        if($user->role == 2){
            
            $user->role=3;
            Mail::to($user->email)->send(new unBanMail());
         
        }elseif($user->role == 3){
           
            $user->role=2;
           $affected = DB::table('trips')
            ->where('user_id',$id)
            ->update(['hold' => true]);
            Mail::to($user->email)->send(new BanMail());
          
        }
        
        $user->update();
        return redirect()->back();
    }


}
