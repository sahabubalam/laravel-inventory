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
                    <h3 class="panel-title">Datatable</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                            
                                <tbody>
                                @foreach($category as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->category_name}}</td>
                           
                                        <td>
                                            <a href="{{URL::to('edit-category/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                            <a href="{{URL::to('delete-category/'.$row->id)}}" class="btn btn-sm btn-danger">Delete</a>
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