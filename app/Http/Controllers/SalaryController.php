<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Salary;

class SalaryController extends Controller
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
        return view('frontend.advanced_salary.add_advanced_salary');
   }
   //store advanced slary

   public function store(Request $request)
   {
    $validatedData = $request->validate([
        'employee_id' => 'required',
        'month' => 'required',
        'year' => 'required',
        'advanced_salary' => 'required',
    ]);
    $month=$request->month;
    $employee_id=$request->employee_id;
    $advanced=DB::table('advanced_salaries')
                ->where('month',$month)
                ->where('employee_id',$employee_id)
                ->first();
                if($advanced===NULL)
                {
                    $data=array();
                    $data['employee_id']=$request->employee_id;
                    $data['month']=$request->month;
                    $data['year']=$request->year;
                    $data['advanced_salary']=$request->advanced_salary;
                    $advanced=DB::table('advanced_salaries')->insert($data);
                    if($advanced) {
                     $notification=array(
                         'message' => 'Successfully Paid  Advanced Salary',
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

                }else {
                    $notification=array(
                        'message' => 'Opps ! Already Advanced Salary Paid ',
                        'alert-type'=>'success'
                    );
                    return Redirect()->back()->with($notification);
            

                }
     

   }
   public function all_advanced_salary()
   {
       $advanced_salary=DB::table('advanced_salaries')
                        ->join('employees','advanced_salaries.employee_id','employees.id')
                        ->select('advanced_salaries.*','employees.name','employees.salary','employees.photo')
                        ->orderBy('id','DESC')
                        ->get();
       return view('frontend.advanced_salary.all_advanced_salary',compact('advanced_salary'));
   }
   //pay salary

   public function pay_salary()
   {
      /* $month=date("F",strtotime('-1 month'));
        $salary=DB::table('advanced_salaries')
        ->join('employees','advanced_salaries.employee_id','employees.id')
        ->select('advanced_salaries.*','employees.name','employees.salary','employees.photo')
        ->where('month',$month)
        ->get();
        */
        $employee=DB::table('employees')->get();
        return view('frontend.advanced_salary.pay_salary',compact('employee'));
   }
}
