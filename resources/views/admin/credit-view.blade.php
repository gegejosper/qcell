@extends('layout.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          
          
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
               
                  <h1 class=" text-dark text-center">Quians Cellshop Bill Invoice</h1>
                
                <div class="card-body">
                      
                  <div class="invoice p-3 mb-3">
              <!-- title row -->
             
              <!-- info row -->
              <div class="row invoice-info">
               
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{strtoupper($data_account->lname)}}, {{strtoupper($data_account->fname)}}</strong><br>
                    {{strtoupper($data_account->address)}}<br>
                    {{strtoupper($data_account->contact_number)}}<br>
                  
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Item details:
                  <br>
                  <b>{{$data_credit->product->product_name}} - {{$data_credit->product->model}}</b><br>
                  <b>Amount:</b> {{$data_credit->amount}}<br> 
                  <b>Downpayment:</b> {{$data_credit->downpayment}}<br>
                  <b>Terms:</b> {{$data_credit->term}} <br>
                  <b>Term Amount:</b> {{$data_credit->term_payment}}
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Bill No.</th>
                      <th>Due Date</th>
                      <th>Payment Due</th>
                      <th>Balance</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $count = 1;?>
                      @foreach($data_bill as $Bill)
                      <tr>
                        <td>{{$count}}</td>
                        <td>{{$Bill->due_date}}</td>
                        <td>{{$Bill->bill}}</td>
                        <td>{{$Bill->balance}}</td>
                        <td>{{$Bill->status}}</td>
                      </tr>
                      <?php $count +=1;?>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-lg-12">
                <button class="btn btn-info btn-sm no-print" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                  
                </div>
              </div>
            </div>
                        
                    </div>
                    
                </div>

            </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    
@endsection