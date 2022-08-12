@extends('blog.layout')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

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

                       

                        <div class="mb-5">
                            <a class="btn btn-success float-start mb-3" href="{{ route('blog.create') }}">Create Blog</a>
                        
                            <a class="btn btn-dark float-end mb-3 text-white"  href="{{ url('/userBlog') }}">Blog You Added</a>
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
                            <th>Image</th>
                            <th>Description</th>
                            <th width="280px">Action</th>
                        </tr>

                        @foreach ($blogs as $blog)

                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->slug }}</td>
                            <td> <img src="{{ asset('uploads/'. $blog->image) }}" width="50px" height="50px" alt="no image found"> </td>
                            <td>{{ $blog->description }}</td>
                            <td>

                                <form action="{{ route('blog.destroy',$blog->id) }}" method="POST">

                                    <a class="btn btn-success" href="{{ route('blog.create') }}">Create</a>
                                    <a class="btn btn-secondary" href="{{ route('blog.show', $blog->id) }}">View</a>
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