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
                                        <form role="form" action="{{url('insert-customer')}}" enctype="multipart/form-data" method="post">
                                        @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name </label>
                                                <input type="text" class="form-control" name="name" placeholder="Full name">
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Email</label>
                                                <input type="email" class="form-control" name="email" placeholder="Email">
                                                @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Phone</label>
                                                <input type="text" class="form-control" name="phone" placeholder="Phone">
                                                @error('phone')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Address</label>
                                                <input type="text" class="form-control" name="address" placeholder="Address">
                                                @error('address')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Shop Name</label>
                                                <input type="text" class="form-control" name="shop_name" placeholder="Shop Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Account Holder</label>
                                                <input type="text" class="form-control" name="account_holder" placeholder="Account Holder">
                                                @error('account_holder')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Account Number </label>
                                                <input type="text" class="form-control" name="account_number" placeholder="Account Number">
                                                @error('account_number')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Bank Name</label>
                                                <input type="text" class="form-control" name="bank_name" placeholder="Bank Name">
                                                @error('bank_name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Bank Branch</label>
                                                <input type="text" class="form-control" name="bank_branch" placeholder=" Bank Branch">
                                                @error('bank_branch')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">City</label>
                                                <input type="text" class="form-control" name="city" placeholder="City">
                                                @error('city')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                            <img id="image" src="#" />
                                                <label for="exampleInputPassword1">Photo</label>
                                                <input type="file"  name="photo" accept="image/*" class="upload"  onchange="readURL(this);">
                                                @error('photo')
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