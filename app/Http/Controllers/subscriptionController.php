<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subscription;


class subscriptionController extends Controller
{
    //
    public function add_subscription(Request $req){
        $subscription = subscription::where("category","=",$req->category)->where("email","=",$req->email)->get();
        if(count($subscription)==0){
            $new_subscription = new subscription;
            $new_subscription->category = $req->category;
            $new_subscription->email = $req->email;
            $new_subscription->save();
            return ["status"=>1,"message"=>"subscribed successfully...!!!"];
        }
        else{
            return ["status"=>0,"message"=>"That email is already in subscription list..!!"];
        }
    }
}
