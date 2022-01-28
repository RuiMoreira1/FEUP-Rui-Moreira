@extends('layouts.app')

@section('title', 'Cart') 

@section('content')


<div class="d-flex justify-content-center pt-5 pb-5 pl-5 fw-bold" id="title"> Shopping Cart </div>

<div class="col-md card m-5">  
        @each('partials.cartItem', $productIncart, 'product')
</div>

<div class="row-md d-flex align-items-center card-body shadow-lg p-4 mb-3 bg-body rounded m-5">
    <div class="col-md-8 fs-1 fw-bold text-center">
        <span> Subtotal </span>
    </div>
    <div class="col-md fs-1 fw-bold text-center">
        <span id="noice" class="fs-1">
            @php
                $price = 0;
                foreach($productIncart as $p){
                    $price += number_format($p->cartProduct->price,2,'.','') * intval($p->quantity);
                }
            @endphp
            {{$price}}
        </span> 
        <span class="fs-1"><i class="bi bi-coin"></i> </span> 
    </div>
</div>
  
<div class="row-md text-center">
    <button class="checkoutBut rounded-pill fs-5 fw-bold"> Checkout <i class="bi bi-bag-check"></i></button>
</div>


@endsection('content')