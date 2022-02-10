@extends('layouts.app')


@section('content')

    <div style="display: flex;justify-content: space-between;align-items: center">

        <h1 class="title" style="margin-right: auto">
            Post
        </h1>

        <a class="button" href="{{$post->path() . '/edit'}}">
            Edit Post
        </a>
    </div>


   <div class="columns">

       <div class="column">
           Title : {{$post->title ?? 'not found'}}
       </div>

       <div class="column">
           Description : {{$post->description ?? 'not found'}}
       </div>

       <div class="column">
           Notes : {{$post->notes ?? 'not found'}}
       </div>



   </div>

        <li>
                <ol class="container">
                    @forelse($post->points as $point)
                        <li>
                            <form
                                  action="{{ url($post->path(). '/points/'. $point->id) }}"
                                  method="post">

                                @csrf
                                @method('PATCH')

                                <div class="flex m-4"
                                     style="display: flex;
                                     justify-content: space-between;align-items: center;">

                                    <input type="text" class="input is-primary" name="body"
                                           value="{{$point->body}}">

                                    <input type="hidden"
                                           name="point_id"
                                           value="{{$point->id}}">

                                    <label class="checkbox m-2">
                                        <input type="checkbox"
                                               name="completed"
                                               @if($point->completed) checked @endif
                                               onchange="this.form.submit()">
                                    </label>
                                </div>

                            </form>

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
