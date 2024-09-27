@extends("master")

@section("title", "Home")

@section("content")

<section class="post">
    <div class="container post__container">
        <div class="post__header">
            <h2 class="post__title"> {{ $post->title }}</h2>

            <div class="post__dates">
                <a class="post__author link" href="/account/{{ $post->user->id }}"> By {{ $post->user->name }} </a>
                <p class="post__date"> Created on @date($post->created_at) </p>
                @if ($post->modified_at)
                    <p class="post__date"> Edited on @date($post->modified_at) </p>
                @endif
            </div>
        </div>

        <div class="post__description">
            {{ $post->description }}
        </div>

        <form class="form" action="/comment/create/{{ $post->id }}" method="POST">
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

        <div class="comments">
            @foreach ($post->comments as $comment)
            <div class="comment">
                <div class="comment__header">
                    <a class="comment__author link" href="/account/{{ $comment->user->id }}"> By {{ $comment->user->name }} </a>
                    <p class="comment__date"> Created on @date($comment->created_at) </p>
                    @if ($comment->modified_at)
                        <p class="comment__date"> Edited on @date($comment->modified_at) </p>
                    @endif
                </div>
                <p class="comment__description"> {{ $comment->description }} </p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
