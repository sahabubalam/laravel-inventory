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
                                    <div class="panel-heading"><h3 class="panel-title">Add Product</h3></div>
                                    <div class="panel-body">
                                        <form role="form" action="{{url('update-product/'.$product->id)}}" enctype="multipart/form-data" method="post">
                                        @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Product Name </label>
                                                <input type="text" class="form-control" name="product_name" value=" {{$product->product_name}}">
                                                @error('product_name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Product Code</label>
                                                <input type="text" class="form-control" name="product_code" value=" {{$product->product_code}}">
                                                @error('product_code')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Category</label>
                                                @php 
                                                $cat=DB::table('categories')->get();
                                                @endphp
                                                <select name="cat_id" class="form-control">
                                                    <option disabled="" selected=""></option>
                                                    @foreach($cat as $row)
                                                    <option value="{{$row->id}}" <?php if($product->cat_id==$row->id) { echo "selected" ;}?>>{{$row->category_name}}</option>
                                                    @endforeach
                                                    
                                               
                                               </select>
                                                @error('cat_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Supplier</label>
                                                @php 
                                                $sup=DB::table('suppliers')->get();
                                                @endphp
                                                <select name="sup_id" class="form-control">
                                                    <option disabled="" selected=""></option>
                                                    @foreach($sup as $row)
                                                    <option value="{{$row->id}}" <?php if($product->sup_id==$row->id) { echo "selected" ;}?>>{{$row->name}}</option>
                                                    @endforeach
                                                    
                                               
                                               </select>
                                                @error('sup_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Godaun</label>
                                                <input type="text" class="form-control" name="product_garage" value=" {{$product->product_garage}}">
                                                @error('product_garage')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Product Route </label>
                                                <input type="text" class="form-control" name="product_route" value=" {{$product->product_route}}">
                                                @error('product_route')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Buying Date </label>
                                                <input type="date" class="form-control" name="buy_date" value=" {{$product->buy_date}}">
                                                @error('buy_date')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Expire Date </label>
                                                <input type="text" class="form-control" name="expire_date" value=" {{$product->expire_date}}">
                                              
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Buying Price</label>
                                                <input type="text" class="form-control" name="buying_price" value=" {{$product->buying_price}}">
                                                @error('buying_price')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Selling Price </label>
                                                <input type="text" class="form-control" name="selling_price" value=" {{$product->selling_price}}">
                                            </div>
                                           
                                            <div class="form-group">
                                            <img id="image" src="#" />
                                                <label for="exampleInputPassword1">New Photo</label>
                                                <input type="file"  name="product_image" accept="image/*" class="upload"  onchange="readURL(this);">
                                               
                                            </div>
                                            <div class="form-group">
                                                <img src="{{URL::to($product->product_image)}}" style="height:80px;width:80px">
                                            <input type="hidden"  name="old_photo" value="{{$product->product_image}}">
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