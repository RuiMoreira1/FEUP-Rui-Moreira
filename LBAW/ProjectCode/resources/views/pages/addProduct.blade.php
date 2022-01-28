@extends('layouts.app')

@section('title', 'Add Product')
    
@section('content')


<br>

@foreach ($errors->all() as $error)
<div class="d-flex justify-content-center">
    <div class="alert alert-danger" role="alert">
    {{$error}}
  </div>
  </div>
    
@endforeach
    
<div class='d-flex justify-content-center fw-bold h2' id="ProductsTable"> Add Product </div>
    <br>
    <div class="row-md">
        <div class="col-md-6 offset-3">
            <div class="userCard shadow-lg p-1 mb-1 bg-body rounded">
                <div class="card-body">
    <br>
        
        <div class="d-flex justify-content-center ">
            <form method='POST'action="{{route('newProduct') }}" >
                {{ csrf_field() }}
                <table class="table table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Genre</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">AuthorId</th>
                        <th scope="col" class="text-center">Stock</th>
                        <th scope="col" class="text-center">Price</th>
                        <th scope="col" class="text-center">Discount</th>
                        <th scope="col" class="text-center">Synopsis</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    <tr>
                        <td class="text-center">
                            <select class="custom-select mr-sm-2" id="Genre">
                                <option selected>Choose...</option>
                                <option>Detective and Mystery</option>
                                <option>Fantasy</option>
                                <option>Historical Fiction</option>
                                <option>Horror</option>
                                <option>Literary Fiction</option>
                                <option>Romance</option>
                                <option>Science Fiction</option>
                                <option>Westerns</option>
                                <option>Thriller</option>
                                <option>Dystopia</option>
                            </select>
                        </td>
                        
                            <td class="text-center">
                                <input class="form-control" type="text" name="BookName" placeholder="Book name">
                            </td>
                            <td class="text-center">@mdo</td>
                            <td class="text-center">
                                <input class="form-control" type="text" name="Stock" placeholder="Stock">
                            </td>
                            <td class="text-center">
                                <input class="form-control" type="text" name="Price" placeholder="Price">
                            </td>
                            <td class="text-center">
                                <input class="form-control" type="text" name="Discount" placeholder="Discount">
                            </td>
                            <td class="text-center">
                                <input class="form-control" type="text" name="Synopsis" placeholder="Synopsis">
                            </td>
                        
                        
                            
                
                        
                        
                    </tr>
                    

                    </tbody>
                </table>
                <br>

                
                        
                
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-secondary" >Save</button>
                                </div>
                </form>
        
        </div>
    </div>
</div>
</div>
</div>

        
            

    
    
    <br>


@endsection