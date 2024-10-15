@extends('admin.dashboard')

@section('title', 'Posts')

@section('content')
<section class="admin-index">
    <div class="container">
        <h3 class="admin-index__title">Posts</h3>

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
                        <div class="collection-posts__actions">
                            <p class="collection-posts__field--secondary">@date($post->created_at)</p>
                            <form action="/post/delete/{{ $post->id }}" method="POST">
                                @csrf
                                <button class="action--delete"> <img src={{ Vite::image("cross.svg") }} /></button>
                            </form>
                        </div>
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
