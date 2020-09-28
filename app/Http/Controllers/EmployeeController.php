<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Employee;

class EmployeeController extends Controller
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
        return view('frontend.add_employee');
    }
    //store employee==================
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:employees|max:255',
            'nid' => 'required|unique:employees|max:255',
            'address' => 'required',
            'phone' => 'required|max:13',
            'photo' => 'required',
            'salary' => 'required',   
            'vacation' => 'required',
            'city' => 'required', 
        ]);
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['experience']=$request->experience;
        $data['nid']=$request->nid;
        $data['salary']=$request->salary;
        $data['vacation']=$request->vacation;
        $data['city']=$request->city;
        $image=$request->file('photo');
        if($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientoriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/employee/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $data['photo']=$image_url;
                $employee=DB::table('employees')
                         ->insert($data);
                         if($employee) {
                             $notification=array(
                                 'message' => 'Successfully Employee inserted',
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

    //all employee===========
    public function all_employee()
    {
        $employee=Employee::all();
        return view('frontend.all_employee',compact('employee'));
    }
    //delete employee===========
    public function deleteemployee($id)
    {
        $delete=DB::table('employees')
                ->where('id',$id)
                ->first();
                $photo=$delete->photo;
                unlink($photo);
                $deletuser=DB::table('employees')->where('id',$id)->delete();
                if($deletuser) {
                    $notification=array(
                        'message' => 'Successfully Employee deleted',
                        'alert-type'=>'success'
                    );
                    return Redirect()->route('all.employee')->with($notification);

                } else{
                    $notification=array(
                        'message' => 'Error ',
                        'alert-type'=>'success'
                    );
                    return Redirect()->back()->with($notification);

                }

    }
    //edit employee=============

    public function editemployee($id)
    {
        $edit=DB::table('employees')
                ->where('id',$id)
                ->first();
                return view('frontend.edit_employee',compact('edit'));
    }
    //update employee============

    public function update_employee(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'nid' => 'required|max:255',
            'address' => 'required',
            'phone' => 'required|max:13',
            'photo' => 'required',
            'salary' => 'required',   
            'vacation' => 'required',
            'city' => 'required', 
        ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['experience']=$request->experience;
        $data['nid']=$request->nid;
        $data['salary']=$request->salary;
        $data['vacation']=$request->vacation;
        $data['city']=$request->city;
        $image=$request->photo;
        if($image)
        {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientoriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/employee/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            if($success)
            {
                $data['photo']=$image_url;
                $img=DB::table('employees')->where('id',$id)->first();
                $img_path=$img->photo;
                $done=unlink( $img_path);
                $post=DB::table('employees')->where('id',$id)->update($data);
                if($post) {
                    $notification=array(
                        'message' => 'Successfully Employee updated',
                        'alert-type'=>'success'
                    );
                    return Redirect()->route('all.employee')->with($notification);

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
