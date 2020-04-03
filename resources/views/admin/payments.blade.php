@extends('layout.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Payments</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Payments</li>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Payment History</h3>
                    </div>
                    <div class="no-print">{{$data_payment->links()}}</div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th>Date</th>    
                                <th>Bill No.</th>
                                <th>Account</th>
                                <th>Item</th>
                                <th>Amount</th>
                                <th>Posted by</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data_payment as $Payment)
                                <tr>
                                    <td>{{$Payment->payment_date}}</td>
                                    <td>{{$Payment->bill_id}}</td>
                                    <td><a href="/admin/account/{{$Payment->account->id}}">{{strtoupper($Payment->account->lname)}}, {{strtoupper($Payment->account->fname)}} {{strtoupper($Payment->account->mname)}}</a></td>
                                    <td>{{$Payment->bill->credit->product->product_name}} {{$Payment->bill->credit->product->model}}</td>
                                    <td>{{$Payment->amount}}</td>
                                    <td>{{$Payment->user->name}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5"><em>No Record</em></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <button class="btn btn-info btn-sm no-print" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                     
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
@endsection