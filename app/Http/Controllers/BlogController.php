<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class BlogController extends Controller
{
    public function get_all_blog_posts(){
        $posts =Post::with('user','category')->orderBy('id','desc')->get();
        return response()->json([
            'posts' =>$posts
        ],200);
    }


    public function get_posts_by_id($id){
        $post = Post::with('user','category')->where('id',$id)->first();
        return response()->json([
            'post' =>$post
        ],200);
    }

    public function all_categories(){
        $categories = Category::all();
        return response()->json([
            'categories' =>$categories
        ],200);

    }

    public function posts_by_category($id){
        $posts = Post::with('user','category')->where('cat_id',$id)->get();
        return response()->json([
            'posts' =>$posts
        ],200);
    }

    public function search_posts(){
       //$posts = Post::all();
       
        $search = \Request::get('s'); 
        if($search != null){
        $posts = Post::with('category','user')
                  ->where('title','LIKE',"%$search%")
                  ->orWhere('description','LIKE',"%$search%")
                  ->get();

        return response()->json([
            'posts' =>$posts
            ],200);

        }
        else{
           return  $this->get_all_blog_posts();
        }

    }


    public function latest_post(){
        $posts = Post::with('user','category')->latest()->get();
        return response()->json([
            'posts' =>$posts
            ],200);
    }
}
