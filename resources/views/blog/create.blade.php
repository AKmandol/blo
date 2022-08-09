@extends('blog.layout')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Add') }}</div>

                <div class="card-body">

                        <div class="col-lg-12 my-2">
                            <div class="text-center">
                                <h2>Add New Blog Item</h2>
                            </div>

                            <div class="pull-right">
                                <a class="btn btn-info" href="{{ route('blog.index') }}"> Back</a>
                            </div>
                        </div>




                    @if ($errors->any())

                    <div class="alert alert-danger">
                        <strong>!</strong> Something went wrong.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach

                        </ul>
                    </div>

                    @endif



                    <form action="{{ route('blog.store') }}" method="POST">
                        @csrf
                        <div class="md-col-8">

                                <div class="form-group">
                                    <strong>Title:</strong>
                                    <input type="text" name="title" class="form-control" placeholder="Title">
                                </div>

                                <div class="form-group">
                                    <strong>Slug:</strong>
                                    <input type="text" name="slug" class="form-control" placeholder="Slug">
                                </div>
                            
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    <textarea class="form-control" style="height:150px" name="description"placeholder="Description"></textarea>
                                </div>

                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>





@endsection