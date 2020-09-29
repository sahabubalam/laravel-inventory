<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Supplier;

class SupplierController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('frontend.supplier.add_supplier');
    }
    //store supplier

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:suppliers|max:255',
            'phone' => 'required|unique:suppliers|max:255',
            'address' => 'required',
            'photo' => 'required',
            'city' => 'required', 
        ]);
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['shop']=$request->shop;
        $data['account_holder']=$request->account_holder;
        $data['account_number']=$request->account_number;
        $data['bank_name']=$request->bank_name;
        $data['branch_name']=$request->bank_branch;
        $data['type']=$request->type;
        $data['city']=$request->city;
        $image=$request->file('photo');
        if($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientoriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/supplier/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $data['photo']=$image_url;
                $customer=DB::table('suppliers')
                         ->insert($data);
                         if($customer) {
                             $notification=array(
                                 'message' => 'Successfully Supplier inserted',
                                 'alert-type'=>'success'
                             );
                             return Redirect()->route('home')->with($notification);

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

      //all supplier============

      public function all_supplier()
      {
          $supplier=Supplier::all();
          return view('frontend.supplier.all_supplier',compact('supplier'));
      }
      //delete supplier
      
    public function delete_supplier($id)
    {
        $delete=DB::table('suppliers')
                ->where('id',$id)
                ->first();
                $photo=$delete->photo;
                unlink($photo);
                $deletuser=DB::table('suppliers')->where('id',$id)->delete();
                if($deletuser) {
                    $notification=array(
                        'message' => 'Successfully Supplier deleted',
                        'alert-type'=>'success'
                    );
                    return Redirect()->route('all.supplier')->with($notification);

                } else{
                    $notification=array(
                        'message' => 'Error ',
                        'alert-type'=>'success'
                    );
                    return Redirect()->back()->with($notification);

                }
    }
//edit supplier

    public function edit_supplier($id)
    {
         $edit=DB::table('suppliers')
         ->where('id',$id)
         ->first();
         return view('frontend.supplier.edit_supplier',compact('edit'));
     }

     //update supplier

     public function update_supplier(Request $request,$id)
     {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required',
            'city' => 'required', 
        ]);
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['shop']=$request->shop;
        $data['account_holder']=$request->account_holder;
        $data['account_number']=$request->account_number;
        $data['bank_name']=$request->bank_name;
        $data['branch_name']=$request->bank_branch;
        $data['type']=$request->type;
        $data['city']=$request->city;
        $image=$request->file('photo');
        if($image)
        {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientoriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/supplier/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            if($success)
            {
                $data['photo']=$image_url;
                $img=DB::table('suppliers')->where('id',$id)->first();
                $img_path=$img->photo;
                $done=unlink( $img_path);
                $post=DB::table('suppliers')->where('id',$id)->update($data);
                if($post) {
                    $notification=array(
                        'message' => 'Successfully Supplier updated',
                        'alert-type'=>'success'
                    );
                    return Redirect()->route('all.supplier')->with($notification);

                } else{
                    return Redirect()->back()->with($notification);
                }
            }
        } else {
            $oldphoto=$request->old_photo;
            if($oldphoto)
            {
                $data['photo']= $oldphoto;
                $post=DB::table('suppliers')->where('id',$id)->update($data);
                if($post) {
                    $notification=array(
                        'message' => 'Successfully Supplier updated',
                        'alert-type'=>'success'
                    );
                    return Redirect()->route('all.supplier')->with($notification);

                } else{
                    return Redirect()->back()->with($notification);
                }
            }

        }
    }
}
