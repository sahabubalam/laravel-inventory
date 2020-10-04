<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;

class CartController extends Controller
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
    public function add_cart(Request $request)
    {
        $data=array();
        $data['id']=$request->id;
        $data['name']=$request->name;
        $data['qty']=$request->qty;
        $data['price']=$request->price;
        $data['weight']=1;
        $add=Cart::add($data);
        if($add) {
            $notification=array(
                'message' => 'Product Successfully Added',
                'alert-type'=>'success'
            );
            return Redirect()->route('pos')->with($notification);
    
        } else{
            $notification=array(
                'message' => 'Error ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
    
        }
    }
    public function update_cart(Request $request,$rowId)
    {
        $qty=$request->qty;
        $update=Cart::update($rowId,$qty);
        if($update) {
            $notification=array(
                'message' => 'Cart Successfully Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('pos')->with($notification);
    
        } else{
            $notification=array(
                'message' => 'Error ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
    
        }
    }
    public function remove_cart($rowId)
    {
        $remove=Cart::remove($rowId);
        if($remove) {
            $notification=array(
                'message' => 'Cart Successfully Removed',
                'alert-type'=>'success'
            );
            return Redirect()->route('pos')->with($notification);
    
        } else{
            $notification=array(
                'message' => 'Error ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
    
        }
    }
    public function create_invoice(Request $request)
    {
         $request->validate([
            'customer_id' => 'required',
         ],

         [ 
            'customer_id.required'=> 'Select A Customer First !'
        ]);

        $cus_id=$request->customer_id;
        $customer=DB::table('customers')->where('id',$cus_id)->first();
        $content=Cart::content();
       return view('frontend.invoice.invoice',compact('customer','content'));
    }
    public function final_invoice(Request $request)
    {
        $data=array();
        $data['customer_id']=$request->customer_id;
        $data['order_date']=$request->order_date;
        $data['order_status']=$request->order_status;
        $data['total_products']=$request->total_products;
        $data['sub_total']=$request->sub_total;
        $data['vat']=$request->vat;
        $data['total']=$request->total;
        $data['payment_status']=$request->payment_status;
        $data['pay']=$request->pay;
        $data['due']=$request->due;
        $order_id=Db::table('orders')->insertGetId($data);

        $contents=Cart::content();
        $odata=array();
        foreach($contents as $content)
        {
            $odata['order_id']= $order_id;
            $odata['product_id']= $content->id;
            $odata['quantity']= $content->qty;
            $odata['unitcost']= $content->price;
            $odata['total']= $content->total;

            $insert=DB::table('orderdetails')->insert($odata);
        }
        if($insert) {
            $notification=array(
                'message' => ' Successfully Invoice Created .Please! Confirm Order Status.',
                'alert-type'=>'success'
            );
            Cart::destroy();
            return Redirect()->route('home')->with($notification);
    
        } else{
            $notification=array(
                'message' => 'Error ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
    
        }
    }
}
