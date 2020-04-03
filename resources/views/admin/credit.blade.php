@extends('layout.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Credit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Credit</li>
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
            <div class="col-lg-12">
            <div class="card ">
            <div class="card-header">
                <h3 class="card-title">Add Credit</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
          <!-- /.card-header -->
          <div class="card-body" style="display: block;">        
            <form enctype="multipart/form-data" class="" action="{{route('add_credit')}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="">First Name </label>
                                <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="">Last Name </label>
                                <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="">Contact No. </label>
                                <input type="text" name="contact_num" id="contact_num" class="form-control" placeholder="Contact Number" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="">Address </label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Address" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Item </label>
                                <select name="item" id="item" class="form-control" required>
                                    <option value=''> &nbsp; </option>
                                    @foreach($data_item as $Item)
                                        <option value="{{$Item->id}}, {{$Item->unit_price}}">{{$Item->product_name}} - {{$Item->model}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="product_id" id="product_id" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="">Amount</label>
                                <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="">Downpayment</label>
                                <input type="text" name="downpayment" id="downpayment" class="form-control" placeholder="Downpayment" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="">Term</label>
                                <input type="number" name="term" id="term" class="form-control" placeholder="Term" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="">Date</label>
                                <input type="date" name="date_credit" id="date_credit" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                            <button type="submit" class="btn btn-info text-center"> <i class=" fas fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>  
          </div>
          <!-- /.card-body -->
          
        </div>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
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
                                <th> Item </th>             
                                <th> Amount</th>
                                <th> Downpayment</th>
                                <th> Balance </th>
                                <th> Term </th>
                                <th> Term Payment</th>
                                <th> Status</th>
                            </tr>
                            </thead>
                            <tbody class="creditresult">
                                @foreach($data_credit as $Credit)
                                <tr>
                                    <td><a href="/admin/account/{{$Credit->account->id}}">{{$Credit->account->lname}}, {{$Credit->account->fname}}</a></td>
                                    <td>{{$Credit->product->product_name}}</td>
                                    <td>{{$Credit->amount}}</td>
                                    <td>{{$Credit->downpayment}}</td>
                                    <td>{{$Credit->balance}}</td>
                                    <td>{{$Credit->term}}</td>
                                    <td>{{$Credit->term_payment}}</td>
                                    <td>{{$Credit->status}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
<script>
$(document).ready(function(){
    $("#item").change(function () {
    var item = $('select[name=item]').val();
        var array = item.split(',');
        var product_id = array[0];
        var amount = array[1]; 
    $('#product_id').val(product_id);
    $('#amount').val(amount);
    });
});
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/creditscript.js') }}"></script>
@endsection