@extends("master")

@section("title", "Forum")

@section("content")

<section class="forum" id="forum">
    <canvas class="sine-background"> </canvas>
    <div class="container">
        <div class="forum__title">
            <h2>Forum</h2>
        </div>
        <div class="forum__header">

            <form action="/forum" class="forum__form">
                <div class="form__pills">
                    <label class="form__pill" for="category_0">
                        <input type="radio" class="pill" name="category" id="category_0" value="0" @checked($filter['category'] === 0)>
                        Any
                    </label>
                    @foreach ($categories as $category)
                    <label class="form__pill" for="category_{{$category->id}}">
                        <input type="radio" class="pill" name="category" id="category_{{$category->id}}" value="{{$category->id}}" @checked($filter['category'] === $category->id)>
                        {{$category->title}}
                    </label>
                    @endforeach
                </div>

                <div class="form__group">
                    <input class="form__input" type="text" name="search" value={{$filter['search']}}>
                    <button class="forum__search">
                        <img src={{ Vite::image("search.svg") }} alt="Search">
                    </button>
                </div>
            </form>
        </div>

        <div class="forum__create">
            <p>Have a question or would like to request a feature?</p>
            <a href="/post/create" class="link"> Create your own post </a>
        </div>

        <div class="collection-posts">
            <ul class="collection-posts__list">
                @foreach ($posts as $post)
                    <a class="collection-posts__username link" href="profile/{{$post->user->id}}">{{ $post->user->name }}</a>
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
