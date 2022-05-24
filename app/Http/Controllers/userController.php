<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\blog;
use App\Models\user;
use \stdClass;

class userController extends Controller
{
    //
    public function add_user(Request $req){
        $user = user::where("email","=",strtolower($req->email))->get();
        if(count($user)==0){
            $new_user = new user;
            $new_user->name = $req->name;
            $new_user->email = strtolower($req->email);
            $new_user->password = Hash::make($req->password);
            $new_user->save();
            return ["status"=>1,"message"=>"user signed up successfully..!!"];
        }
        else{
            return ["status"=>0,"message"=>"user with that email already exist..!!"];
        }
        
    }
    public function login_user(Request $req){
        $user = user::where("email","=",strtolower($req->email))->first();
        if($user){
            if(Hash::check($req->password,$user->password)){
                $current_user = new stdClass();
                $current_user->name = $user->name;
                $current_user->user_id = $user->user_id;
                $current_user->email = $user->email;
                return ["status"=>1,"current_user"=>$current_user,"message"=>"user logged in successfully"];
            }
            else{
                return ["status"=>0,"message"=>"wrong password entered...!!"];
            }
        }
        else{
            return ["status"=>0,"message"=>"No user present with that email..!!"];
        }

    }
}
