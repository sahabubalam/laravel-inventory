<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Attendence;

class AttendenceController extends Controller
{
   public function take_attendence()
   {
       $employee=DB::table('employees')->get();
       return view('frontend.attendence.take_attendence',compact('employee'));
   }
   //take attendence

   public function store(Request $request)
   {
    $validatedData = $request->validate([
        'employee_id' => 'required|max:255',
        'attendence' => 'required|max:255',
        'att_date' => 'required',
        'att_year' => 'required',
       
    ]);
       $date=$request->att_date;
       $att_date=DB::table('attendences')->where('att_date',$date);
       if($att_date)
       {
        $notification=array(
            'message' => 'Today Attendence Already Taken ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
       }
       else
       {
        foreach($request->employee_id as $id) {
            $data[]=[
                "employee_id"=>$id,
                "attendence"=>$request->attendence[$id],
                "att_date"=>$request->att_date,
                "att_year"=>$request->att_year,
                "edit_date"=>date("d_m_y")
            ];
       }
       $att=DB::table('attendences')->insert($data);
       if($att) {
        $notification=array(
            'message' => 'Attendence Successfully Taken',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    } else{
        $notification=array(
            'message' => 'Error ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }
       }
      
       
   }
   public function all_attendence()
   {
      $all_att=DB::table('attendences')->select('edit_date')->groupBy('edit_date')->get();
      return view('frontend.attendence.all_attendence',compact('all_att'));
   }
   public function edit_attendence($edit_date)
   {
       $data=DB::table('attendences')
                ->join('employees','attendences.employee_id','employees.id')
                ->select('employees.name','employees.photo','attendences.*')
                ->where('edit_date',$edit_date)->get();
       return view('frontend.attendence.edit_attendence',compact('data'));
   }
   public function Setting()
   {
       echo "done";
   }
}
