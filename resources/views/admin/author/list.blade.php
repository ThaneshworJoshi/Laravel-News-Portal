@extends('admin.layout.master')
@section('content')

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
                    <a href="{{ url('/back/authors/create') }}" class="btn btn-primary pull-right">Create</a>
                </div>
                <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($author as $id=>$row)
                <tr>
                  <td>{{ ++$id }}</td>
                  <td>{{ $row->name }}</td>
                  <td>{{ $row->email }}</td>
                  <td>
                      @if ($row->roles()->get())
                         <ol style="margin-left:20px;">
                             @foreach ($row->roles()->get() as $role)
                                <li>{{ $role->name }}</li> 
                             @endforeach
                            
                         </ol> 
                      @endif
                  </td>
                  <td>
                    <a href="{{ url('/back/authors/edit/'.$row->id) }}" class="btn btn-primary">Edit</a>
                    {{ Form::open(['method'=> 'DELETE', 'url'=>['/back/authors/delete/'.$row->id], 'style'=>'display:inline']) }}
                    {{ Form::submit('Delete', ['class'=>'btn btn-danger']) }}
                    {{ Form::close() }}
                    {{-- <a href="{{ url('/back/permission/delete/'.$row->id) }}" class="btn btn-danger">Delete</a> --}}
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

@endsection