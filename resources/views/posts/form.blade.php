

<div class="field">
    <label class="label" for="title">Title</label>
    <div class="control">
        <input class="input" type="text"
               name="title" id="title"
               value="{{$post->title}}"
               placeholder="China Trip">
        {{--                                <small id="titleHelp" class="form-text text-muted">We'll never share your title with anyone else.</small>--}}
    </div>
</div>

<div class="field">
    <label class="label" for="description">Description</label>
    <div class="control">
        <textarea rows="1" class="textarea"
                  name="description" id="description"
                  placeholder="It was a ver great trip !!!!"
                  aria-describedby="descriptionHelp">{{$post->description}}</textarea>
    </div>
</div>

<div class="field">
    <label class="label"
           for="notes">Notes</label>
    <div class="control">
        <textarea rows="5" class="textarea"
                  name="notes" id="notes" placeholder="Note : food finished"
                  aria-describedby="notesHelp">{{$post->notes}}</textarea>
    </div>
</div>

<button class="button is-primary">{{$buttonText}}</button>

@if($errors->any())
    <div class="field">
        @foreach($errors->all() as $error)
            <small class="form-text text-muted">
                {{$error}}
            </small>
        @endforeach
    </div>
@endif
