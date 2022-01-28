@extends('layouts.app')

@section('title', 'Edit Product')
    
@section('content')


<br>

<div class='d-flex justify-content-center fw-bold h2' id="ProductsTable"> Edit Product </div>
    <br>
    <div class="row-md">
        <div class="col-md-6 offset-3">
            <div class="userCard shadow-lg p-3 mb-1 bg-body rounded">
                <div class="card-body">
    <div class="">
        <form action="/editProduct/edit/{{$product->id}}" method="post">
            @csrf
            @method('put')
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">Product id</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Stock</th>
                <th scope="col" class="text-center">Price</th>
                <th scope="col" class="text-center">Discount</th>
                <th scope="col" class="text-center">Synopsis</th>
            </tr>
            </thead>
            <tbody>
            
            <tr>
                <th scope="row">{{$product->id}}</th>
                
                <td class="text-center">
                    <input class="form-control" type="text" name="BookName" value="{{$product->product_name}}">
                </td>
                <td class="text-center">
                    <input class="form-control" type="text" name="Stock" value="{{$product->stock}}">
                </td>
                <td class="text-center">
                    <input class="form-control" type="text" name="Price" value="{{$product->price}}">
                </td>
                <td class="text-center">
                    <input class="form-control" type="text" name="Discount" value="{{$product->discount}}">
                </td>
                <td class="text-center">
                    <input class="form-control" type="text" name="Synopsis" value="{{$product->synopsis}}">
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