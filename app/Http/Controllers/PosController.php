<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PosController extends Controller
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
        $product=DB::table('products')
                ->join('categories','products.cat_id','categories.id')
                ->select('categories.category_name','products.*')
                ->get();
        $customer=DB::table('customers')->get();
        $category=DB::table('categories')->get();
        return view('frontend.pos.pos',compact('product','customer','category'));
    }
}
