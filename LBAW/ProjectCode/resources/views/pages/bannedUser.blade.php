@extends('layouts.app')

@section('title', 'Banned User')
    
@section('content') 
<br>
<br>
<div class="d-flex justify-content-center">
    <div class="alert alert-danger" role="alert">
        Banned
    </div>
</div>
<div class="d-flex justify-content-center">
    <div class="alert alert-danger" role="alert">
        Reason: {{$banned->reason}}
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@endsection