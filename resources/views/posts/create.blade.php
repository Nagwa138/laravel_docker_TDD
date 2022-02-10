@extends('layouts.app')


@section('content')

                    <form class="box" action="{{route('posts.store')}}" method="post">

                        <div class="title">{{ __('Add Post') }}</div>

                        @csrf

                        @include('posts.form', [ 'post' => New \App\Models\Post() ,'buttonText' => 'Save'])
                    </form>


@endsection
