@extends('layouts.app')


@section('content')

                    <form class="box" action="{{route('posts.store')}}" method="post">
                        @csrf

                        <div class="title">{{ __('Add Post') }}</div>

                        <div class="field">
                            <label class="label" for="title">Title</label>
                            <div class="control">
                                <input class="input" type="text"
                                       name="title" id="title"
                                       placeholder="China Trip">
{{--                                <small id="titleHelp" class="form-text text-muted">We'll never share your title with anyone else.</small>--}}
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="description">Description</label>
                            <div class="control">
                                <textarea rows="5" class="textarea"
                                          name="description" id="description" placeholder="It was a ver great trip !!!!"
                                          aria-describedby="descriptionHelp"></textarea>
{{--                                <small id="descriptionHelp" class="form-text text-muted">We'll never share your description with anyone else.</small>--}}
                            </div>
                        </div>

                        <button class="button is-primary">Save</button>
                    </form>


@endsection
