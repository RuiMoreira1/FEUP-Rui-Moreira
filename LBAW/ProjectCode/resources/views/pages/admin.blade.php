
@extends('layouts.app')


@section('title','Admin Page')

@section('content')


@if (session()->has('message'))
<div class="d-flex justify-content-center">
    <div class="alert alert-success" role="alert">
        {{session()->get('message')}}
      </div>
    
</div>
@endif



<br>
<div class='d-flex justify-content-center fw-bold h2' id="UserTable"> User Managment </div>
<br>
<div class="row-md">
    <div class="col-md-6 offset-3">
        <div class="userCard shadow-lg p-3 mb-1 bg-body rounded">
            <div class="card-body">
        <div class="d-flex justify-content-center ">
            
            <table class="table table-bordered table-condensed" style="display table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">Username</th>
                    <th scope="col" class="text-center">Name</th>
                    <th scope="col" class="text-center">email</th>
                    <th scope="col" class="text-center">Managment Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    @if($user->id != 1)
                        <tr>
                            <th scope="row">{{$user->username}}</th>
                            <td class="text-center">{{$user->name}}</td>
                            <td class="text-center">{{$user->email}}</td>
                            <td class="text-center">
                                
                                    <a type="button" class="btn btn-outline-secondary btn-lg" href="/banUser/{{$user->id}}">Ban</a>
                                    <form action="/deleteUser/{{$user->id}}" method="post"  >
                                        @csrf @method('delete')
                                        <button type="submit" class="btn btn-outline-secondary btn-lg" >
                                            Delete
                                        </button>
                                    </form>
                                
                            </td>
                        </tr>
                    @endif
                @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<br>
<div class='d-flex justify-content-center fw-bold h2' id="UserTable"> Banned Users </div>
<br>
<div class="row-md">
    <div class="col-md-6 offset-3 ">
        <div class="userCard shadow-lg p-3 mb-1 bg-body rounded">
            <div class="card-body">
<div class="d-flex justify-content-center ">
    
    <table class="table table-bordered table-condensed " style="display:table">
        <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center">Username</th>
            <th scope="col" class="text-center">Name</th>
            <th scope="col" class="text-center">Reason</th>
            <th scope="col" class="text-center">Managment Options</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($busers as $buser)
        <tr>
            <th scope="row">{{$buser->username}}</th>
            <td class="text-center">{{$buser->name}}</td>
            <td class="text-center">{{$buser->reason}}</td>
            <td class="text-center">
                
                  <form action="/unBan/{{$buser->id_user}}" method="post"  >
                    @csrf @method('delete')
                    <button type="submit" class="btn btn-outline-secondary btn-lg" >
                        unBan
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>

<br>

    <br>
    <div class='d-flex justify-content-center fw-bold h2' id="ProductsTable"> Product Managment </div>
    <br>
    <div class="row-md">
            <div class="col-md-6 offset-3">
                <div class="userCard shadow-lg p-3 mb-1 bg-body rounded">
                    <div class="card-body">
    <div class="d-flex justify-content-center ">
        
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">Product id</th>
                <th scope="col" class="text-center">Genre</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Author</th>
                <th scope="col" class="text-center">Stock</th>
                <th scope="col" class="text-center">Price</th>
                <th scope="col" class="text-center">Discount</th>
                <th scope="col" class="text-center">Managment Options</th>
            </tr>
            </thead>
            <tbody>
            
            
            @foreach ($products as $prod)
                <tr>
                    <th scope="row">{{$prod->id}}</th>
                    <td class="text-center">{{$prod->genreName}}</td>
                    <td class="text-center">{{$prod->product_name}}</td>
                    <td class="text-center">{{$prod->authorName}}</td>
                    <td class="text-center">{{$prod->stock}}</td>
                    <td class="text-center">{{$prod->price}}</td>
                    <td class="text-center">{{$prod->discount}}</td>
                    <td class="text-center">
                        
                            <a type="button" class="btn btn-outline-secondary btn-lg" href="/editProduct/{{$prod->id}}">Edit</a>
                            <!--a type="button" class="btn btn-outline-secondary btn-lg">Archive</a-->
                            <form action="/deleteProduct/{{$prod->id}}" method="post"  >
                                @csrf @method('delete')
                                <button type="submit" class="btn btn-outline-secondary btn-lg" >
                                    Delete
                                </button>
                            </form>
                            
                        
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
 <br>
    <div class="text-center">
        <a type="button" class="btn btn-secondary" href="{{route('newProduct')}}" method='post' >Add Product</a>

    <br>
