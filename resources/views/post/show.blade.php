@extends("master")

@section("title", "Home")

@section("content")

<section class="post">
    <div class="container">
        <h2 class="post__title"> {{ $post->title }}</h2>

        <div class="post__header">

            <div class="post__dates">
                <a class="post__author link" href="/account/{{ $post->user->id }}"> By {{ $post->user->name }} </a>
                <p class="post__date"> Created on @date($post->created_at) </p>
                @if ($post->updated_at != null)
                    <p class="post__date"> Edited on @date($post->updated_at) </p>
                @endif
            </div>
            @auth
                @if (Auth::user()->id == $post->user->id)
                <div class="post__actions">
                    <form action="/post/delete/{{ $post->id }}" method="POST">
                        @csrf
                        <button class="post__delete"> <img src={{ Vite::image("cross.svg") }} /></button>
                    </form>
                    <a class="post__edit" href="/post/edit/{{ $post->id }}"> <img src={{ Vite::image("edit.svg") }} /> </a>
                </div>
                @endif
            @endauth
        </div>

        <p class="post__description">
            {!! nl2br(e($post->description)) !!}
        </p>

        @auth
        <form class="form comment-form" action="/comment/create/{{ $post->id }}" method="POST">
            @csrf

            <h3 class="form__title"> Leave your own comment!</h3>

            <div class="form__group">
                <label for="description">Description</label>
                <textarea name="description"></textarea>
                <p class="form__error">
                @error('comment')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <button class="form__submit">Send</button>
        </form>
        @endauth

        <div class="comments">
            @foreach ($post->comments as $comment)
            <div class="comment">
                <div class="comment__header">
                    <a class="comment__author link" href="/account/{{ $comment->user->id }}"> By {{ $comment->user->name }} </a>
                    <p class="comment__date"> Created on @date($comment->created_at) </p>
                    @if ($comment->updated_at)
                        <p class="comment__date"> Edited on @date($comment->updated_at) </p>
                    @endif
                </div>
                <p class="comment__description"> {!! nl2br(e($comment->description)) !!} </p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
