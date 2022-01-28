@extends('layouts.app')

@section('title', 'User Profile Page')

@section('content')

<!-- Redirecionar para outra página ?-->
@php
if (Auth::user()->id == 1){
    header("Location: /admin");
    exit();
}
else if(Auth::user()->id != $user->id){
    header("Location: /"); 
    exit();
}
@endphp

<div class="container">
    <div class="row" style="margin-top: 5em;">
        <div class="col">
            <img id="profile-pic" src="{{ asset('/assets/dummy.svg') }}" style="margin-top: 5em;">
            <p>{{$user->username;}}</p>
        </div>
        <div class="col"></div>
    </div>
    <div class="row" style="margin-top: 5em;">
        <div class= "col-2">
            <ul class="list-group">
                <li class="list-group-item">
                    Personal Info
                </li>
                <li class="list-group-item">
                    Addresses
                </li>
                <li class="list-group-item">
                    Payment Methods
                </li>
            </ul>
        </div>
        <div class= "col"></div>
    </div>
<div>
    
@endsection
