@extends("documentation.master")

@section("title", "Documentation search results")

@section("content")
<section class="documentation-search">
    <div class="container container--sm">
        <div class="search-results">
            @forelse ($docs as $doc)
                <a href="/documentation/{{$doc->slug}}/" class="search-results__elem link">{{$doc->title}}</a>
            @empty
                <p class="search-results__none">No results found. :(</p>
            @endforelse
        </div>
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
</section>
@endsection
