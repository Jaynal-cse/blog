<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
   


   public function add_category(Request $request){
      $this->validate($request , [
         'cat_name' => 'required | min:3 | max:12'
      ]); 

      $category = New Category();
      $category->cat_name = $request->cat_name;
      $category->save();
      return ['message' => 'OK'];
    }

    public function all_category(){
       $categories = Category::orderBy('id','desc')->get();
       return response()->json([
          'categories' =>$categories
       ],200);
    }

    public function delete_category($id){
       $category = Category::find($id);
       $category->delete();
    }

    public function edit_category($id){
       $category = Category::find($id);
       return response()->json([
          'category' =>$category
       ],200);
    }

    public function update_category(Request $request,$id){
     
       $category = Category::find($id);
       $category->cat_name = $request->cat_name;
       $category->save();

    }

    public function selected_category_deletion($ids){
       $all_id = explode(',',$ids);
       foreach($all_id as $id){
          $category = Category::find($id);
          $category->delete();
       }
    }
}
