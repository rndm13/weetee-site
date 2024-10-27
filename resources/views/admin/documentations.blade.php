@extends('admin.dashboard')

@section('title', 'Documentations')

@section('content')
<section class="admin-index">
    <div class="container">
        <h3 class="admin-index__title">Documentation</h3>

        <div class="collection-docs">
            <ul class="collection-docs__list">
                <div class="collection-docs__list-item">
                    <div></div>
                    <div></div>
                    <div></div>
                    <a href="/admin/documentation/create" class="form__submit">Add</a>
                </div>
                <hr class="collection-docs__separator"/>

                @foreach ($docs as $doc)
                    <div class="collection-docs__list-item">
                        <a class="collection-docs__field link" href="/documentation/{{$doc->slug}}">{{ $doc->title }}</a>
	                    <a class="collection-docs__field link" href="/documentation/{{$doc->slug}}">{{ $doc->slug }}</a>
                        <p class="collection-docs__field--secondary">@date($doc->updated_at)</p>
                        <div class="collection-docs__actions">

                            <form action="/admin/documentation/delete/{{ $doc->id }}" method="POST">
                                @csrf
                                <button class="action--delete"> <img src={{ Vite::image("cross.svg") }} /></button>
                            </form>
	                        <a class="action--edit" href="/admin/documentation/edit/{{ $doc->id }}"> <img src={{ Vite::image("edit.svg") }} /> </a>
                        </div>
                    </div>
                    <hr class="collection-docs__separator"/>
                @endforeach
            </ul>
            <div class="pagination">
                <a @class([
                    "pagination__button",
                    "pagination__button--inactive" => $docs->onFirstPage(),
                ]) href={{ $docs->previousPageUrl() }}>
                    <img src={{ Vite::image('previous.svg') }} alt="Previous">
                </a>
                <p class="pagination__page"> {{ $docs->currentPage() }} / {{ $docs->lastPage() }} </p>
                <a @class([
                    "pagination__button",
                    "pagination__button--inactive" => $docs->onLastPage(),
                ]) href={{ $docs->nextPageUrl() }}>
                    <img src={{ Vite::image('next.svg') }} alt="Next">
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
