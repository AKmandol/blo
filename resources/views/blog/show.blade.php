@extends('blog.layout')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Single Item') }}</div>

                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h2>Amlan Kumar Mandol</h2>
                        </div>
                        <div class="text-center my-4 d-grid fs-1">
                            <a class="btn btn-light fs-1">Single Blog Item</a>
                        </div>
                        <div class="mb-2">
                            <a class="btn btn-info" href="{{ route('blog.index') }}"> Back</a>
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
                            <th>Description</th>
                            <th>Comment</th>
                        </tr>

                        
                        <tr>
                            <td>1</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->slug }}</td>
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