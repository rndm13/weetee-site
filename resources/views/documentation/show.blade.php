@extends("documentation.master")

@php
    $title = $doc->title;
@endphp

@section("title", $title)

@section("content")
<section class="documentation">
    <div class="container markdown">
        {!! $doc_markdown !!}
    </div>
</section>
@endsection
