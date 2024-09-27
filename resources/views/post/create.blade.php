@extends("master")

@section("title", "Home")

@section("content")

<section class="create-post" id="create-post">
    <canvas class="sine-background"></canvas>
    <div class="container create-post__container">
        <form action="/post/create" method="POST" class="form">
            @csrf

            <h3 class="form__title">Create post</h3>

            <div class="form__group">
                <label for="title">Title</label>
                <input type="text" name="title">
                <p class="form__error">
                @error('title')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="description">Description</label>
                <textarea type="text" name="description"></textarea>
                <p class="form__error">
                @error('description')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <button class="form__submit" id="login-submit">Publish!</button>
        </form>
    </div>
</section>

@endsection
