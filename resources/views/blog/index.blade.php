@extends('blog.layout')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h2>Amlan Kumar Mandol</h2>
                        </div>
                        <div class="pull-right my-2">
                            <a class="btn btn-success" href="{{ route('blog.create') }}">Create Blog</a>
                        </div>
                    </div>


                    @if ($message = Session::get('success'))

                    <div class="alert alert-success">

                        <p>{{ $message }}</p>

                    </div>

                    @endif



                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Tilte</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th width="280px">Action</th>
                        </tr>

                        @foreach ($blogs as $blog)

                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->slug }}</td>
                            <td>{{ $blog->description }}</td>
                            <td>

                                <form action="{{ route('blog.destroy',$blog->id) }}" method="POST">

                                    <a class="btn btn-success" href="{{ route('blog.create') }}">Create</a>
                                    <a class="btn btn-info" href="{{ route('blog.show', $blog->id) }}">View</a>
                                    <a class="btn btn-primary" href="{{ route('blog.edit', $blog->id) }}" >Edit</a>

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    {!! $blogs->links() !!}

                </div>
            </div>
        </div>
    </div>
</div>





@endsection