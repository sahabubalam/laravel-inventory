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
                    <h3 class="panel-title">Take attendence</h3>
                </div>
                <div class="panel-body">
                <h3 class="text-success">{{date('d/m/y')}} Today</h3>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Attendence</th>
                                    </tr>
                                </thead>

                            
                                <tbody>
                                <form action="{{url('insert-attendence')}}" method="post">
                                @csrf
                                    @foreach($employee as $row)
                                        <tr>
                                    
                                            <td>{{$row->name}}</td>
                                            
                                            <td><img src="{{$row->photo}}" style="height:80px;width:80px"></td>
                                            <input type="hidden" name="employee_id[]" value="{{$row->id}}">
                                            @error('employee_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <td>
                                                <input class="checkbox-circle" type="radio" name="attendence[{{$row->id}}]" value="Present"> Present
                                                <input  class="checkbox-circle" type="radio" name="attendence[{{$row->id}}]" value="Absent"> Absent
                                                @error('attendence')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <input type="hidden" name="att_date" value="{{date("d/m/y")}}">
                                            @error('att_date')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <input type="hidden" name="att_year" value="{{date("Y") }}">
                                            @error('att_year')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        
                                        </tr> 
                                    @endforeach
                                   
                                
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success">Take attendence</button>
                            </form>
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