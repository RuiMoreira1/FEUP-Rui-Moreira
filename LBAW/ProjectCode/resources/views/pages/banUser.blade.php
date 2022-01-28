@extends('layouts.app')

@section('title', 'Ban User')
    
@section('content')

<br>
    
<div class='d-flex justify-content-center fw-bold h2' id="BanUserTable"> Ban User </div>
    <br>
    <div class="row-md">
        <div class="col-md-6 offset-3">
            <div class="userCard shadow-lg p-3 mb-1 bg-body rounded">
                <div class="card-body">
    <div class="">
        <form action="/banUser/ban/{{$user->id}}" method="post">
            @csrf
            @method('post')
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">UserName</th>
                <th scope="col"  class="text-center">Reason</th>
            </tr>
            </thead>
            <tbody>
            
            <tr>
                <td scope="row">{{$user->name}}</td>
                <td scope="col" class="text-center">{{$user->username}}</td>
                
                <td class="text-center " colspan="2">
                    <input class="form-control form-control-lg"   type="text" name="Reason" placeholder="Reason...">
                </td>
                
            </tr>
            
            </tbody>
        </table>
            <div class="text-center">
                <button type="submit" class="btn btn-secondary">Save</button>
            </div>
        </form>


    </div>
</div>
</div>
</div>
</div>

    <br>
            
    <br>

@endsection