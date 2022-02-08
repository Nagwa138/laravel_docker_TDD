@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="">
                    <div class="">{{ __('Add Post') }}</div>

                    <div class="card-body">
    <form action="{{route('posts.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Title </label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp">
            <small id="titleHelp" class="form-text text-muted">We'll never share your title with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="description">Description </label>
            <textarea rows="5" class="form-control"
                      name="description" id="description"
                      aria-describedby="descriptionHelp">
            </textarea>
            <small id="titleHelp" class="form-text text-muted">We'll never share your description with anyone else.</small>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
