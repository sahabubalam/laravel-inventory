<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Customer;

class CustomerController extends Controller
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
        return view('frontend.customer.add_customer');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:customers|max:255',
            'phone' => 'required|unique:customers|max:13',
            'address' => 'required',
            'account_number' => 'required',
            'account_holder' => 'required',
            'photo' => 'required',
            'city' => 'required', 
        ]);
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['shop_name']=$request->shop_name;
        $data['account_holder']=$request->account_holder;
        $data['account_number']=$request->account_number;
        $data['bank_name']=$request->bank_name;
        $data['bank_branch']=$request->bank_branch;
        $data['city']=$request->city;
        $image=$request->file('photo');
        if($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientoriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/customer/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $data['photo']=$image_url;
                $customer=DB::table('customers')
                         ->insert($data);
                         if($customer) {
                             $notification=array(
                                 'message' => 'Successfully Customer inserted',
                                 'alert-type'=>'success'
                             );
                             return Redirect()->route('all.customer')->with($notification);

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
    //all customer============

    public function all_customer()
    {
        $customer=Customer::all();
        return view('frontend.customer.all_customer',compact('customer'));
    }
    //delete customer

    public function delete_customer($id)
    {
        $delete=DB::table('customers')
                ->where('id',$id)
                ->first();
                $photo=$delete->photo;
                unlink($photo);
                $deletuser=DB::table('customers')->where('id',$id)->delete();
                if($deletuser) {
                    $notification=array(
                        'message' => 'Successfully Customer deleted',
                        'alert-type'=>'success'
                    );
                    return Redirect()->route('all.customer')->with($notification);

                } else{
                    $notification=array(
                        'message' => 'Error ',
                        'alert-type'=>'success'
                    );
                    return Redirect()->back()->with($notification);

                }
    }
    //edit customer

    public function edit_customer($id)
    {
        $edit=DB::table('customers')
        ->where('id',$id)
        ->first();
        return view('frontend.customer.edit_customer',compact('edit'));
    }
    //update customer

    public function update_customer(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:13',
            'address' => 'required',
            'photo' => 'required',
            'city' => 'required', 
        ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['shop_name']=$request->shop_name;
        $data['account_holder']=$request->account_holder;
        $data['account_number']=$request->account_number;
        $data['bank_name']=$request->bank_name;
        $data['bank_branch']=$request->bank_branch;
        $data['city']=$request->city;
        $image=$request->photo;
        if($image)
        {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientoriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/customer/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            if($success)
            {
                $data['photo']=$image_url;
                $img=DB::table('customers')->where('id',$id)->first();
                $img_path=$img->photo;
                $done=unlink( $img_path);
                $post=DB::table('customers')->where('id',$id)->update($data);
                if($post) {
                    $notification=array(
                        'message' => 'Successfully Customer updated',
                        'alert-type'=>'success'
                    );
                    return Redirect()->route('all.customer')->with($notification);

                } else{
                    $notification=array(
                        'message' => 'Error ',
                        'alert-type'=>'success'
                    );
                    return Redirect()->back()->with($notification);

                }
            }
        }


    }
}
