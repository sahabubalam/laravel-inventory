@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="pull-left page-title">Welcome</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="#">Inventory</a></li>
                                <li class="active">Dashboard</li>
                            
                            </ol>
                    
                    </div>
                </div>
                <!--
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                -->

                <div class="row">
                    <!-- Basic example form -->
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Add Customer</h3></div>
                                    <div class="panel-body">
                                        <form role="form" action="{{url('update-today-expense/'.$edit->id)}}"  method="post">
                                        @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Expense Details </label>
                                                <textarea class="form-control" rows="4" name="details">{{$edit->details}}</textarea>
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Amount</label>
                                                <input type="text" class="form-control" name="amount" value="{{$edit->amount}}">
                                                @error('amount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                
                                                <input type="hidden" class="form-control" name="date" value="{{date('d/m/y')}}">
                                                @error('amount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                               
                                                <input type="hidden" class="form-control" name="month" value="{{date('F')}}">
                                                @error('month')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                               
                                               <input type="hidden" class="form-control" name="year" value="{{date('Y')}}">
                                               @error('year')
                                                   <div class="alert alert-danger">{{ $message }}</div>
                                               @enderror
                                           </div>
                                         
                                          
                                          
                                          
                                            <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                                        </form>
                                    </div><!-- panel-body -->
                                </div> <!-- panel -->
                            </div> <!-- col-->
                
                </div>
            </div>
        
        </div>
    
    </div>

  

@endsection