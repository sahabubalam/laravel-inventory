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

                @php 
                    $year=date("Y");
                    $expense=DB::table('expenses')->where('year',$year)->sum('amount');
                @endphp
    <div class="row">
        <div class="col-md-12">
        <h4 style="color:black;font-size:30px;" align="center">Total : {{$expense}} Taka</h4>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{date("Y")}} All Expense
                   
                    
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Details</th>
                                        <th>Amount</th>
                                       
                                    </tr>
                                </thead>

                            
                                <tbody>
                                @foreach($yearly as $row)
                                    <tr>
                                        <td>{{$row->details}}</td>
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