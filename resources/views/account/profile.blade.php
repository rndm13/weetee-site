@extends("master")

@section("title", "User Profile")

@section("content")

<section class="profile" id="profile">
    <div class="container">
        <div class="profile__header">
            <h3 class="profile__role"> TBA </h3>
            <h2 class="profile__name"> {{$user->name}} </h2>
            <div class="profile__date"> Created on @date($user->created_at) </div>
        </div>

        <p class="profile__section-title"> Posts </p>

        <ul class="posts">
            @foreach ($user->posts as $post)
                <a class="posts__title" href="/post/view/{{$post->id}}">{{ $post->title }}</a>
                <p class="posts__creation">@date($post->created_at)</p>
                <a class="posts__username">{{ $post->user->name }}</a>
                <hr class="posts__separator"/>
            @endforeach
        </ul>

        <p class="profile__section-title"> Comments </p>

        <ul class="posts">
            @foreach ($user->comments as $comment)
                <a class="posts__title" href="/post/view/{{$comment->post_id}}#comment_{{$comment->id}}">{{ $comment->description }}</a>
                <p class="posts__creation">@date($comment->created_at)</p>
                <a class="posts__username">{{ $comment->user->name }}</a>
                <hr class="posts__separator"/>
            @endforeach
        </ul>

        @auth
        <form>
        </form>
        @endauth
    </div>
</section>

@endsection
