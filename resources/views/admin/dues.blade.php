@extends('layout.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dues</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Dues</li>
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
                        <h3 class="card-title">Payment  Dues</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                            <th>Bill No.</th>
                            <th>Account</th>
                            <th>Item</th>
                            <th>Due Date</th>
                            <th>Payment Due</th>
                            <th>Balance</th>
                            <th>Status</th>
                           
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1;?>
                            @foreach($data_bill_due as $Bill)
                            <tr>
                                <td>{{$Bill->id}}</td>
                                <td><a href="/admin/account/{{$Bill->account->id}}">{{strtoupper($Bill->account->lname)}}, {{strtoupper($Bill->account->fname)}} {{strtoupper($Bill->account->mname)}}</a></td>
                                <td>{{$Bill->credit->product->product_name}} {{$Bill->credit->product->model}}</td>
                                <td>{{$Bill->due_date}}</td>
                                <td>{{$Bill->bill}}</td>
                                <td>{{$Bill->balance}}</td>
                                <td>{{$Bill->status}}</td>
                            
                            </tr>
                            <?php $count +=1;?>
                            @endforeach
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