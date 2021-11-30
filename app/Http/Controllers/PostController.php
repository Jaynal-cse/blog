<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

//use Image;


class PostController extends Controller
{
    public function all_post(){
        $posts =Post::with('user','category')->orderBy('id','desc')->get();
        return response()->json([
            'posts' =>$posts
        ],200);
    }

    public function add_post(Request $request){
           $this->validate($request , [
            'title' => 'required | min:3 | max:100',
            'description'=>'required | min:3 | max:1000'
             ]); 
           $strpos = strpos($request->photo,';');
           $sub = substr($request->photo,0,$strpos);
           $extension=explode('/',$sub)[1];
           $name = time().'.'.$extension;
           $img = Image::make($request->photo)->resize(800,400);
           $upload_path = public_path().'/uploadimage/';
           $img->save($upload_path.$name);

           $post = new Post();
           $post->title = $request->title;
           $post->description = $request->description;
           $post->user_id = Auth::user()->id;
           $post->cat_id = $request->cat_id;
           $post->photo =$name;
           
           $post->save();
    }

    public function delete_post($id){
        $post = Post::find($id);
        $image_path = public_path().'/uploadimage/';
        $image = $image_path.$post->photo;
        if(file_exists($image)){
            @unlink($image);
        }
        $post->delete();
    }

    public function edit_post($id){
        $post = Post::find($id);
        return response()->json([
           'post' =>$post
        ],200);
     }

     public function update_post(Request $request,$id){
           $post = Post::find($id);
           $this->validate($request , [
            'title' => 'required | min:3 | max:100',
            'description'=>'required | min:3 | max:1000'
             ]); 
             if($request->photo != $post->photo){
                $strpos = strpos($request->photo,';');
                $sub = substr($request->photo,0,$strpos);
                $extension=explode('/',$sub)[1];
                $name = time().'.'.$extension;
                $img = Image::make($request->photo)->resize(200,200);
                $upload_path = public_path().'/uploadimage/';
                $image = $upload_path.$post->photo;
                if(file_exists($image)){
                    @unlink($image);
                    }
                   $img->save($upload_path.$name);
                }
             else{
                 $name = $post->name;
                }
                $post->title = $request->title;
                $post->description = $request->description;
                $post->user_id = Auth::user()->id;
                $post->cat_id = $request->cat_id;
                $post->photo =$name;
                $post->save();


     }
}
