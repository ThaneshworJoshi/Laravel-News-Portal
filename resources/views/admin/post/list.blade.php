@extends('admin.layout.master')
@section('content')


<link rel="stylesheet" href="{{ asset('admin/assets/css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/flag-icon.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/cs-skin-elastic.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
<!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
<link rel="stylesheet" href="{{ asset('admin/assets/scss/style.css') }}">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>


<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>{{ $page_name }}</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Table</a></li>
                    <li class="active">Data table</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

        <div class="col-md-12">
            <div class="card">
              @if ($message = Session::get('success'))
                 <div class="alert alert-success">{{ $message }}</div> 
              @endif
                <div class="card-header">
                    <strong class="card-title">{{ $page_name }}</strong>
                    @ability('Master Admin,Editor,Blogger', 'All,Post Create,Post Add')
                    <a href="{{ url('/back/post/create') }}" class="btn btn-primary pull-right">Create</a>
                    @endability
                  </div>
                <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Total View</th>
                <th>Status</th>
                <th>Hot News</th>
                <th>Options</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $id=>$row)
                <tr>
                  <td style="width:3%;">{{ ++$id }}</td>
                  <td style="width:5%;">
                    @if (file_exists(public_path('/post/').$row->thumb_image))
                        <img src="{{ asset('/post/') }}/{{ $row->thumb_image }}" alt="" class="img img-responsive">
                    @endif
                  </td>
                  <td>{{ $row->title }}</td>
                <td>{{ $row->creator->name}}</td>
                  <td style="width:5%;">{{ $row->view_count }}</td>
                  <td>
                    {{ Form::open(['method'=> 'PUT', 'url'=>['/back/post/status/'.$row->id], 'style'=>'display:inline']) }}
                        @if ($row->status === 1)
                            {{ Form::submit('Unpublish', ['class'=>'btn btn-danger btn-sm']) }}
                        @else
                            {{ Form::submit('Publish', ['class'=>'btn btn-success btn-sm']) }}
                        @endif
                    {{ Form::close() }}

                  </td>
                  <td style="width:5%;">
                    {{ Form::open(['method'=> 'PUT', 'url'=>['/back/post/hot/news/'.$row->id], 'style'=>'display:inline']) }}
                        @if ($row->hot_news === 1)
                            {{ Form::submit('NO', ['class'=>'btn btn-danger btn-sm']) }}
                        @else
                            {{ Form::submit('YES', ['class'=>'btn btn-success btn-sm']) }}
                        @endif
                    {{ Form::close() }}

                  </td>
                  <td>
                    <a href="{{ url('/back/comments/'.$row->id) }}" class="btn btn-info btn-sm">Comments</a>
                    <a href="{{ url('/back/post/edit/'.$row->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    {{ Form::open(['method'=> 'DELETE', 'url'=>['/back/post/delete/'.$row->id], 'style'=>'display:inline']) }}
                    {{ Form::submit('Delete', ['class'=>'btn btn-danger btn-sm']) }}
                    {{ Form::close() }}
                    {{-- <a href="{{ url('/back/post/delete/'.$row->id) }}" class="btn btn-danger">Delete</a> --}}
                  </td>
                </tr>          
              @endforeach
            
            </tbody>
          </table>
                </div>
            </div>
        </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->


<script src="{{ asset('admin/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugins.js') }}"></script>
<script src="{{ asset('admin/assets/js/main.js') }}"></script>


<script src="{{ asset('admin/assets/js/lib/data-table/datatables.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/lib/data-table/jszip.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/lib/data-table/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/lib/data-table/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/lib/data-table/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/lib/data-table/datatables-init.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
    } );
</script>

@endsection