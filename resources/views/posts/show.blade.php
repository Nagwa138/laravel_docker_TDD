@extends('layouts.app')


@section('content')
    <h1 class="title" style="margin-right: auto">
        Post
    </h1>
        <ul>

            <li>
            Title : {{$post->title ?? 'not found'}}
            </li>

            <li>
                Description : {{$post->description ?? 'not found'}}
            </li>
            <li>
                <ol class="container">
                    @forelse($post->points as $point)
                        <li>
                            {{$point->body}}
                        </li>
                    @empty

                    @endforelse
                </ol>

                <div class="card">
                    <form class="w-full"
                          action="{{ url($post->path() . '/points') }}"
                          method="post">

                        @csrf
                        <input type="text"
                               placeholder="Add a New Task .."
                               name="body"
                               class="input">

                    </form>
                </div>
            </li>

        </ul>
@endsection
