@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container" style="margin: 0;">
    <div class="row" style="margin-left: 2em;">
        <div class="col-6">
            <img class="float-start" id="login_image" style="border-right: 2px outset #456155;" src="{{ asset('/assets/login_img.jpg') }}" alt="Login Page Image">
        </div>
        <div class="col-5">
            <div class="d-flex justify-content-center pt-5 pb-5 pl-5 fw-bold" id="title"> Login </div>
            <div class="d-flex justify-content-center" style="font-size: 9pt"> The Last Chapter - An Online Shop that becomes your 'street corner' bookshop only a click away! </div>

            <form method="POST" action="{{ route('login') }}" style="margin-top:1em;">
                {{ csrf_field() }}

                <label for="email" class="form-label">E-mail</label>
                <input id="email" class="form-control" style="background-color: white;" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="error">
                    {{ $errors->first('email') }}
                    </span>
                @endif

                <label for="password" class="form-label" >Password</label>
                <input id="password" class="form-control" style="background-color: white;" type="password" name="password" required>
                @if ($errors->has('password'))
                    <span class="error">
                        {{ $errors->first('password') }}
                    </span>
                @endif

                <label style="margin-top: 1em;">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>

                <div class="container" style="margin-top: 1em;">
                    <div class="row">                
                        <div class="col"></div>    
                        <div class="col">  <button class="button" type="submit"> Login</button> </div>
                        <div class="col"> <a class="button button-outline" href="{{ route('register') }}">Register</a>  </div>
                        <div class="col"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
