<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\blog;
use App\Models\subscription;
use Mail;
use Illuminate\Support\Facades\Storage;


use \stdClass;
class blogcontroller extends Controller
{
    public function add_blog(Request $req){
        
        $new_blog = new blog();
        $new_blog->title = $req->title;
        $new_blog->description = $req->description;
        $new_blog->catagory = $req->selected_category;
        $new_blog->blogdata = $req->blogdata;
        if($req->keywords!="" && $req->keywords != null)
            $new_blog->keywords = $req->keywords;
        // if($req->products!="" && $req->products != null)
        //     $new_blog->product_names = $req->products;
        // if($req->prices!="" && $req->prices != null)
        //     $new_blog->prices	 = $req->prices;
        // if($req->colors!="" && $req->colors != null)
        //     $new_blog->colors	 = $req->colors;
        $new_blog->user_id = $req->user_id;
        $new_blog->uploaded_at = $req->uploaded_at;
        $new_blog->save();
        $id = $new_blog->blog_id;
        
        $ext = $req->file('card_img')->extension();
        $req->file('card_img')->storeAs('public/card_images','card_img_'.$id.'.'.$ext);
        $card_img_link = 'storage/card_images/card_img_'.$id.'.'.$ext;
        $new_blog->card_img_link = $card_img_link;
        $new_blog->save();
        $subscriptions  = subscription::where('category','=',$req->selected_category)->get();
        forEach($subscriptions as $subscription){
            $email = $subscription->email;
            $username = strtok($email,'@');
            $category = str_replace("_"," ",$req->selected_category);
            $data = ["username"=>$username,"category"=>$category];
            Mail::send('subscription_mail',$data,function($messages) use ($email){
                $messages->to($email);
                $messages->subject('New Blog Published...!!');
            });
        }
        return ['status'=>1,"message"=>"blog added...!!"];

    }
    public function edit_blog(Request $req){
        $blog = blog::find($req->blog_id);
        $blog->title = $req->title;
        $blog->description = $req->description;
        $blog->keywords = $req->keywords;
        $blog->blogdata = $req->blogdata;
        if($req->file('card_img')){
            $id = $blog->blog_id;
            $ext = $req->file('card_img')->extension();
            $req->file('card_img')->storeAs('public/card_images','card_img_'.$id.'.'.$ext);
            $card_img_link = 'storage/card_images/card_img_'.$id.'.'.$ext;
            $blog->card_img_link = $card_img_link;
        }
        $blog->save();
        return ['status'=>1,"message"=>"blog edited...!!"];

    }
    public function get_all_blogs(){
        $result1= DB::table('blogs')->get();
        $all_blogs = [];
        
            foreach($result1 as $result){
                $blog = new stdClass;
                $blog->title =$result->title;
                $blog->description= $result->description;
                $blog->category= $result->catagory;
                $blog->blog_id= $result->blog_id;
                $blog->card_img_link= $result->card_img_link;
                $blog->uploaded_at = $result->uploaded_at;
                $blog->keywords = $result->keywords;
                $blog->user_id = $result->user_id;
                array_push($all_blogs,$blog);
            }
        return $all_blogs;

    }
    public function get_user_blogs(Request $req){
        $blogs = blog::where('user_id','=',$req->user_id)->get();
        $user_blogs = [];
        foreach($blogs as $blog){
            $new_blog = new stdClass;
                $new_blog->title =$blog->title;
                $new_blog->description= $blog->description;
                $new_blog->category= $blog->catagory;
                $new_blog->blog_id= $blog->blog_id;
                $new_blog->card_img_link= $blog->card_img_link;
                $new_blog->uploaded_at = $blog->uploaded_at;
                $new_blog->keywords = $blog->keywords;
                $new_blog->user_id = $blog->user_id;
                array_push($user_blogs,$new_blog);
        }
        return ["my_blogs"=>$user_blogs];
    }
    public function get_blog_edit_data(Request $req){
        $blog = blog::find($req->blog_id);
        $new_blog = new stdClass;
        $new_blog->title = $blog->title;
        $new_blog->description = $blog->description;
        $new_blog->keywords = $blog->keywords;
        $new_blog->link = $blog->card_img_link;
        return $new_blog;
    }
    public function get_blog_data(Request $req){
        $result = DB::table('blogs')->where('blog_id',$req->blog_id)->first();
        $blogdata = $result->blogdata;
        return ["blogdata"=>$blogdata];
    }
    public function update_comments(Request $req){
        $blog = blog::find($req->blog_id);
        $blog->comments = $req->comments;
        $blog->save();
    }
    public function get_comments(Request $req){
        $blog = blog::find($req->blog_id);
        $comments = $blog->comments;
        return ["comments"=>$comments];
    }
    public function delete_blog(Request $req){
        $blog = blog::find($req->blog_id);
        $link = $blog->card_img_link;
        $index = strpos($link,"/");
        $second_part = substr($link,$index);
        $img_link = "public".$second_part;
        Storage::delete($img_link);
        $blog->delete();
        return ["status"=>1,"message"=>"deleted successfuly"];
    }
}
