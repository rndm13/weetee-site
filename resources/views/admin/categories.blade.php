@extends('admin.dashboard')

@section('title', 'Categories')

@section('content')
<section class="admin-index">
    <div class="container">
        <h3 class="admin-index__title">Categories</h3>

        <div class="collection-categories">
            <ul class="collection-categories__list">
                <form action="/admin/category/save/" method="POST" class="collection-categories__form">
                    @csrf

                    <div class="form__group">
                        <input class="form__input" type="text" name="title">
                        <p class="form__error--hide">
                        @error('title')
                            {{ $message }}
                        @enderror
                        </p>
                    </div>

                    <button class="form__submit">Add</button>
                </form>

                <hr class="collection-categories__separator"/>

	            @foreach ($categories as $category)
                    <div class="collection__list-item collection-categories__list-item">
                        <p class="collection-categories__field">{{ $category->title }}</a>
	                    <div class="collection__actions collection-categories__actions">
	                        <form action="/admin/category/delete/{{ $category->id }}" method="POST">
	                            @csrf
	                            <button class="action--delete"> <img src={{ Vite::image("cross.svg") }} /></button>
	                        </form>

	                        <button class="action--edit"> <img src={{ Vite::image("edit.svg") }} /> </button>
	                    </div>
                    </div>

                    <form action="/admin/category/save/" method="POST" class="collection__form--edit collection-categories__form--edit">
                        @csrf

                        <input type="number" class="form__input--hidden" name="id" value="{{ $category->id }}">

                        <div class="form__group">
                            <input class="form__input" type="text" name="title" value="{{ $category->title }}">
                            <p class="form__error--hide">
                            @error('title')
                                {{ $message }}
                            @enderror
                            </p>
                        </div>

                        <div class="collection__actions collection-categories__actions">
                            <button class="form__submit">Save</button>
	                        <button type="button" class="action--edit"> <img src={{ Vite::image("edit.svg") }} /> </button>
                        </div>
                    </form>

	                <hr class="collection-categories__separator"/>
	            @endforeach
	        </ul>

            <div class="pagination">
                <a @class([
                    "pagination__button",
                    "pagination__button--inactive" => $categories->onFirstPage(),
                ]) href={{ $categories->previousPageUrl() }}>
                    <img src={{ Vite::image('previous.svg') }} alt="Previous">
                </a>
                <p class="pagination__page"> {{ $categories->currentPage() }} / {{ $categories->lastPage() }} </p>
                <a @class([
                    "pagination__button",
                    "pagination__button--inactive" => $categories->onLastPage(),
                ]) href={{ $categories->nextPageUrl() }}>
                    <img src={{ Vite::image('next.svg') }} alt="Next">
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
