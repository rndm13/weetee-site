@extends("admin.dashboard")

@section("title", "Create new documentation page")

@section("content")

<section class="form-post" id="create-post">
    <div class="container">
        <form action="/admin/documentation/save" method="POST" class="form" accept-charset="utf-8" enctype="multipart/form-data">
            @csrf

            <h3 class="form__title">Create documentation page</h3>

            <div class="form__group">
                <label for="title">Title</label>
                <input class="form__input" type="text" name="title">
                <p class="form__error">
                @error('title')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="slug">Slug</label>
                <input class="form__input" type="text" name="slug">
                <p class="form__error">
                @error('slug')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="description">Description (accepts markdown)</label>
                <textarea class="form__input" type="text" name="description"></textarea>
                <p class="form__error">
                @error('description')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="order">Order</label>
                <input class="form__input" type="number" name="order" value="1"/>
                <p class="form__error">
                @error('order')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="assets[]">Assets</label>
                <input class="form__input" type="file" name="assets[]" multiple>
                <p class="form__error">
                @error('assets')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <button class="form__submit" id="post-create-submit">Publish!</button>
        </form>
    </div>
</section>

@endsection
