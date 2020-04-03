@extends('layout.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Items</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Items</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Item</h3>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" class="form-horizontal" action="{{route('add_item')}}" method="post">
                            @csrf
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="Item Image">Item Image</label> 
                                <input data-preview="#preview" name="input_img" type="file" id="imageInput" class="form-control" required>
                                <img class="col-sm-6" id="preview"  src="" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="">Item </label>
                                    <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product Name" required>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Brand </label>
                                    <select name="brand" id="brand" class="form-control">
                                        @foreach($data_brand as $Brand)
                                        <option value="{{$Brand->id}}">{{$Brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="">Model </label>
                                    <input type="text" name="model" id="model" class="form-control" placeholder="Model" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="">Quantity </label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="">Installment Price </label>
                                    <input type="text" name="unit_price" id="unit_price" class="form-control" placeholder="Installment Price" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="">Cash Price </label>
                                    <input type="text" name="cash_price" id="cash_price" class="form-control" placeholder="Cash Price" required>
                                </div>
                            </div>

                             <div class="col-lg-12">
                                <div class="form-group">
                                <button type="submit" class="btn btn-info text-center"> <i class=" fas fa-save"></i> ADD</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Item List</h3>
                    </div>
                    <div class="card-body table-responsive">
                        @if(Session::has('success'))
                          <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Success!</h5>
                            {{ Session::get('success') }}
                              @php
                              Session::forget('success');
                              @endphp
                          </div>
                        @endif
                        <table class="table table-striped" id="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th> Item </th>             
                                <th> Brand</th>
                                <th> Model</th>
                                <th> Quantity </th>
                                <th> Installment Price </th>
                                <th> Cash Price </th>
                                <th> </th>
                            </tr>
                            </thead>
                            <tbody class="productresult">
                            @foreach($data_item as $Item)
                            <tr>
                                
                                <td>
                                <?php $count = 0; ?>
                                @foreach($Item->pic as $Pic)
                                <?php 
                                    if($count < 1){
                                ?>
                                <a href="/admin/item/view/{{$Item->id}}" ><img width="50" src="{{asset('productimg')}}/{{$Pic->file_name}}"></a></td>
                                <?php
                                    
                                    }
                                    
                                    $count++;
                                ?>
                                @endforeach
                                <td>
                                    <a href="#" class="xedit" 
                                            data-pk="{{$Item->id}}" 
                                            data-name="product_name"
                                            >
                                            {{$Item->product_name}}
                                    </a>  
                                    </td>
                                <td>
                                    <a href="#" id="brand_edit" class="xedit" 
                                        data-type="select" 
                                        data-pk="{{$Item->id}}" 
                                        data-name="brand"
                                        data-source="[@foreach($brands as $brand){value:'{{$brand['value']}}',text:'{{$brand['text']}}'},@endforeach]"
                                        >
                                        {{$Item->branddetails->brand_name}}</a>
                                    </td>
                                <td>
                                    <a href="#" class="xedit" 
                                            data-pk="{{$Item->id}}" 
                                            data-name="model"
                                            >
                                        {{$Item->model}}    
                                    </a>    
                                </td>
                                <td>
                                    <a href="#" class="xedit" 
                                            data-pk="{{$Item->id}}" 
                                            data-name="quantity"
                                            >
                                            {{$Item->quantity}}    
                                    </a>  
                                    </td>
                                <td>
                                    <a href="#" class="xedit" 
                                            data-pk="{{$Item->id}}" 
                                            data-name="unit_price"
                                            >
                                            {{$Item->unit_price}}   
                                    </a>      
                                </td>
                                <td>
                                    <a href="#" class="xedit" 
                                            data-pk="{{$Item->id}}" 
                                            data-name="cash_price"
                                            >
                                            {{$Item->cash_price}}   
                                    </a>      
                                </td>
                                <td>
                                    <a href="/admin/item/view/{{$Item->id}}" class="btn btn-info btn-sm">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$data_item->links()}}
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

    <script>
		$(document).ready(function () {
	            $.ajaxSetup({
	                headers: {
	                    'X-CSRF-TOKEN': '{{csrf_token()}}'
	                }
	            });

	            $('.xedit').editable({
	                url: '{{url("/admin/item/edit")}}',
	                title: 'Update',
	                success: function (response, newValue) {
	                    console.log('Updated', response)
	                }
                });
        })
    </script>

    
@endsection