</div></div></div></div>

    <br>

    <br>
<div class='d-flex justify-content-center fw-bold h2' id="OrderTable"> Order Managment </div>
<br>
    <div class="row-md">
            <div class="col-md-6 offset-3">
                <div class="userCard shadow-lg p-3 mb-1 bg-body rounded">
                    <div class="card-body">
    <div class="d-flex justify-content-center ">
        
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">Order id</th>
                <th scope="col" class="text-center">Status</th>
                <th scope="col" class="text-center">Order Date</th>
                <th scope="col" class="text-center">Current Status Date</th>
                <th scope="col" class="text-center"> Options</th>
            </tr>
            </thead>
            <tbody>
    
                @foreach ($orders_payment_pending as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td class="text-center">{{$order->type}}</td>
                    <td class="text-center">{{$order->date}}</td>
                    <td class="text-center">{{$order->date}}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a type="button" class="btn btn-outline-secondary btn-lg">See More</a>
                            <a type="button" class="btn btn-outline-secondary btn-lg" >Edit</a>
                          </div>
                    </td>
                </tr>
                @endforeach
    
                @foreach ($orders_processing as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td class="text-center">{{$order->type}}</td>
                    <td class="text-center">{{$order->date}}</td>
                    <td class="text-center">{{$order->date_payed}}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a type="button" class="btn btn-outline-secondary btn-lg">See More</a>
                            <a type="button" class="btn btn-outline-secondary btn-lg" >Edit</a>
                          </div>
                    </td>
                </tr>
                @endforeach
    
                @foreach ($orders_shipped as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td class="text-center">{{$order->type}}</td>
                    <td class="text-center">{{$order->date}}</td>
                    <td class="text-center">{{$order->date_shipped}}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a type="button" class="btn btn-outline-secondary btn-lg" disabled>See More</a>
                            <a type="button" class="btn btn-outline-secondary btn-lg"  disabled>Edit</a>
                          </div>
                    </td>
                </tr>
                @endforeach
    
                @foreach ($orders_delivered as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td class="text-center">{{$order->type}}</td>
                    <td class="text-center">{{$order->date}}</td>
                    <td class="text-center">{{$order->date_delivered}}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a type="button" class="btn btn-outline-secondary btn-lg">See More</a>
                            <a type="button" class="btn btn-outline-secondary btn-lg" >Edit</a>
                          </div>
                    </td>
                </tr>
                @endforeach
    
                @foreach ($orders_returned as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td class="text-center">{{$order->type}}</td>
                    <td class="text-center">{{$order->date}}</td>
                    <td class="text-center">{{$order->date_returned}}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a type="button" class="btn btn-outline-secondary btn-lg">See More</a>
                            <a type="button" class="btn btn-outline-secondary btn-lg" >Edit</a>
                          </div>
                    </td>
                </tr>
                @endforeach
    
    
            </tbody>
        </table>
    </div></div></div></div>
    </div>
     <br>  

    <br>
    
<div class='d-flex justify-content-center fw-bold h2' id="FAQTable"> FAQ Managment </div>
<br>
<div class="d-flex justify-content-center ">
    <div class="row-md">
        <div class="col-md-6 offset-3">
            <div class="userCard shadow-lg p-3 mb-1 bg-body rounded">
                <div class="card-body">
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center">Question</th>
            <th scope="col" class="text-center">Answer</th>
            <th scope="col" class="text-center">Managment Options</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($faq as $fq)
                <tr>
                    <th scope="row">{{$fq->question}}</th>
                    <td class="text-center">{{$fq->answer}}</td>
                    <td class="text-center">
                        
                            <a type="button" class="btn btn-outline-secondary btn-lg" href="/editFaq/{{$fq->id}}">Edit</a>
                            <form action="/deleteFaq/{{$fq->id}}" method="post"  >
                                @csrf @method('delete')
                                <button type="submit" class="btn btn-outline-secondary btn-lg" >
                                    Delete
                                </button>
                            </form>
                         
                    </td>
                </tr>
            @endforeach
        
        </tbody>
    </table>

    
</div>
<br>
    <div class="text-center">
        <a type="button" class="btn btn-secondary" href="/addFaq">Add FAQ</a> 
    </div>

    

</div></div></div></div>

@endsection