@extends('layouts.app')

@section('title', 'Edit FAQ')
    
@section('content')

<br>



<br>

<br>
<div class="row-md">
    <div class="col-md-6 offset-3">
        <div class="userCard shadow-lg p-3 mb-1 bg-body rounded">
            <div class="card-body">
<div class="">
    <form method='POST'action="{{route('newFaq') }}" >
        {{ csrf_field() }}
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center">Question</th>
            <th scope="col" class="text-center">Answer</th>
        </tr>
        </thead>
        <tbody>
        
        <tr>
            
                
            <th scope="row">
                <input class="form-control" type="text" name='Question' placeholder="Question...">
            </th>
            <td class="text-center">
                <input class="form-control" type="text" name="Answer" placeholder="Answear...">
            </td>
            
        </tr>
        
        </tbody>
    </table>
            <div class="text-center">
                <button type="submit" class="btn btn-secondary">Add</button>
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