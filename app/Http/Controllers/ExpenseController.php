<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Expense;

class ExpenseController extends Controller
{
    public function index()
    {
        return view('frontend.expense.add_expense');
    }
    //store expense

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'details' => 'required|max:255',
            'amount' => 'required|max:255',
            'month' => 'required',
            'date' => 'required',
            'year' => 'required',
           
        ]);
        $data=array();
        $data['details']=$request->details;
        $data['amount']=$request->amount;
        $data['date']=$request->date;
        $data['month']=$request->month;
        $data['year']=$request->year;
        $expense=DB::table('expenses')->insert($data);
        if($expense) {
            $notification=array(
                'message' => 'Successfully Expense added',
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
    //today expense

    public function today_expense()
    {
        $date=date('d/m/y');
        $today=DB::table('expenses')->where('date',$date)->get();
        return view('frontend.expense.today_expense',compact('today'));
    }
    //edit expense

    public function edit_today_expense($id)
    {
        $edit=DB::table('expenses')->where('id',$id)->first();
        return view('frontend.expense.edit_today_expense',compact('edit'));
    }
    //update expense

    public function update_today_expense(Request $request,$id)
    {
        $validatedData = $request->validate([
            'details' => 'required|max:255',
            'amount' => 'required|max:255',
            'month' => 'required',
            'date' => 'required',
            'year' => 'required',
           
        ]);
        $data=array();
        $data['details']=$request->details;
        $data['amount']=$request->amount;
        $data['date']=$request->date;
        $data['month']=$request->month;
        $data['year']=$request->year;
        $expense=DB::table('expenses')->where('id',$id)->update($data);
        if($expense) {
            $notification=array(
                'message' => 'Successfully Expense updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('today.expense')->with($notification);
    
        } else{
            $notification=array(
                'message' => 'Error ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
    
        }

    }
    //monthly expense

    public function monthly_expense()
    {
        $month=date("F");
        $monthly=DB::table('expenses')->where('month',$month)->get();
        return view('frontend.expense.monthly_expense',compact('monthly'));
    }
    //yearly expense

    public function yearly_expense()
    {
        $year=date("Y");
        $yearly=DB::table('expenses')->where('year',$year)->get();
        return view('frontend.expense.yearly_expense',compact('yearly'));
    }
    //individual monthly expense

    public function january_expense()
    {
        $month="January";
        $monthly=DB::table('expenses')->where('month',$month)->get();
        return view('frontend.expense.monthly_expense',compact('monthly'));
    }
    public function february_expense()
    {
        $month="February";
        $monthly=DB::table('expenses')->where('month',$month)->get();
        return view('frontend.expense.monthly_expense',compact('monthly'));
    }
    public function march_expense()
    {
        $month="March";
        $monthly=DB::table('expenses')->where('month',$month)->get();
        return view('frontend.expense.monthly_expense',compact('monthly'));
    }
    public function april_expense()
    {
        $month="April";
        $monthly=DB::table('expenses')->where('month',$month)->get();
        return view('frontend.expense.monthly_expense',compact('monthly'));
    }
    public function may_expense()
    {
        $month="May";
        $monthly=DB::table('expenses')->where('month',$month)->get();
        return view('frontend.expense.monthly_expense',compact('monthly'));
    }
    public function june_expense()
    {
        $month="June";
        $monthly=DB::table('expenses')->where('month',$month)->get();
        return view('frontend.expense.monthly_expense',compact('monthly'));
    }
    public function july_expense()
    {
        $month="July";
        $monthly=DB::table('expenses')->where('month',$month)->get();
        return view('frontend.expense.monthly_expense',compact('monthly'));
    }
    public function august_expense()
    {
        $month="August";
        $monthly=DB::table('expenses')->where('month',$month)->get();
        return view('frontend.expense.monthly_expense',compact('monthly'));
    }
    public function september_expense()
    {
        $month="September";
        $monthly=DB::table('expenses')->where('month',$month)->get();
        return view('frontend.expense.monthly_expense',compact('monthly'));
    }

    public function october_expense()
    {
        $month="October";
        $monthly=DB::table('expenses')->where('month',$month)->get();
        return view('frontend.expense.monthly_expense',compact('monthly'));
    }
    public function november_expense()
    {
        $month="November";
        $monthly=DB::table('expenses')->where('month',$month)->get();
        return view('frontend.expense.monthly_expense',compact('monthly'));
    }
    public function december_expense()
    {
        $month="December";
        $monthly=DB::table('expenses')->where('month',$month)->get();
        return view('frontend.expense.monthly_expense',compact('monthly'));
    }
}
