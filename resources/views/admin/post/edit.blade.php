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
                    {{ Form::model($post, ['route' => ['post-update', $post->id], 'method' => 'put', 'enctype'=>'multipart/form-data']) }}
                     
                        <div class="form-group">
                            {{-- <label for="name" class="control-label mb-1">Name</label> --}}
                            {{ Form::label('title', 'Title', array('class' => 'control-label mb-1')) }}
                            {{ Form::text('title', null, ['class'=>'form-control', 'id' => 'title']) }}
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00"> --}}
                        </div>


                        <div class="form-group">
                        
                            {{ Form::label('category', 'Category', array('class' => 'control-label mb-1')) }}
                            {{ Form::select('category_id', $categories, $post->category_id, ['class'=>'form-control', 'id' => 'category', 'placeholder'=>'Select Category'] ) }}
    
                            @error('category')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{-- <label for="name" class="control-label mb-1">Name</label> --}}
                            {{ Form::label('short_description', 'Short_description', array('class' => 'control-label mb-1')) }}
                            {{ Form::textarea('short_description', null, ['class'=>'form-control', 'id' => 'short_description']) }}
                            @error('short_description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00"> --}}
                        </div>

                        <div class="form-group">
                            {{-- <label for="name" class="control-label mb-1">Name</label> --}}
                            {{ Form::label('description', 'Description', array('class' => 'control-label mb-1')) }}
                            {{ Form::textarea('description', null, ['class'=>'form-control,my-editor', 'id' => 'description']) }}
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00"> --}}
                        </div>
                        
                        <div class="form-group">
                            {{-- <label for="name" class="control-label mb-1">Name</label> --}}
                            {{ Form::label('image', 'Image', array('class' => 'control-label mb-1')) }}
                            {{ Form::file('image', ['class'=>'form-control', 'id' => 'image']) }}
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
 
    {{-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckeditor/adapters/jquery.js') }}"></script>
  --}}

  

    
@endsection