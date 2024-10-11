@extends("master")

@section("title", "Home")

@section("content")

<section class="forum" id="forum">
    <canvas class="sine-background"> </canvas>
    <div class="container">
        <h2 class="forum__title">Forum</h2>

        <div class="forum__create">
            <p>Have a question or would like to request a feature?</p>
            <a href="/post/create" class="link"> Create your own post </a>
        </div>

        <div class="collection-posts">
            <ul class="collection-posts__list">
                @foreach ($posts as $post)
                    <a class="collection-posts__username">{{ $post->user->name }}</a>
                    <a class="collection-posts__title" href="/post/view/{{$post->id}}">{{ $post->title }}</a>
                    <div class="collection-posts__categories">
                        @foreach ($post->categories as $category)
                            <a class="category" href="/forum?category={{$category->id}}"> {{ $category->title }}</a>
                        @endforeach
                    </div>
                    <p class="collection-posts__creation">@date($post->created_at)</p>
                    <hr class="collection-posts__separator"/>
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
    </div>
</section>

@endsection
