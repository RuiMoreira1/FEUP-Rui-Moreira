@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<br>
    <style>
        .table{margin: auto;
        width: 50%;}

    </style>



<br>

<br>
<div class='d-flex justify-content-center fw-bold h2' id="UserTable"> User Managment </div>
<br>
<div class="d-flex justify-content-center ">
    
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center">Username</th>
            <th scope="col" class="text-center">Name</th>
            <th scope="col" class="text-center">email</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td class="text-center">Larry</td>
            <td class="text-center">Romance</td>
            
        </tr>
        <tr>
            <th scope="row">
                <input class="form-control" type="text" id="inputUserName" placeholder="Username">
            </th>
            <td class="text-center">
                <input class="form-control" type="text" id="inputName" placeholder="Name">
            </td>
            <td class="text-center">
                <input class="form-control" type="text" id="inputEmail" placeholder="Email">
            </td>
            
        </tr>
        
        </tbody>
    </table>
</div>

<br>
<div class="text-center">
    <a type="button" class="btn btn-secondary">Save</a>
</div>
 <br>
    
@endsection