@extends('layouts.app')

@section('title', 'Wishlist') 

@section('content')

@php
if (Auth::user()->id == 1){
    header("Location: /");
    exit();
}
@endphp

<div class="d-flex justify-content-center pt-5 pb-5 pl-5 fw-bold" id="title"> Wishlist </div>

@if (count($products) == 0)
<div class="container">
        <div class="row card shadow-lg d-flex align-items-center text-center" id="wishlist_empty">
            <div class="card-body">
                <h1 class="card-title">Wishlist is Empty!</h1>
                <p class="card-text">Add some items to fill this page!</p>
            </div>
        </div>
</div>
@else
<div class="m-5">
  <ul class="list-group list-group-flush gap-3" id="list_prod">
    @foreach ($products as $prod)
        <li class="list-group-item shadow-lg p-3 mb-1 bg-body rounded gap-5" data-value ="{{ $prod->wishlistProduct->id }}">
            <div class="">
                <div class="row d-flex gap-4 align-items-center justify-content-center">
                    <div class="col-md-3"> 
                        <img src="{{ asset('/assets/'.$prod->wishlistProduct->productImages[0]->getImage->path_image.'') }}" class="d-block wishImage"> </div>
                    <div class="col-md-4 fw-bold"> 
                        <h3 class="fw-bold">{{$prod->wishlistProduct->product_name}}</h3>
                        <div class="fs-2">{{$prod->wishlistProduct->price}} <i class="bi bi-coin"></i></div>
                    </div>
                    <div class="col-md">
                        @php 
                            $temp = $prod->wishlistProduct->star_rating;

                            for($i = 0; $i < 5; $i++){
                                if($temp > 1){
                                    $temp -= 1;
                                    echo '<i class="bi bi-star-fill bigger fs-2 p-1"></i>';
                                }
                                else if($temp == 0.5){
                                    $temp -= 0.5;
                                    echo '<i class="bi bi-star-half bigger fs-2 p-1"></i>';
                                }
                                else{
                                    echo '<i class="bi bi-star bigger fs-2 p-1"></i>';
                                }
                            }
                        @endphp
                    </div>
                    <div class="col-md">
                        <a class="button fw-bold rounded-pill wishBut2" href="<?php echo '/product/'.$prod->wishlistProduct->id.''; ?>"> See Product </a> <br>
                        <button class="button bt_cart fw-bold rounded-pill wishBut" id="button_add_cart" value="{{ $prod->wishlistProduct->id }}"> Add to Cart </button> <br>
                        <button class="button bt_cart fw-bold rounded-pill deleteWish" value="{{ $prod->wishlistProduct->id }}'" id="button_rem"> Delete </button>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
  </ul>
</div>
@endif

@endsection('content')