@extends("master")

@section("title", "Edit post")

@section("content")

<section class="form-post" id="edit-post">
    <canvas class="sine-background"></canvas>
    <div class="container form-post__container">
        <form action="/post/edit/{{ $post->id }}" method="POST" class="form">
            @csrf

            <h3 class="form__title">Edit post</h3>

            <div class="form__group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ $post->title }}">
                <p class="form__error">
                @error('title')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="description">Description</label>
                <textarea type="text" name="description">{{ $post->title }}</textarea>
                <p class="form__error">
                @error('description')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <button class="form__submit" id="login-submit">Edit</button>
        </form>
    </div>
</section>

@endsection
