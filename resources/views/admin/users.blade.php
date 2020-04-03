@extends('layout.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                        <h3 class="card-title">Add User</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('add_user')}}" method="post">
                            @csrf
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="">Full Name </label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" required>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="">Username </label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="">Email </label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
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
                        <h3 class="card-title">User List</h3>
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
                               
                                <th> Name </th>             
                                <th> Username</th>
                                <th> Email </th>
                                <th> Password</th>
                            </tr>
                            </thead>
                            <tbody class="userresult">
                            @foreach($data_user as $User)
                            <tr>
                                <td>
                                    <a href="#" class="xedit" 
                                            data-pk="{{$User->id}}" 
                                            data-name="name"
                                            >
                                            {{$User->name}}
                                    </a>  
                                </td>
                                <td>
                                    <a href="#" class="xedit" 
                                            data-pk="{{$User->id}}" 
                                            data-name="username"
                                            >
                                        {{$User->username}}    
                                    </a>    
                                </td>
                                <td>
                                    <a href="#" class="xedit" 
                                            data-pk="{{$User->id}}" 
                                            data-name="email"
                                            >
                                            {{$User->email}}   
                                    </a>      
                                </td>
                                <td>
                                    <a href="#" class="xedit" 
                                            data-pk="{{$User->id}}" 
                                            data-name="password"
                                            >
                                            {{wordwrap($User->password, 5)}}    
                                    </a>  
                                </td>
                                
            
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
		$(document).ready(function () {
	            $.ajaxSetup({
	                headers: {
	                    'X-CSRF-TOKEN': '{{csrf_token()}}'
	                }
	            });

	            $('.xedit').editable({
	                url: '{{url("/admin/user/edit")}}',
	                title: 'Update',
	                success: function (response, newValue) {
	                    console.log('Updated', response)
	                }
                });
        })
    </script>

    
@endsection