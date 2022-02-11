@extends('layouts.app')


@section('content')
<div style="display: flex;align-items: center">
    <h1 class="title" style="margin-right: auto">
        Bird board
    </h1>

    <a href="{{route('posts.create')}}">Create Post <span class="m-4  rounded-circle text-light bg-info" style="font-size: 20px;font-weight: bold;padding: 5px 10px">
+
        </span></a>
</div>
<div class="flex">

</div>

@forelse($posts as $post)
<div class="bg-white mr-4 p-5 m-5 rounded shadow w-1/3" style="height: 200px">
    <a class="font-normal text-xl py-4 " href="{{$post->manage()->path()}}">
        {{ $post->title}}
    </a>
    <div class="text-secondary">
        {{ substr($post->description, 0, 100) }} {{strlen($post->description) > 100? ' ...' : ''}}
    </div>

    <div class="text-danger">
        {{ $post->notes }}
    </div>
</div>
@empty


<li>
    No Posts Found
</li>


@endforelse

</ul>
@endsection
