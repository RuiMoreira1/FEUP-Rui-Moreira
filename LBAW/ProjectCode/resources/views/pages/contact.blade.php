@extends('layouts.app')

@section('title', 'About Us')

@section('content')

<div>
    <div class="d-flex justify-content-center pt-5 pb-5 pl-5 fw-bold" id="title"> Contact Us </div>
    <div class="d-flex row-1">
        <div class="col-md-5" id="text">
            <p> <strong>Phone Number:</strong> +351 999 999 999 </p>
            <p> <strong>Address:</strong> R.Dr Roberto Faria, 4200-465 Porto </p>
            <p> <strong>Email:</strong> xxxxxxxxxx@up.pt </p>
        </div>
        <div class="col-md">
            <img id="logo" src="{{ asset('/assets/logo.png') }}" >
        </div>
    </div>
    <div class="messageForm">
        <div id="title"> Send Us a Message </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Your Email address</label>
            <input type="email" class="form-control form-control-lg" id="exampleFormControlInput1" placeholder="user@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
            <textarea class="form-control form-control-lg" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="button" class="btn btn-dark rounded-pill border border-3 send"> Send </button> 
    </div>
</div>

@endsection