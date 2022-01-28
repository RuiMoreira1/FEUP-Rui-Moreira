@extends('layouts.app')

@section('title','Edit Order')

@section('content')
    <br>
    <style>
        .table{margin: auto;
        width: 50%;}

    </style>



<br>
<div class='d-flex justify-content-center fw-bold h2' id="OrderTable"> Order Managment </div>
<br>


<div class="d-flex justify-content-center ">
    
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center">Order id</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center">Order Date</th>
            <th scope="col" class="text-center">Payed</th>
            <th scope="col" class="text-center">Shipping date</th>
            <th scope="col" class="text-center">Delivery Date</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td class="text-center">Romance</td>
            <td class="text-center">Otto</td>
            <td class="text-center">@mdo</td>
            <td class="text-center">Mark</td>
            <td class="text-center">Otto</td>
            
        </tr>
            

        <tr>
            <th scope="row">1</th>
            <td class="text-center">

                <select class="custom-select mr-sm-2" id="Genre">
                    <option selected>Choose...</option>
                    <option>Processing</option>
                    <option>Shipped</option>
                    <option>Delivered</option>
                    <option>Returned</option>
                  </select>

                
            </td>
            <td class="text-center">Otto</td>
            <td class="text-center">
                <div class="form-check text-center">
                    <input class="form-check-input" type="checkbox" value="" id="isPayed">
                    
                  </div>
            </td>
            <td class="text-center">Mark</td>
            <td class="text-center">Otto</td>
            
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