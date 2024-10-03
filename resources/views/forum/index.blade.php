@extends("master")

@section("title", "Home")

@section("content")

<section class="forum" id="forum">
    <div class="container">
        <h2 class="forum__title">Forum</h2>

        <div class="forum__create">
            <p>Have a question or would like to request a feature?</p>
            <a href="/post/create" class="link"> Create your own post </a>
        </div>

        <ul class="posts">
            @foreach ($posts as $post)
                <a class="posts__title" href="/post/view/{{$post->id}}">{{ $post->title }}</a>
                <p class="posts__creation">@date($post->created_at)</p>
                <a class="posts__username">{{ $post->user->name }}</a>
                <hr class="posts__separator"/>
            @endforeach
        </ul>
    </div>
</section>

@endsection
