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
                <input class="form__input" type="text" name="title" value="{{ $post->title }}">
                <p class="form__error">
                @error('title')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="description">Description</label>
                <textarea class="form__input" type="text" name="description">{{ $post->description }}</textarea>
                <p class="form__error">
                @error('description')
                    {{ $message }}
                @enderror
                </p>
            </div>

            @if ($categories !== null && count($categories) !== 0)
            <div class="form__group">
                <label for="categories[]">Categories</label>

                @php
                foreach ($categories as $category) {
                    $category->selected = false;
                    foreach ($post->categories as $post_category) {
                        if ($post_category->id == $category->id) {
                            $category->selected = true;
                            break;
                        }
                    }
                }
                @endphp

                <select class="form__select2" name="categories[]" multiple="multiple">
                    @foreach ($categories as $category)
                        @if ($category->selected)
                            <option value={{$category->id}} selected="selected">{{$category->title}}</option>
                        @else
                            <option value={{$category->id}}>{{$category->title}}</option>
                        @endif
                    @endforeach
                </select>
                <p class="form__error">
                @error('categories[]')
                    {{ $message }}
                @enderror
                </p>
            </div>
            @endif

            <button class="form__submit" id="post-edit-submit">Edit</button>
        </form>
    </div>
</section>

@endsection
