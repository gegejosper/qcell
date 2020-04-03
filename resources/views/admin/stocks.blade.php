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
                        <form class="form-horizontal" action="{{route('add_stock')}}" method="post">
                            @csrf
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="">Batch Number </label>
                                    <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product Name" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="">Date </label>
                                    <input type="date" name="date" id="date" class="form-control" placeholder="Date" required>
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
                        <h3 class="card-title">Stock Record List</h3>
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
                                <th> Date </th>             
                                <th> Batch</th>
                                <th> </th>
                            </tr>
                            </thead>
                            <tbody class="productresult">
                            @foreach($data_stock as $Stock)
                            <tr>
                                <td>
                                    <a href="/admin/stock/view/{{$Stock->id}}">{{$Stock->stock_date}}</a>
                                </td>
                                <td>
                                    <a href="/admin/stock/view/{{$Stock->id}}">{{$Stock->batch_number}}</a>
                                </td>
                                <td>
                                    <a href="/admin/stock/view/{{$Stock->id}}" class="btn btn-info btn-sm">
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
@endsection