@extends("master")

@php
    $title = "Post '" . $post->title . "'";
@endphp

@section("title", $title)

@section("content")

<section class="post">
    <div class="container">
        <h2 class="post__title"> {{ $post->title }} </h2>

        <div class="post__header">
            <div class="post__dates">
                <a class="post__author link" href="/profile/{{ $post->user->id }}"> By {{ $post->user->name }} </a>
                <p class="post__date"> Created on @date($post->created_at) </p>
                @if ($post->updated_at != $post->created_at)
                    <p class="post__date"> Edited on @date($post->updated_at) </p>
                @endif
            </div>

            <div class="post__categories">
                @foreach ($post->categories as $category)
                    <a href="/forum?category={{$category->id}}" class="category">{{$category->title}}</a>
                @endforeach
            </div>
            @auth
                <div class="post__actions">
                    @if (Auth::user()->can('delete-post', $post))
                    <form action="/post/delete/{{ $post->id }}" method="POST">
                        @csrf
                        <button class="action--delete"> <img src={{ Vite::image("cross.svg") }} /></button>
                    </form>
                    @endif
                    @if (Auth::user()->can('update-post', $post))
                    <a class="action--edit" href="/post/edit/{{ $post->id }}"> <img src={{ Vite::image("edit.svg") }} /> </a>
                    @endif
                </div>
            @endauth
        </div>

        <p class="post__description">
            {!! nl2br(e($post->description)) !!}
        </p>
    </div>
</section>

<section class="comments" data-edit={{ !$errors->isEmpty() ? "true" : "false" }}>
    <h3 class="comments__title"> Comments </h3>

    @auth
    <form class="form comment-form" action="/comment/create/{{ $post->id }}" method="POST">
        @csrf

        <h3 class="form__title"> @lang('forms.leave_comment') </h3>

        <div class="form__group">
            <label for="description">@lang('forms.description')</label>
            <textarea class="form__input" name="description"></textarea>
            <p class="form__error">
            @error('comment')
                {{ $message }}
            @enderror
            </p>
        </div>

        <button class="form__submit">@lang('forms.send')</button>
    </form>
    @endauth

    <div class="container">
        @foreach ($post->comments as $comment)
            <div class="comment" id="comment_{{$comment->id}}">
                <div class="comment__header">
                    <a class="comment__author link" href="/profile/{{ $comment->user->id }}"> By {{ $comment->user->name }} </a>
                    <div class="comment__dates">
                        <p class="comment__date"> Created on @date($comment->created_at) </p>
                        @if ($comment->updated_at != $comment->created_at)
                            <p class="comment__date"> Edited on @date($comment->updated_at) </p>
                        @endif
                    </div>

                    @auth
                        <div class="comment__actions">
                            @if (Auth::user()->can('delete-comment', $comment))
                            <form action="/comment/delete/{{ $comment->id }}" method="POST">
                                @csrf
                                <button class="action--delete"> <img src={{ Vite::image("cross.svg") }} /></button>
                            </form>
                            @endif

                            @if (Auth::user()->can('update-comment', $comment))
                                <button class="action--edit"> <img src={{ Vite::image("edit.svg") }} /> </button>
                            @endif
                        </div>
                    @endauth
                </div>
                <p class="comment__description"> {!! nl2br(e($comment->description)) !!} </p>

                <form class="form_edit" action="/comment/edit/{{ $comment->id }}" method="POST">
                    @csrf

                    <div class="form__group">
                        <label for="description">Description</label>
                        <textarea class="form__input" name="description"> {!! nl2br(e($comment->description)) !!} </textarea>
                        <p class="form__error">
                        @error('comment')
                            {{ $message }}
                        @enderror
                        </p>
                    </div>

                    <button class="form__submit">Send</button>
                </form>
            </div>
        @endforeach

        <div class="pagination">
            <a @class([
                "pagination__button",
                "pagination__button--inactive" => $comments->onFirstPage(),
            ]) href={{ $comments->previousPageUrl() }}>
                <img src={{ Vite::image('previous.svg') }} alt="Previous">
            </a>
            <p class="pagination__page"> {{ $comments->currentPage() }} / {{ $comments->lastPage() }} </p>
            <a @class([
                "pagination__button",
                "pagination__button--inactive" => $comments->onLastPage(),
            ]) href={{ $comments->nextPageUrl() }}>
                <img src={{ Vite::image('next.svg') }} alt="Next">
            </a>
        </div>
    </div>
</section>

@endsection
