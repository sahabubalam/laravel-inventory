@extends('layouts.app')

@section('content')
<div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="pull-left page-title">Welcome</h4>
                            <ul class="breadcrumb pull-right">
                                <li><a href="#">StartUp</a></li>
                                <li class="active">IT</li>
                            </ul>
                    </div>
                </div>

                <div>
                    <a href="{{route('January.expense')}}" class="btn btn-sm btn-info">January</a>
                    <a href="{{route('February.expense')}}" class="btn btn-sm btn-danger">February</a>
                    <a href="{{route('March.expense')}}" class="btn btn-sm btn-success">March</a>
                    <a href="{{route('April.expense')}}" class="btn btn-sm btn-primary">April</a>
                    <a href="{{route('May.expense')}}" class="btn btn-sm btn-warning">May</a>
                    <a href="{{route('June.expense')}}" class="btn btn-sm btn-info">June</a>
                    <a href="{{route('July.expense')}}" class="btn btn-sm btn-default">July</a>
                    <a href="{{route('August.expense')}}" class="btn btn-sm btn-info">August</a>
                    <a href="{{route('September.expense')}}" class="btn btn-sm btn-success">September</a>
                    <a href="{{route('October.expense')}}" class="btn btn-sm btn-info">October</a>
                    <a href="{{route('November.expense')}}" class="btn btn-sm btn-primary">November</a>
                    <a href="{{route('December.expense')}}" class="btn btn-sm btn-info">December</a>
                
                </div>




            @php 
                $month=date("F");
                $expense=DB::table('expenses')->where('month',$month)->sum('amount');
            @endphp
    <div class="row">
        <div class="col-md-12">
        <h4 style="color:black;font-size:30px;" align="center">Total : {{$expense}} Taka</h4>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{date("F")}} All Expense
                   
                    
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Details</th>
                                        <th>date</th>
                                        <th>Amount</th>
                                       
                                    </tr>
                                </thead>

                            
                                <tbody>
                                @foreach($monthly as $row)
                                    <tr>
                                        <td>{{$row->details}}</td>
                                        <td>{{$row->date}}</td>
                                        <td>{{$row->amount}}</td>
                           
                                        
                                    </tr> 
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div> <!-- End Row -->
    </div>
    </div>
    </div>
@endsection