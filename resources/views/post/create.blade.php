@extends("master")

@section("title", "Create new post")

@section("content")

<section class="form-post" id="create-documentation">
    <canvas class="sine-background"></canvas>
    <div class="container">
        <form action="/post/create" method="POST" class="form">
            @csrf

            <h3 class="form__title">@lang('forms.create_post')</h3>

            <div class="form__group">
                <label for="title">@lang('forms.title')</label>
                <input class="form__input" type="text" name="title">
                <p class="form__error">
                @error('title')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="description">@lang('forms.description')</label>
                <textarea class="form__input" type="text" name="description"></textarea>
                <p class="form__error">
                @error('description')
                    {{ $message }}
                @enderror
                </p>
            </div>

            @if ($categories !== null && count($categories) !== 0)
            <div class="form__group">
                <label for="categories[]">@lang('forms.categories')</label>
                <select class="form__select2" name="categories[]" multiple="multiple">
                    @foreach ($categories as $category)
                        <option value={{$category->id}}> {{$category->title}} </option>
                    @endforeach
                </select>
                <p class="form__error">
                @error('categories[]')
                    {{ $message }}
                @enderror
                </p>
            </div>
            @endif

            <button class="form__submit" id="post-create-submit">@lang('forms.publish')</button>
        </form>
    </div>
</section>

@endsection
