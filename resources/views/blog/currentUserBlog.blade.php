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

                        <div class="text-center my-4 d-grid">
                            <a class="btn btn-light fs-1 fw-bold text-primary ">Blog You Created</a>
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



                    @if (!Auth::check())
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-center text-danger">
                                <b>
                                    <span class="fs-2">Sorry ! You are not an Admin User.</span> <br>
                                    <small class="text-danger">
                                        [ Log in or Resister as User and <b>CREATE</b> some Blog data ] <br> <b class="text-dark">Then You will see your data over here...</b>
                                    </small> 
                                </b>
                            </th>
                        </tr>
                    </table>
                    @endif

                    @if (Auth::check())
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Admin Name</th>
                            <th>Blog Title</th>
                            <th>Blog Slug</th>
                            <th>Blog Image</th>
                            <th>Blog Description</th>
                            <th>Blog Comment</th>
                        </tr>
                        
                        
                        
                        @foreach ($users->blogs as $blog )
                        <tr>

                            <td>{{ ++$i }}</td>
                            <td>{{$users->name}}</td>
                            <td>{{$blog->title}}</td>
                            <td>{{$blog->slug}}</td>
                            <td> <img src="{{ asset('uploads/'. $blog->image) }}" width="50px" height="50px" alt="no image found"> </td>
                            <td>{{ $blog->description }}</td>
                            <td>{{ $blog->comment }}</td>
                            
                        </tr>
                        @endforeach

                    </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>





@endsection