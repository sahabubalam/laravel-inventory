<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Category;

class CategoryController extends Controller
{
   public function index()
   {
       return view('frontend.category.add_category');
   }
   //store category

   public function store(Request $request)
   {
    $validatedData = $request->validate([
        'category_name' => 'required|max:255',
       
    ]);
       $data=array();
       $data['category_name']=$request->category_name;
       $cat=DB::table('categories')->insert($data);
       if($cat) {
        $notification=array(
            'message' => 'Successfully Category inserted',
            'alert-type'=>'success'
        );
        return Redirect()->route('all.category')->with($notification);

    } else{
        $notification=array(
            'message' => 'Error ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }
   }
   //all category

   public function all_category()
   {
       $category=DB::table('categories')->get();
       return view('frontend.category.all_category',compact('category'));
   }
   //delete category

   public function delete_category($id)
   {
       $category=DB::table('categories')->where('id',$id)->delete();
       if($category) {
        $notification=array(
            'message' => 'Successfully category deleted',
            'alert-type'=>'success'
        );
        return Redirect()->route('all.category')->with($notification);

    } else{
        $notification=array(
            'message' => 'Error ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }
   }
   //edit category

   public function edit_category($id)
   {
       $category=DB::table('categories')->where('id',$id)->first();
       return view('frontend.category.edit_category',compact('category'));
   }
   //update category

   public function update_category(Request $request,$id)
   {
        $validatedData = $request->validate([
            'category_name' => 'required|max:255',
        
        ]);
        $data=array();
        $data['category_name']=$request->category_name;
        $cat=DB::table('categories')->where('id',$id)->update($data);
        if($cat) {
            $notification=array(
                'message' => 'Successfully category updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.category')->with($notification);
    
        } else{
            $notification=array(
                'message' => 'Error ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
    
        }

   }
}
