<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Product;

use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
 


class ProductController extends Controller
{
   public function index()
   {
       return view('frontend.product.add_product');
   }
   //store product

   public function store(Request $request)
   {
        $validatedData = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'cat_id' => 'required',
            'sup_id' => 'required',
            'product_garage' => 'required',
            'product_route' => 'required', 
            'buy_date' => 'required',
           
            'buying_price' => 'required',
            'product_image' => 'required',
        ]);
        $data=array();
        $data['product_name']=$request->product_name;
        $data['cat_id']=$request->cat_id;
        $data['sup_id']=$request->sup_id;
        $data['product_code']=$request->product_code;
        $data['product_garage']=$request->product_garage;
        $data['product_route']=$request->product_route;
        $data['buy_date']=$request->buy_date;
        $data['expire_date']=$request->expire_date;
        $data['buying_price']=$request->buying_price;
        $data['selling_price']=$request->selling_price;
        $image=$request->file('product_image');
        if($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientoriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/product/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $data['product_image']=$image_url;
                $customer=DB::table('products')
                         ->insert($data);
                         if($customer) {
                             $notification=array(
                                 'message' => 'Successfully Product inserted',
                                 'alert-type'=>'success'
                             );
                             return Redirect()->route('all.product')->with($notification);

                         } else{
                             $notification=array(
                                 'message' => 'Error ',
                                 'alert-type'=>'success'
                             );
                             return Redirect()->back()->with($notification);

                         }
            }
            else {
                return Redirect()->back();
            }
        } else {
            return Redirect()->back();
        }

   }

   //all productc

   public function all_product()
   {
       $product=Product::all();
       return view('frontend.product.all_product',compact('product'));
   }
   //delete product

   public function delete_product($id)
   {
        $delete=DB::table('products')
        ->where('id',$id)
        ->first();
        $photo=$delete->product_image;
        unlink($photo);
        $deletproduct=DB::table('products')->where('id',$id)->delete();
        if($deletproduct) {
            $notification=array(
                'message' => 'Successfully Product deleted',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);

        } else{
            $notification=array(
                'message' => 'Error ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        }
   }
   //edit product

   public function edit_product($id)
   {
       $product=DB::table('products')->where('id',$id)->first();
       return view('frontend.product.edit_product',compact('product'));
   }
   //update product

   public function update_product(Request $request,$id)
   {
    $validatedData = $request->validate([
        'product_name' => 'required|max:255',
        'product_code' => 'required|max:255',
        'cat_id' => 'required',
        'sup_id' => 'required',
        'product_garage' => 'required',
        'product_route' => 'required', 
        'buy_date' => 'required',
       
        'buying_price' => 'required',
       
    ]);
    $data=array();
    $data['product_name']=$request->product_name;
    $data['cat_id']=$request->cat_id;
    $data['sup_id']=$request->sup_id;
    $data['product_code']=$request->product_code;
    $data['product_garage']=$request->product_garage;
    $data['product_route']=$request->product_route;
    $data['buy_date']=$request->buy_date;
    $data['expire_date']=$request->expire_date;
    $data['buying_price']=$request->buying_price;
    $data['selling_price']=$request->selling_price;
    $image=$request->file('product_image');
    if($image)
    {
        $image_name=hexdec(uniqid());
        $ext=strtolower($image->getClientoriginalExtension());
        $image_full_name=$image_name.'.'.$ext;
        $upload_path='public/product/';
        $image_url=$upload_path.$image_full_name;
        $success=$image->move($upload_path,$image_full_name);

        if($success)
        {
            $data['product_image']=$image_url;
            $img=DB::table('products')->where('id',$id)->first();
            $img_path=$img->product_image;
            $done=unlink( $img_path);
            $post=DB::table('products')->where('id',$id)->update($data);
            if($post) {
                $notification=array(
                    'message' => 'Successfully Product updated',
                    'alert-type'=>'success'
                );
                return Redirect()->route('all.product')->with($notification);

            } else{
                return Redirect()->back()->with($notification);
            }
        }
    } else {
        $oldphoto=$request->old_photo;
        if($oldphoto)
        {
            $data['product_image']= $oldphoto;
            $post=DB::table('products')->where('id',$id)->update($data);
            if($post) {
                $notification=array(
                    'message' => 'Successfully Product updated',
                    'alert-type'=>'success'
                );
                return Redirect()->route('all.product')->with($notification);

            } else{
                return Redirect()->back()->with($notification);
            }
        }

    }
   }

   //import product

   public function import_product()
   {
       return view('frontend.product.import_product');
   }
    public function export() 
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function import(Request $request)
    {
        $import=Excel::import(new ProductsImport, $request->file('import_file'));
        if($import) {
            $notification=array(
                'message' => 'Successfully Product Imported',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);

        } else{
            return Redirect()->back()->with($notification);
        }
    }
}
