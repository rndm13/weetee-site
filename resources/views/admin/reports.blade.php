@extends('admin.dashboard')

@section('title', 'Reports')

@section('content')
<section class="admin-index">
    <div class="container">
        <h3 class="admin-index__title">Reports</h3>

        <div class="collection-reports">
            <ul class="collection-reports__list">
                @foreach ($reports as $report)
                    <div class="collection-reports__list-item">
                        <a class="collection-reports__field link" href="/profile/{{$report->on_user->id}}"> On user {{ $report->on_user->name }} </a>
	                    <a class="collection-reports__field link" href="/profile/{{$report->from_user->id}}"> From user {{ $report->from_user->name }} </a>
                        <p class="collection-reports__field"> {{ $report->reason }}</p>
                        <p class="collection-reports__field"> {{ $report->created_at }} </p>
                        <div class="collection-reports__actions">
                            <form action="/report/delete/{{ $report->id }}" method="report">
                                @csrf
                                <button class="action--delete"> <img src={{ Vite::image("cross.svg") }} alt="Delete"></button>
                            </form>

                            <a href="/report/details/{{$report->id}}" class="action--details"><img src={{ Vite::image("details.svg")}} alt="Details"></a>
                        </div>
                    </div>
                    <hr class="collection-reports__separator"/>
                @endforeach
            </ul>
            <div class="pagination">
                <a @class([
                    "pagination__button",
                    "pagination__button--inactive" => $reports->onFirstPage(),
                ]) href={{ $reports->previousPageUrl() }}>
                    <img src={{ Vite::image('previous.svg') }} alt="Previous">
                </a>
                <p class="pagination__page"> {{ $reports->currentPage() }} / {{ $reports->lastPage() }} </p>
                <a @class([
                    "pagination__button",
                    "pagination__button--inactive" => $reports->onLastPage(),
                ]) href={{ $reports->nextPageUrl() }}>
                    <img src={{ Vite::image('next.svg') }} alt="Next">
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
