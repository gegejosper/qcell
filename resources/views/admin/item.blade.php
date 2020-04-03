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
    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                
                <div class="col-12">
                <?php $count = 0; ?>
                    @foreach($data_item->pic as $Pic)
                        <?php 
                            if($count < 1){
                        ?>
                        <img src="{{asset('productimg')}}/{{$Pic->file_name}}" class="product-image">
                        <?php
                            
                            }
                            
                            $count++;
                        ?>
                    @endforeach
                
                </div>
                <div class="col-12 product-image-thumbs">
                    @foreach($data_picture as $Picture)
                        <div class="product-image-thumb">
                            <img src="{{asset('productimg')}}/{{$Picture->file_name}}" alt="{{$data_item->product_name}}">
                        </div>
                    @endforeach
                </div>
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
                    <form enctype="multipart/form-data" class="form-horizontal" action="{{route('add_product_image')}}" method="post">
                        @csrf
                        <div class="col-lg-12">
                            <div class="form-group">
                            <label for="Product Image">Product Image</label> 
                            <input data-preview="#preview" name="input_img" type="file" id="imageInput" class="form-control" required>
                            <input name="product_id" type="hidden" id="product_id" value="{{$data_item->id}}">
                            <img class="col-sm-6" id="preview"  src="" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-info btn-sm btn-flat">
                            <i class="fas fa-plus fa-lg mr-2"></i> 
                            Add Picture
                            </button>
                        </div>
                        <br><br>
                    </form>
                </div>
                
                <div class="col-12 col-sm-6">
                    <h3 class="my-3"> 
                        <a href="#" class="xedit" 
                            data-pk="{{$data_item->id}}" 
                            data-name="product_name"
                            >{{$data_item->product_name}}</a>
                    </h3>
                    <hr>
                
                    <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Brand</b> 
                        <a class="float-right xedit" href="#" id="brand_edit" 
                            data-type="select" 
                            data-pk="{{$data_item->id}}" 
                            data-name="brand"
                            data-source="[@foreach($brands as $brand){value:'{{$brand['value']}}',text:'{{$brand['text']}}'},@endforeach]"
                            >
                            {{$data_item->branddetails->brand_name}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Model</b> 
                            <a class="float-right xedit" href="#" 
                                    data-pk="{{$data_item->id}}" 
                                    data-name="model"
                                    >
                                {{$data_item->model}}    
                            </a>    
                    </li>
                    <li class="list-group-item">
                        <b>Quantity</b> 
                            <a class="float-right xedit" href="#" 
                                    data-pk="{{$data_item->id}}" 
                                    data-name="quantity"
                                    >
                                    {{$data_item->quantity}}    
                            </a>  
                    </li>
                    <li class="list-group-item">
                        <b>Amount</b> 
                        <a href="#" class="xedit float-right" 
                                data-pk="{{$data_item->id}}" 
                                data-name="unit_price"
                                >
                                {{$data_item->unit_price}}   
                        </a> 
                    </li>
                    </ul>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Credit List</h3>
                        </div>
                        <div class="card-body" style="display: block;">
                            {{$data_credit->links()}}
                            <table class="table table-striped" id="table">
                                <thead>
                                <tr>
                                    <th> Name</th>
                                              
                                    <th> Amount</th>
                                    <th> Downpayment</th>
                                    <th> Balance </th>
                                    
                                    <th> Status</th>
                                </tr>
                                </thead>
                                <tbody class="creditresult">
                                    @foreach($data_credit as $Credit)
                                    <tr>
                                        <td><a href="/admin/account/{{$Credit->account->id}}">{{$Credit->account->lname}}, {{$Credit->account->fname}}</a></td>
                                        
                                        <td>{{$Credit->amount}}</td>
                                        <td>{{$Credit->downpayment}}</td>
                                        <td>{{$Credit->balance}}</td>
                                        
                                        <td>{{$Credit->status}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Inventory Record</h3>
                        </div>
                        <div class="card-body" style="display: block;">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
      </div>
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