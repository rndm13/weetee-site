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
                <hr class="collection-categories__separator"/>

	            @foreach ($categories as $category)
	                <p class="collection-categories__title">{{ $category->title }}</a>
                    <div class="collection-categories__actions">
                        <form action="/admin/categories/delete/{{ $category->id }}" method="POST">
                            @csrf
                            <button class="action--delete"> <img src={{ Vite::image("cross.svg") }} /></button>
                        </form>

                        <button class="action--edit"> <img src={{ Vite::image("edit.svg") }} /> </button>
                    </div>
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
