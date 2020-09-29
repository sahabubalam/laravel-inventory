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
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Pay Salary</h3>
                    <h1>{{date('F Y')}}</h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Salary</th>
                                        <th>Month</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                            
                                <tbody>
                                @foreach($employee as $row)
                                    <tr>
                                   
                                        <td>{{$row->name}}</td>
                                       
                                        <td><img src="{{$row->photo}}" style="height:80px;width:80px"></td>
                                        <td>{{$row->salary}}</td>
                                        <td>{{ date("F", strtotime('-1 months')) }}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-info">Pay Now</a>
                                            
                                        </td>
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