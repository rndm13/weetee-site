@extends("master")

@section("title", "Home")

@section("content")

<section class="forum" id="forum">
    <div class="container forum__container">
        <h2 class="forum__title">Forum</h2>

        <p class="forum__create">
            Have a question or would like to request a feature?
            <a href="/post/create">Create your own post</a>
        </p>

        <ul class="posts">
            @foreach ($posts as $post)
                <p class="posts__creation">@date($post->created_at)</p>
                <a class="posts__username">{{ $post->user->name }}</a>
                <a class="posts__title" href="/post/{{$post->id}}">{{ $post->title }}</a>
                <hr class="posts__separator"/>
            @endforeach
        </ul>
    </div>
</section>

@endsection
