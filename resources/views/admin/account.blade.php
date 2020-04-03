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
                        <h3 class="card-title">Credit Detail</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                            <tr>
                                <th> Item </th>             
                                <th> Amount</th>
                                <th> Downpayment</th>
                                <th> Balance </th>
                                <th> Term </th>
                                <th> Term Payment</th>
                                <th> Status</th>
                            </tr>
                            </thead>
                            <tbody class="productresult">
                                <tr>
                                    <td>{{$data_account->credit->product->product_name}}</td>
                                    <td>{{$data_account->credit->amount}}</td>
                                    <td>{{$data_account->credit->downpayment}}</td>
                                    <td>{{$data_account->credit->balance}}</td>
                                    <td>{{$data_account->credit->term}}</td>
                                    <td>{{$data_account->credit->term_payment}}</td>
                                    <td>{{$data_account->credit->status}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                            <th>Bill No.</th>
                            <th>Due Date</th>
                            <th>Payment Due</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1;?>
                            @foreach($data_account->bill as $Bill)
                            @if($Bill->status != 'paid')
                            <tr>
                                <td>{{$Bill->id}}</td>
                                <td>{{$Bill->due_date}}</td>
                                <td>{{$Bill->bill}}</td>
                                <td>{{$Bill->balance}}</td>
                                <td>{{$Bill->status}}</td>
                                <td>
                                    
                                    <a href="javascript:;" class="btn btn-success btn-sm no-print paymentmodal"
                                        data-billid="{{$Bill->id}}"
                                        data-acountid="{{$Bill->account_id}}"
                                        data-creditid="{{$Bill->credit->id}}"  
                                        data-amountopay="{{$Bill->bill}}"  
                                        data-balance="{{$Bill->balance}}"    
                                    >
                                    <i class="fas fa-money-bill-alt"> Pay</i>
                                    </a>  
                                    
                              </td>
                            </tr>
                            @endif 
                            <?php $count +=1;?>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="/admin/account/bill/history/{{$data_account->id}}" class="btn btn-info btn-sm no-print">
                            <i class="fas fa-folder"> View Bill History</i>
                        </a>  
                    </div>
                    <div class="col-lg-12">
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
                            <a href="/admin/account/payment/history/{{$data_account->id}}" class="btn btn-info btn-sm no-print">
                                <i class="fas fa-folder"> Payment History</i>
                            </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <div class="modal fade" id="modalpayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Pay Bill</h4>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">

                <div class="col-lg-4">
                    <div class="form-group">
                    <label for="">Bill Amount</label>
                        @csrf
                        <input type="text" name="amount_to_pay" id="amount_to_pay" class="form-control" readonly>
                        <input type="hidden" name="bill_id" id="bill_id" class="form-control">
                        <input type="hidden" name="credit_id" id="credit_id" class="form-control">
                        <input type="hidden" name="account_id" id="account_id" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                    <label for="">Balance </label>
                        <input type="text" name="balance" id="balance" class="form-control"  readonly>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                    <label for="">Amount</label>
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="0.00" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-success processpayment">Process</button>
            </div>
        </div>
        </div>
    </div>
    </div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/creditscript.js') }}"></script>
@endsection