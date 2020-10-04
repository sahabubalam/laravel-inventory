@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 bg-info">
                        <h4 class="pull-left page-title text-white">POS(Pint Of Sale)</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="#">Inventory</a></li>
                                <li class="active text-black">{{date('d/m/y')}}</li>
                            
                            </ol>
                    
                    </div>
                </div><br>
                <div class="row">

            
                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                <div class="portfolioFilter">
                                @foreach($category as $row)
                                    <a href="#" data-filter="*" class="current">{{$row->category_name}}</a>
                                @endforeach
                                </div>
                            </div>
                        </div>
                     <br>
                <div class="row">
                    <div class="col-lg-6">
                       

                    <div class="price_card text-center">
                        
                        <ul class="price-features">
                           <table class="table">
                            <thead class="bg-info">
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Sub Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php 
                            $cart=Cart::content();
                            @endphp
                            <tbody>
                            @foreach($cart as $row)
                                <tr>
                                    <th>{{$row->name}}</th>
                                    <th>
                                        <form action="{{url('cart-update/'.$row->rowId)}}" method="post">
                                        @csrf 
                                            <input type="number" name="qty" value="{{$row->qty}}" style="width:40px">
                                            <button type="submit" class="btn btn-sm btn-success" style="margin-top:-2px"><i class="fas fa-check"></i></button>
                                        </form>
                                    </th>
                                    <th>{{$row->price}}</th>
                                    <th>{{$row->price*$row->qty}}</th>
                                    <th><a href="{{URL::to('cart-remove/'.$row->rowId)}}"><i class="fas fa-trash-alt"></i></a></th>
                                
                                </tr>
                                @endforeach
                            
                            </tbody>
                           
                           </table>
                            
                        </ul>
                        <div class="pricing-header bg-primary">
                            <p style="font-size:19px">Quantity : {{Cart::count()}}</p>
                            <p style="font-size:19px">Sub Total : {{Cart::subtotal()}}</p>
                           
                           
                            <p style="font-size:19px">Vat :{{Cart::tax()}}</p>
                            <hr>
                            <h2><p>Total : {{Cart::total()}}</p></h2>
                            <form action="{{url('create-invoice')}}" method="post">
                            @csrf
                            <div class="panel"><br><br>
                            @error('customer_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <h4  class="text-info">Selecet Customer
                            <a href="#" class="btn btn-sm pull-right btn-primary waves-effect waves-light"
                             data-toggle="modal" data-target="#con-close-modal">Add Customer</a>
                            
                            </h4>
                            @php 
                            $customer=DB::table('customers')->get();
                            @endphp
                            <select class="form-control" name="customer_id">
                                <option disabled="" selected="">Select Customer</option>
                                @foreach($customer as $cus)
                                <option value="{{$cus->id}}">{{$cus->name}}</option>
                                @endforeach
                                

                            </select>
                        
                        </div>
                        </div>
                        <button type="submit" class="btn btn-success">Create Invoice</button>
                    </div> <!-- end Pricing_card -->
                    </form>
                    </div>

              
                    <div class="col-lg-6">
                        <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th> Name</th>
                                            <th> Category</th>
                                            <th> Code</th>
                                          
                                        </tr>
                                    </thead>

                                
                                    <tbody>
                                    @foreach($product as $row)
                                        <tr>
                                        <form action="{{url('add-cart')}}" method="post">
                                        @csrf
                                            <input type="hidden" name="id" value="{{$row->id}}">
                                            <input type="hidden" name="name" value="{{$row->product_name}}">
                                            <input type="hidden" name="qty" value="1">
                                            <input type="hidden" name="price" value="{{$row->selling_price}}">
                                            <td>
                                           
                                            <img src="{{URL::to($row->product_image)}}" width="60px"  height="60px">
                                            </td>
                                            <td>{{$row->product_name}}</td>
                                            <td>{{$row->category_name}}</td>
                                            <td>{{$row->product_code}}</td>
                                            <td><button type="submit" class="btn btn-sm btn-info"><i class="fas fa-plus-square"></button></td>
                            
                                        </form>    
                                        </tr> 
                                    @endforeach
                                    </tbody>
                        </table>
                    
                    </div>
                
                </div>

               
            </div>
        
        </div>
    
    </div>
    <!--customer add modal -->
    <form action="{{url('insert-customer')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h4 class="modal-title">Modal Content is Responsive</h4> 
                </div> 
                <div class="modal-body">  
                    <div class="row"> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-4" class="control-label">Name</label> 
                                <input type="text" class="form-control" id="field-4" name="name" placeholder="Name"> 
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                         </div> 
                        </div> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-5" class="control-label">Email</label> 
                                <input type="email" class="form-control" id="field-5" name="email" placeholder="Email"> 
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-6" class="control-label">Phone</label> 
                                <input type="text" class="form-control" id="field-6" name="phone" placeholder="Phone"> 
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-4" class="control-label">Address</label> 
                                <input type="text" class="form-control" id="field-4" name="address" placeholder="Address">
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror 
                            </div> 
                        </div> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-5" class="control-label">Shop Name</label> 
                                <input type="text" class="form-control" id="field-5" name="shop_name" placeholder="Shop Name"> 
                            </div> 
                        </div> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-6" class="control-label">Account Number</label> 
                                <input type="text" class="form-control" id="field-6" name="account_number" placeholder="Account Number"> 
                                @error('account_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div> 
                    </div>
                    <div class="row"> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-4" class="control-label">Account Holder</label> 
                                <input type="text" class="form-control" id="field-4" name="account_holder" placeholder="Account Holder"> 
                                @error('account_holder')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-5" class="control-label">Bank Name</label> 
                                <input type="text" class="form-control" id="field-5" name="bank_name" placeholder="Bank Name"> 
                                @error('bank_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-6" class="control-label">Bank branch</label> 
                                <input type="text" class="form-control" id="field-6" name="bank_branch" placeholder="Bank Branch"> 
                                @error('bank_branch')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div> 
                    </div>
                    <div class="row"> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-4" class="control-label">City</label> 
                                <input type="text" class="form-control" id="field-4" name="city" placeholder="City"> 
                                @error('city')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                            <img id="image" src="#" />
                                <label for="field-6" class="control-label">Photo</label> 
                               
                            </div> 
                        </div> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-6" class="control-label">Photo</label> 
                                <input type="file"  name="photo" accept="image/*" class="upload"  onchange="readURL(this);">
                            </div> 
                        </div> 
                    </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button> 
                </div> 
            </div> 
        </div>
    </div><!-- /.modal -->
    </form>

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