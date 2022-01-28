@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="container" style="margin: 0;">
    <div class="row" style="margin-left: 2em;">
        <div class="col-6 position-relative">
            <img class="float-start position-absolute left-0 start-0" style="border-right: 2px outset #456155;" src="{{ asset('/assets/register_img.jpg') }}" alt="Login Page Image">
        </div>
        <div class="col"> </div>
        <div class="col-5">
            <div class="d-flex justify-content-center pt-5 pb-5 pl-5 fw-bold" id="title"> Register </div>
            <div class="d-flex justify-content-center" style="font-size: 9pt"> The Last Chapter - An Online Shop that becomes your 'street corner' bookshop only a click away! </div>             
                
            <form method="POST" action="{{ route('register') }}" style="margin-top:1em;">
              {{ csrf_field() }}

              <label for="username" class="form-label">Username</label>
              <input id="username" class="form-control" style="background-color: white;" type="text" name="username" value="{{ old('username') }}" required autofocus>
              @if ($errors->has('username'))
                <span class="error" style="font-weight: bold; color: #ff3333;"> <!-- Melhorar isto -->
                    {{ $errors->first('username') }}
                </span>
              @endif

              <!-- check this -->
              <label for="name" class="form-label">Name</label>
              <input id="name" class="form-control" style="background-color: white;" type="text" name="name" value="{{ old('name') }}" required autofocus>
              @if ($errors->has('name'))
                <span class="error" ="font-weight: bold; color: #ff3333;">
                    {{ $errors->first('name') }}
                </span>
              @endif

              <label for="email" class="form-label">E-Mail Address</label>
              <input id="email" class="form-control" style="background-color: white;" type="email" name="email" value="{{ old('email') }}" required>
              @if ($errors->has('email'))
                <span class="error" style="font-weight: bold; color: #ff3333;">
                    {{ $errors->first('email') }}
                </span>
              @endif

              <label for="birth_date" class="form-label">Birth Date</label>
              
              <div class="container">
                <div class="row">
                  <input id="birth_date" class="col form-control" type="date" name="birth_date" required>
                  @if ($errors->has('birth_date'))
                    <span class="error" style="font-weight: bold; color: #ff3333;">
                        You must be over the age of 18 to create an account!
                    </span>
                  @endif
                  <div id="DOBHelpBlock" class="col form-text"> You must be over the age of 18 to create an account.</div>
                </div>
              </div>

              <label for="password" class="form-label" >Password</label>
              <input id="password" class="form-control" style="background-color: white;" type="password" name="password" required>
              @if ($errors->has('password'))
                <span id="error" style="font-weight: bold; color: #ff3333;">
                    {{ $errors->first('password') }}
                </span>
              @endif
              <div id="passwordHelpBlock" class="form-text" style="margin-bottom:1em;"> Your password must be more than 6 long, contain letters, numbers and special characters.</div>

              <label for="password-confirm" class="form-label">Confirm Password</label>
              <input id="password-confirm" class="form-control" style="background-color: white;" type="password" name="password_confirmation" required>

              <div class="container" style="margin-top: 1em;">
                  <div class="row">                
                      <div class="col"></div>    
                      <div class="col">  <button class="button" type="submit"> Register</button> </div>
                      <div class="col"> <a class="button button-outline" href="{{ route('login') }}"> Return to Login</a> </div>
                      <div class="col"></div>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>

@endsection
