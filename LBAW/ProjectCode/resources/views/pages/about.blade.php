@extends('layouts.app')

@section('title', 'About Us')

@section('content')


<div class='d-flex justify-content-center fw-bold' id="topAbout"> About us </div>
    <div class="d-flex row-1" id="textDiv">
        <div class="align-self-center col-6" id="aboutext">
            <p> 'The Last Chapter' is an online book store. </p> 
            <p> Our central motivation is to offer a pleasant shopping experience where from the comfort</p>
            <p> of your own home you can order books that may not be available in </p>
            <p> your usual ‘street corner’ bookshop. </p>
        </div>
        <img class="col-1.5" id="logo" src="{{ asset('/assets/logo.png') }}">
    </div>

    <div class="row-md d-flex shadow-lg p-4 mb-3 bg-body rounded picCards">
        <div class="col-md d-flex gap-4">
            <div class="card-body shadow-lg p-3  bg-body rounded text-center">
                <figure class="figure">
                    <img class="figure-img img-fluid rounded  rounded-circle" src="{{ asset('/assets/ruimoreira.png') }}" width="250" height="250">
                    <figcaption class="figure-caption text-center fw-bold "> Rui Moreira </figcaption>
                </figure>
            </div>
            <div class="card-body shadow-lg p-3  bg-body rounded text-center">
                <figure class="figure">
                    <img class="figure-img img-fluid rounded  rounded-circle" src="{{ asset('/assets/zepedro.png') }}" width="250" height="250">
                    <figcaption class="figure-caption text-center fw-bold "> Jose Silva </figcaption>
                </figure>
            </div>
            <div class="card-body shadow-lg p-3  bg-body rounded text-center">
                <figure class="figure">
                    <img class="figure-img img-fluid rounded  rounded-circle" src="{{ asset('/assets/matilde.png') }}" width="250" height="250">
                    <figcaption class="figure-caption text-center fw-bold "> Matilde Barra </figcaption>
                </figure>
            </div>
            <div class="card-body shadow-lg p-3 bg-body rounded text-center">
                <figure class="figure">
                    <img class="figure-img img-fluid rounded  rounded-circle" src="{{ asset('/assets/renato.jpg') }}" width="250" height="250">
                    <figcaption class="figure-caption text-center fw-bold"> Renato Dangel </figcaption>
                </figure>
            </div>
        </div>
    </div>





@endsection