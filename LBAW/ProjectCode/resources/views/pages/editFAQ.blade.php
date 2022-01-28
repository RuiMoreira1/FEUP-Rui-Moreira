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
    <form action="/editFaq/edit/{{$faq->id}}" method="post">
            @csrf
            @method('put')
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
                <input class="form-control" type="text" name='Question' value="{{$faq->question}}">
            </th>
            <td class="text-center">
                <input class="form-control" type="text" name="Answer" value="{{$faq->answer}}">
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