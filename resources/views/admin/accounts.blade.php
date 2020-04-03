@extends('layout.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Accounts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Accounts</li>
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
            <div class="card col-lg-12">
                <div class="card-header">
                    <h3 class="card-title">Add Patient</h3>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <div class="control-group">
                                <div class="controls">             
                                    <div class="row-">
                                        <div class="col-lg-6">
                                            <div class="input-prepend input-group">
                                                <input type="text" style="width: 200px" name="searchaccount" id="searchaccount" class="form-control" placeholder="Search account">
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>     
                        </div>
                        <div class="card-body table-responsive">
                        
                            <table class="table table-striped" id="table">
                                <thead>
                                <tr>
                                    <th> Account #</th>
                                    <th> Account Name</th>             
                                    <th> Address</th>
                                    <th> Contact #</th>
                                    <th> </th>
                                </tr>
                                </thead>
                                <tbody class="accountresult">
                                @foreach($data_account as $Account)
                                <tr class="item{{$Account->id}}">
                                    <td><a href="/admin/account/{{$Account->id}}">{{$Account->id}}</a></td>
                                    <td><a href="/admin/account/{{$Account->id}}">{{strtoupper($Account->lname)}}, {{strtoupper($Account->fname)}} {{strtoupper($Account->mname)}}</a></td>
                                    <td>{{$Account->address}}</td>
                                    <td>{{$Account->contact_number}}</td>
                                    <td class='td-actions'>
                                        <a href="/admin/account/{{$Account->id}}" class='btn btn-info btn-small'><i class="fa fa-search"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$data_account->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
<script type="text/javascript">
$('#searchaccount').on('keyup',function(){
  $value=$(this).val();
  $.ajax({
    type : 'get',
    url : '{{URL::to('admin/account_search')}}',
    data:{'search':$value},
    success:function(data){
      $('.accountresult').html(data);
    } 
  });
})
</script> 

@endsection