@extends('layouts.app')


@section('content')

    <form class="box" action="{{route('posts.update', $post->id)}}" method="post">

        <div class="title">{{ __('Edit Post') }}</div>

        @csrf

        @method('PUT')

        @include('posts.form', ['buttonText' => 'Update'])

    </form>


@endsection
