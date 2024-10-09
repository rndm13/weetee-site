@extends("master")

@section("title", "User Profile")

@section("content")

<section class="profile" id="profile">
    <div class="container">
        <div class="profile__header">
            <h3 class="profile__role"> {{ucfirst($user->role)}} </h3>
            <h2 class="profile__name"> {{$user->name}} </h2>
            <div class="profile__date"> Created on @date($user->created_at) </div>
        </div>

        <p class="profile__section-title"> Posts </p>

        <div class="posts">
            <ul class="posts__list">
	            @foreach ($posts as $post)
	                <a class="posts__title" href="/post/view/{{$post->id}}">{{ $post->title }}</a>
	                <p class="posts__creation">@date($post->created_at)</p>
	                <a class="posts__username">{{ $post->user->name }}</a>
	                <hr class="posts__separator"/>
	            @endforeach
	        </ul>

            <div class="pagination">
                <a @class([
                    "pagination__button",
                    "pagination__button--inactive" => $posts->onFirstPage(),
                ]) href={{ $posts->previousPageUrl() }}>
                    <img src={{ Vite::image('previous.svg') }} alt="Previous">
                </a>
                <p class="pagination__page"> {{ $posts->currentPage() }} / {{ $posts->lastPage() }} </p>
                <a @class([
                    "pagination__button",
                    "pagination__button--inactive" => $posts->onLastPage(),
                ]) href={{ $posts->nextPageUrl() }}>
                    <img src={{ Vite::image('next.svg') }} alt="Next">
                </a>
            </div>
        </div>

        <p class="profile__section-title"> Comments </p>

        <div class="posts">
            <ul class="posts__list">
	            @foreach ($comments as $comment)
	                <a class="posts__title" href="/post/view/{{$comment->post_id}}#comment_{{$comment->id}}">{{ $comment->description }}</a>
	                <p class="posts__creation">@date($comment->created_at)</p>
	                <a class="posts__username">{{ $comment->user->name }}</a>
	                <hr class="posts__separator"/>
	            @endforeach
	        </ul>

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

        @auth
        <form>
        </form>
        @endauth
    </div>
</section>

@endsection
