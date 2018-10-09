@extends('layouts.backend.main')

{{-- Menambahkan judul dengan section --}}
@section('title','My Blog | Blog Index')

@section('content')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Blog Index
            <small>Display All Blog Post</small>
          </h1>
          <ol class="breadcrumb">
            <li>
                <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard
            </li>
            <li>
                <a href="{{ route('blog.index') }}">Blog</a>
            </li>
            <li class="active">
                All Post
            </li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <a href="{{ route('blog.create') }}" class="btn btn-success">Add New</a>
                        </div>
                    </div>
                  <!-- /.box-header -->
                  <div class="box-body ">
                      @if (session('message'))
                          <div class="alert alert-info">
                              {{ session('message') }}
                          </div>
                      @endif
                      @if (!$posts->count())
                        <div class="alert alert-danger">
                          <strong>No Post Found</strong>
                        </div>   
                      @else
                      
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td width="80">Action</td>
                                <td>Title</td>
                                <td width="120">Author</td>
                                <td width="150">Category</td>
                                <td width="175">Date</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>
                                    <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-xs btn-default">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('blog.destroy', $post->id) }}" class="btn btn-xs btn-danger">
                                            <i class="fa fa-times"></i>
                                    </a>
                                </td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->author->name }}</td>
                                <td>{{ $post->category->title }}</td>
                                <td>
                                {{-- Menggunakan model format tanggal --}}
                                <abbr title="{{ $post->dateFormatted(true) }}">{{ $post->dateFormatted() }}</abbr> | 
                                {{-- <span class="label label-success">Published</span> --}}
                                {!! $post->publicationLabel() !!}
                                </td>
                            </tr>    
                            @endforeach
                            
                        </tbody>
                    </table>

                    @endif
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer clearfix">
                      <div class="pull-left">
                        {{-- <ul class="pagination no-margin">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul> --}}

                        {{ $posts->links() }}
                      </div>                      
                  </div>
                  <div class="pull-right">
                      <?php #$postCount = $posts->count(); ?>
                      <small>{{ $postCount }} {{ str_plural('Items', $postCount) }} </small>
                  </div>
                </div>
                <!-- /.box -->
              </div>
            </div>
          <!-- ./row -->
        </section>
        <!-- /.content -->
      </div>
    
@endsection

@section('script')
    <script type="text/javascript">
        $('ul.pagination').addClass('no-margin pagination-sm');
    </script>
@endsection
