@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
          <div class="card-header">
              <strong class="card-title">{{ $page_name }}</strong>
          </div>
          <div class="card-body">
            <!-- Credit Card -->
            <div id="pay-invoice">
                <div class="card-body">
                   
                    <hr>
                    {{-- <form action="" method="post" novalidate="novalidate"> --}}
                    {{ Form::open(['url' =>'back/settings/update', 'method' => 'put', 'enctype'=>'multipart/form-data']) }}
                     
                        <div class="form-group">
                            {{-- <label for="name" class="control-label mb-1">Name</label> --}}
                            {{ Form::label('name', 'System Name', array('class' => 'control-label mb-1')) }}
                            {{ Form::text('name', $system_name, ['class'=>'form-control', 'id' => 'name']) }}
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00"> --}}
                        </div>

                        <div class="form-group">
                            @if (file_exists(public_path('/others/').$favicon->value))
                                <img src="{{ asset('/others/') }}/{{$favicon->value }}" alt="" class="img img-responsive" style="width:70px">
                            @endif
                        </div>
                        
                        <div class="form-group">
                            {{-- <label for="name" class="control-label mb-1">Name</label> --}}
                            {{ Form::label('favicon', 'Favicon', array('class' => 'control-label mb-1')) }}
                            {{ Form::file('favicon', ['class'=>'form-control', 'id' => 'image']) }}
                            {{-- <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00"> --}}
                        </div>

                        <div class="form-group">
                            @if (file_exists(public_path('/others/').$front_logo->value))
                                <img src="{{ asset('/others/') }}/{{$front_logo->value }}" alt="" class="img img-responsive" style="width:70px">
                            @endif
                        </div>
                        <div class="form-group">
                            {{-- <label for="name" class="control-label mb-1">Name</label> --}}
                            {{ Form::label('front_logo', 'Front Logo', array('class' => 'control-label mb-1')) }}
                            {{ Form::file('front_logo', ['class'=>'form-control', 'id' => 'front_logo']) }}
                            {{-- <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00"> --}}
                        </div>

                        <div class="form-group">
                            @if (file_exists(public_path('/others/').$admin_logo->value))
                                <img src="{{ asset('/others/') }}/{{$admin_logo->value }}" alt="" class="img img-responsive" style="width:70px">
                            @endif
                        </div>

                        <div class="form-group">
                            {{-- <label for="name" class="control-label mb-1">Name</label> --}}
                            {{ Form::label('admin_logo', 'Admin Logo', array('class' => 'control-label mb-1')) }}
                            {{ Form::file('admin_logo', ['class'=>'form-control', 'id' => 'admin_logo']) }}
                            {{-- <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00"> --}}
                        </div>

                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-lock fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">Submit</span>
                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                            </button>
                        </div>
                    {{-- </form> --}}
                    {!! Form::close() !!}
                </div>
            </div>

          </div>
      </div> <!-- .card -->

    </div><!--/.col-->

  </div>

@endsection 