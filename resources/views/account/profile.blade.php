@extends("master")

@section("title", "User Profile")

@section("content")

<section class="profile" id="profile" data-edit={{ !$errors->isEmpty() ? "true" : "false" }}>
    <div class="container">
        <div class="profile__header">
            <h3 class="profile__role"> {{ucfirst($user->role)}} </h3>
            <h2 class="profile__name"> {{$user->name}} </h2>
            <div class="profile__date"> Created on @date($user->created_at) </div>

            @auth
            <div class="profile__actions">
                @if (Auth::user()->can('delete-account', $user))
                    <form action="/account/delete/{{ $user->id }}" method="POST">
                        @csrf
                        <button class="action__delete"> <img src={{ Vite::image("cross.svg") }} /></button>
                    </form>
                @endif

                @if (Auth::user()->can('update-account', $user))
                    <button class="action__edit"> <img src={{ Vite::image("edit.svg") }} /></button>
                @endif
            </div>
            @endauth
        </div>

        <p class="profile__section-title"> Posts </p>

        <div class="posts">
            <ul class="posts__list">
	            @foreach ($posts as $post)
	                <a class="posts__username">{{ $post->user->name }}</a>
	                <a class="posts__title" href="/post/view/{{$post->id}}">{{ $post->title }}</a>
                    <div class="posts__categories">
                        @foreach ($post->categories as $category)
                            <a class="category" href="/forum?category={{$category->id}}"> {{ $category->title }}</a>
                        @endforeach
                    </div>
	                <p class="posts__creation">@date($post->created_at)</p>
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

        <!-- Edit form -->

        @can('update-account', $user)

        <form class="form_edit" action="/account/edit/{{$user->id}}" method="POST">
            @csrf

            <div class="form__group">
                <label for="name">Name</label>
                <input name="name" value={{ $user->name }} />
                <p class="form__error">
                @error('name')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="email">Email</label>
                <input name="email" type="email" value={{ $user->email }} />
                <p class="form__error">
                @error('email')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <button class="form__submit">Save</button>
        </form>

        <form class="form_edit" action="/account/edit-password/{{$user->id}}" method="POST">
            @csrf

            <div class="form__group">
                <label for="password">Password</label>
                <input name="password" type="password"/>
                <p class="form__error">
                @error('password')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="confirm_password">Confirm password</label>
                <input name="confirm_password" type="password" />
                <p class="form__error">
                @error('confirm_password')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <button class="form__submit">Save Password</button>
        </form>

        @endcan
    </div>
</section>

@endsection
