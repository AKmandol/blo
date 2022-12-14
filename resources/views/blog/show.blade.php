@extends('blog.layout')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Single Item') }}</div>

                <div class="card-body">
                    <div class="col-lg-12">
                        
                        @if (Auth::check())
                        <div class="text-center">
                            <h3> <span><small class="fs-5 text-success">[ Welcome ]</small></span> <br> <b>{{ Auth::user()->name }}</b> </h3>
                        </div>
                        @endif

                        @if (!Auth::check())
                        <div class="text-center">
                            <h2><b>You are not a Logged in user</b> <br> <span><small class="fs-5 text-danger">[ Resister and Log in ]</small></span> </h2>
                        </div>
                        @endif

                        <div class="text-center my-4 d-grid fs-1">
                            <a class="btn btn-light fs-1">Single Blog Item</a>
                        </div>
                        <div class="mb-2">
                            <a class="btn btn-secondary" href="{{ route('blog.index') }}"> Back</a>
                        </div>
                    </div>


                    @if ($message = Session::get('success'))

                    <div class="alert alert-success">

                        <p>{{ $message }}</p>

                    </div>

                    @endif

                    @if ($message = Session::get('errors'))

                    <div class="alert alert-danger">

                        <p>{{ $message }}</p>

                    </div>

                    @endif




                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Tilte</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Comment</th>
                        </tr>

                        
                        <tr>
                            <td>1</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->slug }}</td>
                            <td> <img src="{{ asset('uploads/'. $blog->image) }}" width="50px" height="50px" alt="no image found"> </td>
                            <td>{{ $blog->description }}</td>
                            <td>{{ $blog->comment }}</td>
                        </tr>

                    </table>

                    <form action="{{ url('/comment', $blog->id) }}" method="POST">
                        @csrf

                    <div class="form-group">
                        <strong>Comment Here:</strong>
                        <textarea class="form-control" style="height:150px" name="comment" placeholder="Add a comment"></textarea>
                    </div>

                    <div class="my-2 text-center">
                        <button type="submit" class="btn btn-success"> Add Comment</button>
                    </div>

                </form>

                </div>
            </div>
        </div>
    </div>
</div>





@endsection