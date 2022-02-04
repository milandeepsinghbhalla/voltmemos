<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\blog;
use \stdClass;
class blogcontroller extends Controller
{
    public function add_blog(Request $req){
        
        $new_blog = new blog();
        $new_blog->title = $req->title;
        $new_blog->description = $req->description;
        $new_blog->catagory = $req->selected_category;
        $new_blog->blogdata = $req->blogdata;
        if($req->companies!="" && $req->companies != null)
            $new_blog->company_names = $req->companies;
        if($req->products!="" && $req->products != null)
            $new_blog->product_names = $req->products;
        if($req->prices!="" && $req->prices != null)
            $new_blog->prices	 = $req->prices;
        if($req->colors!="" && $req->colors != null)
            $new_blog->colors	 = $req->colors;
        $new_blog->user_id = 1;
        $new_blog->uploaded_at = $req->uploaded_at;
        $new_blog->save();
        $id = $new_blog->blog_id;
        
        $ext = $req->file('card_img')->extension();
        $req->file('card_img')->storeAs('public/card_images','card_img_'.$id.'.'.$ext);
        $card_img_link = 'storage/card_images/card_img_'.$id.'.'.$ext;
        $new_blog->card_img_link = $card_img_link;
        $new_blog->save();
        return ['status'=>1,"message"=>"blog added...!!"];

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
                $blog->company_names = $result->company_names;
                $blog->product_names = $result->product_names;
                $blog->prices = $result->prices;
                $blog->colors = $result->colors;
                $blog->user_id = $result->user_id;
                array_push($all_blogs,$blog);
            }
        return $all_blogs;

    }
    public function get_blog_data(Request $req){
        $result = DB::table('blogs')->where('blog_id',$req->blog_id)->first();
        $blogdata = $result->blogdata;
        return ["blogdata"=>$blogdata];
    }
}
