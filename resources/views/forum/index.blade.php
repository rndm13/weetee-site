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
            <li class="post">
                <div class="post__creation">{{$post.user.created_at}}</div>
                <div class="post__title">{{$post.title}}</div>
                <div class="post__username">{{$post.user.name}}</div>
            </li>
            @endforeach
        </ul>
    </div>
</section>

@endsection
