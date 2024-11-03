@extends("master")

@section("title", "Forum")

@section("content")

<section class="forum" id="forum">
    <canvas class="sine-background"> </canvas>
    <div class="container">
        <div class="forum__title">
            <h2>@lang('forum.forum')</h2>
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
            <p>@lang('forum.have_a_question')</p>
            <a href="/post/create" class="link"> @lang('forum.create_your_own_post') </a>
        </div>

        <div class="collection-posts">
            <ul class="collection-posts__list">
                @foreach ($posts as $post)
                    <div class="collection-posts__list-item">
                        <a class="collection-posts__field link" href="profile/{{$post->user->id}}">{{ $post->user->name }}</a>
	                    <a class="collection-posts__field link" href="/post/view/{{$post->id}}">{{ $post->title }}</a>
	                    <div class="collection-posts__field-pills">
	                        @foreach ($post->categories as $category)
	                            <a class="category" href="/forum?category={{$category->id}}"> {{ $category->title }}</a>
	                        @endforeach
	                    </div>
	                    <p class="collection-posts__field--secondary">@date($post->created_at)</p>
                    </div>
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
