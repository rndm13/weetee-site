@extends("admin.dashboard")

@section("title", "Edit documentation page")

@section("content")

<section class="form-post" id="edit-documentation" data-document-id="{{ $doc->id }}">
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

            <div class="form__group">
                <label for="assets">Assets</label>
                <input class="form__input input-ajax" data-action='/admin/documentation/upload-asset/{{$doc->id}}' type="file" name="assets[]" multiple="multiple" id="documentation-edit-asset" placeholder="Upload a new asset" data-then-js="update_collection_assets">
                <p class="form__error">
                @error('asset')
                    {{ $message }}
                @enderror
                </p>

                <div class="collection-assets" data-documentation-id="{{$doc->id}}">
                    <ul class="collection-assets__list">
                        <!-- Is set via js -->
                    </ul>
                </div>
            </div>

            <button class="form__submit" id="post-create-submit">Publish!</button>
        </form>
    </div>
</section>

@endsection
