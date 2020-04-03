@extends('layout.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Brands</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Brands</li>
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
                        <h3 class="card-title">Add Brand</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('add_brand')}}" method="post">
                            @csrf
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Brand </label>
                                    <input type="text" name="brand_name" id="brand_name" class="form-control" placeholder="Product Name">
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
            <div class="col-lg-3">
                <div class="card">
                  @if(Session::has('success'))
                      <div class="alert alert-success">
                          {{ Session::get('success') }}
                          @php
                          Session::forget('success');
                          @endphp
                      </div>
                  @endif
                    <div class="card-header">
                        <h3 class="card-title">Brand List</h3>
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
                            
                            <tbody>
                            @foreach($data_brand as $Brand)
                            <tr>
                              <td>
                              <a href="#" class="xedit" 
		                    	      data-pk="{{$Brand->id}}"
		                    	      data-name="brand_name">
                                {{$Brand->brand_name}}
                              </a>
                              </td>
                              <td><a href="/brand/view/{{$Brand->id}}" class="btn btn-info btn-sm"><i class="fas fa-search"></a></td>
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
	                url: '{{url("/admin/brands/editbrands")}}',
	                title: 'Update',
	                success: function (response, newValue) {
	                    console.log('Updated', response)
	                }
	            });

	    })
	</script>
@endsection