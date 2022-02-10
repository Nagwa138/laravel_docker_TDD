@extends('layouts.app')


@section('content')

    <form class="box" action="{{route('posts.store')}}" method="post">

        <div class="title">{{ __('Edit Post') }}</div>

        @csrf

        @include('posts.form', ['buttonText' => 'Update'])

    </form>


@endsection
