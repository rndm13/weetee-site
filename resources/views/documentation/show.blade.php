@extends("documentation.master")

@php
    $title = $doc->title;
@endphp

@section("title", $title)

<section class="documentation">
    <div class="container markdown">
        {!! $doc_markdown !!}
    </div>
</section>
@section("content")
@endsection
