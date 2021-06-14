@extends('admin.layout.master')
@section('content')

<script>
    CKEDITOR.replace( 'description', {
        filebrowserBrowseUrl: '{{ url("/public") }}/laravel-filemanager?type=Files',
        filebrowserImageBrowseUrl: '{{ url("/public") }}/laravel-filemanager?type=Images',
        filebrowserUploadUrl: '{{ url("/public") }}/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}',
        filebrowserImageUploadUrl: '{{ url("/public") }}/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}'
    } );
</script>

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
                    {{ Form::open(['url' => 'back/comment/reply', 'method' => 'post']) }}
                                           
                        <div class="form-group">
                            {{-- <label for="name" class="control-label mb-1">Name</label> --}}
                            {{ Form::label('comment', 'Comment', array('class' => 'control-label mb-1')) }}
                            {{ Form::textarea('comment', null, ['class'=>'form-control', 'id' => 'comment']) }}
                            @error('short_description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00"> --}}
                        </div>
                        {{ Form::hidden('post_id', $id) }}

                        
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