@extends("admin.dashboard")

@section("title", "Edit documentation page")

@section("content")

<section class="form-post" id="create-post">
    <div class="container">
        <form action="/admin/documentation/save" method="POST" class="form">
            @csrf
            <input type="number" class="form__input--hidden" name="id" value="{{ $doc->id }}">

            <h3 class="form__title">Edit documentation page</h3>

            <div class="form__group">
                <label for="title">Title</label>
                <input class="form__input" type="text" name="title" value="{{$doc->title}}">
                <p class="form__error">
                @error('title')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="slug">Slug</label>
                <input class="form__input" type="text" name="slug" value="{{$doc->slug}}">
                <p class="form__error">
                @error('slug')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="order">Order</label>
                <input class="form__input" type="number" name="order" value="{{$doc->order}}"/>
                <p class="form__error">
                @error('order')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="description">Description (accepts markdown)</label>
                <textarea class="form__input form__input--mono" type="text" name="description">{{ $doc->description }}</textarea>
                <p class="form__error">
                @error('description')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <button class="form__submit" id="post-create-submit">Publish!</button>
        </form>
    </div>
</section>

@endsection
