@extends('layout.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Account</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Account</li>
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
                        <h3 class="card-title">Account Details</h3>
                    </div>
                    <div class="card-body">
                    <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{asset('img/profile.png')}}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$data_account->lname}}, {{$data_account->fname}}</h3>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Address</b> <a class="float-right">{{$data_account->address}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Contact Number</b> <a class="float-right">{{$data_account->contact_number}}</a>
                  </li>
    
                </ul>
              </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Payment History</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th>Date</th>    
                                <th>Bill No.</th>
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
                        <a href="/admin/account/{{$data_account->id}}" class="btn btn-default btn-sm no-print">
                            <i class="fas fa-reply"> Back</i>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
@endsection