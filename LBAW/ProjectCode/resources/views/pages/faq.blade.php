@extends('layouts.app')

@section('title', 'Faq')

@section('content')

<div class="row pt-5">
    <span class="text-center fw-bold fs-1 title"> Frequently Asked Questions </span>
</div>
<div class="row">
    <div class="col-sm-8 faqArea">
        @foreach ($faqs as $faq)
            <div class="card shadow-lg p-3 mb-1 bg-body rounded">
                <div class="card-body accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item applyBorder">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne{{$faq->id}}">
                            <button class="accordion-button collapsed faqButton" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne{{$faq->id}}" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne{{$faq->id}}">
                                {{ $faq->question }}?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne{{$faq->id}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne{{$faq->id}}">
                            <div class="accordion-body">
                                {{ $faq->answer }}.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-sm">
        <img src="{{ asset('/assets/logo.png') }}" class="logo mx-auto d-block" heigth=400 width=400>
    </div>
</div>

<br>
<br>


@endsection
