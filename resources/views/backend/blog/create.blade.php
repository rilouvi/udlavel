@extends('layouts.backend.main')

{{-- Menambahkan judul dengan section --}}
@section('title','My Blog | Add New Post')

@section('content')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Blog
            <small>Add New Post</small>
          </h1>
          <ol class="breadcrumb">
            <li>
                <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard
            </li>
            <li>
                <a href="{{ route('blog.index') }}">Blog</a>
            </li>
            <li class="active">
                Add New Post
            </li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
            <div class="row">
              {!! Form::model($post,[
                  'method'=>'POST',
                  'route'=>'blog.store',
                  'files'=>TRUE,
                  'id'=>'post-form'
              ]) !!}
              <div class="col-xs-9 mr-0">
                <div class="box">
                  <!-- /.box-header -->
                  <div class="box-body ">
                     {{-- {!! Form::model($post,[
                         'method'=>'POST',
                         'route'=>'blog.store',
                         'files'=>TRUE
                     ]) !!} --}}

                     <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                       {!! Form::label('title') !!}
                       {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('title'))
                          <span class="help-block">{{ $errors->first('title') }}</span>
                        @endif
                      </div>
                     <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                      {!! Form::label('slug') !!}
                      {!! Form::text('slug', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('slug'))
                          <span class="help-block">{{ $errors->first('slug') }}</span>
                        @endif
                    </div>
                    <div class="form-group excerpt {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                      {!! Form::label('excerpt') !!}
                      {!! Form::textarea('excerpt', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('excerpt'))
                          <span class="help-block">{{ $errors->first('excerpt') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                      {!! Form::label('body') !!}
                      {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('body'))
                          <span class="help-block">{{ $errors->first('body') }}</span>
                        @endif
                    </div>
                    {{-- {!! Form::submit('Create Post',['class'=>'btn btn-primary']) !!} --}}

                     {{-- {!! Form::close() !!} --}}
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <div class="col-xs-3">
                <div class="box">
                  <div class="box-header  with-border">
                    <h3 class="box-title">Publish</h3>
                  </div>
                  <div class="box-body">
                    <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
                      {!! Form::label('published_at','Published Date') !!}
                      <div class='input-group date' id='datetimepicker1'>
                        {!! Form::text('published_at', null, ['class'=>'form-control','placeholder'=>'Y-m-d H:i:s']) !!}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                      </div>
                        @if ($errors->has('published_at'))
                          <span class="help-block">{{ $errors->first('published_at') }}</span>
                        @endif
                    </div>
                  </div>
                  <div class="box-footer clearfix">
                    <div class="pull-left">
                      <a id="draft-btn" class="btn btn-default">Save Draft</a>
                    </div>
                    <div class="pull-right">
                      {!! Form::submit('Publish',['class'=>'btn btn-primary']) !!}
                    </div>
                  </div>
                </div>
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Category</h3>
                  </div>
                  <div class="box-body">
                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                      {!! Form::label('category_id','Category') !!}
                      {!! Form::select('category_id', App\Category::pluck('title','id'), null, ['class'=>'form-control','placeholder'=>'Choose Category']) !!}
                        @if ($errors->has('category_id'))
                          <span class="help-block">{{ $errors->first('category_id') }}</span>
                        @endif
                    </div>
                  </div>
                </div>
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Feature Image</h3>
                  </div>
                  <div class="box-body text-center">
                    <div class="form-group {{ $errors->has('images') ? 'has-error' : '' }}">
                      {!! Form::label('images','Feature Image') !!}
                      <br>
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                          <img src="https://via.placeholder.com/200x150&text=No+Image" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>{!! Form::file('images') !!}</span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                      </div>
                      
                        @if ($errors->has('images'))
                          <span class="help-block">{{ $errors->first('images') }}</span>
                        @endif
                    </div>  
                  </div>
                </div>
              </div>
              {!! Form::close() !!}
            </div>
          <!-- ./row -->
        </section>
        <!-- /.content -->
      </div>
    
@endsection

@section('script')
    <script type="text/javascript">
        $('ul.pagination').addClass('no-margin pagination-sm');

        $('#title').on('blur',function() {
          var theTitle = this.value.toLowerCase().trim(),
          slugInput = $('#slug'),
          theSlug = theTitle.replace(/&/g, '-and-')
            .replace(/[^a-z0-9-]+/g, '-')
            .replace(/\-\-+/g, '-')
            .replace(/^-+|-+$/g, '');
          slugInput.val(theSlug);
        });

        var simplemde1 = new SimpleMDE({ element: $("#excerpt")[0] });
        var simplemde2 = new SimpleMDE({ element: $("#body")[0] });

        $('#datetimepicker1').datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss',
          showClear:true 
        });

        $('#draft-btn').click(function(e){
          e.preventDefault();
          // \\ Bikin error karena tidak ada value //\\
          // $('#published_at').val("");
          $('#post-form').submit();
        });
    </script>
@endsection
