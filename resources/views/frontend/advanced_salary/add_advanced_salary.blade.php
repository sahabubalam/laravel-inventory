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
                                <div class="panel panel-info">
                                    <div class="panel-heading"><h3 class="panel-title text-white">Advanced Salary</h3></div>
                                    <div class="panel-body">
                                        <form role="form" action="{{url('insert-advanced-salary')}}" method="post">
                                        @csrf
                                           <div class="form-group">
                                                <label for="exampleInputPassword1">Supplier Type</label>
                                                @php
                                                $emp=DB::table('employees')->get();
                                                @endphp
                                               
                                               <select name="employee_id" class="form-control">
                                                    <option disabled="" selected=""></option>
                                                    @foreach($emp as $row)
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach                                            
                                               </select>
                                              
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Month </label>
                                               <select name="month" class="form-control">
                                                    <option disabled="" selected=""></option>
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April">April</option>
                                                    <option value="May">May</option>
                                                    <option value="June">June</option>
                                                    <option value="July">July</option>
                                                    <option value="August">August</option>
                                                    <option value="September">September</option>
                                                    <option value="October">October</option>
                                                    <option value="November">November</option>
                                                    <option value="December">December</option>
                                                    
                                               </select>                                           
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Year</label>
                                                <input type="text" class="form-control" name="year" placeholder="year">
                                                @error('year')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Advanced Salary</label>
                                                <input type="text" class="form-control" name="advanced_salary" placeholder="Advanced Salary">
                                                @error('advanced_salary')
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

    <script type="text/javascript">
    function readURL(input) {
        if(input.files && input.files[0]) {
            var reader =  new FileReader();
            reader.onload = function (e) {
                $('#image')
                .attr('src', e.target.result)
                .width(80)
                .height(80);

            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    </script>

@endsection