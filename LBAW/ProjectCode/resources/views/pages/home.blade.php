@extends('layouts.app')

@section('title', 'Home') 

@section('content')

<div class="carouselController" id="home_car_cont">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators" id="home_car_indicators">
            <button type="button" id="bt" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active border border-dark" aria-current="true" aria-label="Slide 1"></button>
            <button class="border border-dark" type="button" id="bt" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button class="border border-dark" type="button" id="bt" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" id="home_carousel">
            <div class="carousel-item active">
                <img src="{{ asset('/assets/opening.jpg') }}" class="d-flex">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('/assets/new_arrivals.jpg') }}" class="d-flex">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('/assets/new_authors.jpg') }}" class="d-flex">
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row home_row">
        <div class="col-sm-6 text-center">
            <a href="{{ url ('/products/HarryPotter') }}"> 
                <div class="card shadow-lg" id="home_card" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('{{ asset('/assets/hp_banner.jpg')}}'); background-size: contain; background-repeat: no-repeat; ">
                    <div class="card-body text-center" style="margin-top: 12em;">
                        <h1 class="card-title" style="color: #FFFFFF"> Are you a Potterhead? </h1>
                        <h4 class="card-text"  style="color: #FFFFFF"> Celebrate the 20 years of the launch of the first movie with all our Harry Potter books! </h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col text-center">
            <div class="card shadow-lg" id="home_card">  
                <h1 class="card-title"> Top 10 </h1>             
                <div id="carousel-2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" id="bt" data-bs-target="#carousel-2" data-bs-slide-to="0" class="active border border-dark" aria-current="true" aria-label="Slide 1"></button>
                        <button class="border border-dark" type="button" id="bt" data-bs-target="#carousel-2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button class="border border-dark" type="button" id="bt" data-bs-target="#carousel-2" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button class="border border-dark" type="button" id="bt" data-bs-target="#carousel-2" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        <button class="border border-dark" type="button" id="bt" data-bs-target="#carousel-2" data-bs-slide-to="4" aria-label="Slide 5"></button>
                        <button class="border border-dark" type="button" id="bt" data-bs-target="#carousel-2" data-bs-slide-to="5" aria-label="Slide 6"></button>
                        <button class="border border-dark" type="button" id="bt" data-bs-target="#carousel-2" data-bs-slide-to="6" aria-label="Slide 7"></button>
                        <button class="border border-dark" type="button" id="bt" data-bs-target="#carousel-2" data-bs-slide-to="7" aria-label="Slide 8"></button>
                        <button class="border border-dark" type="button" id="bt" data-bs-target="#carousel-2" data-bs-slide-to="8" aria-label="Slide 9"></button>
                        <button class="border border-dark" type="button" id="bt" data-bs-target="#carousel-2" data-bs-slide-to="9" aria-label="Slide 10"></button>
                    </div>
                    <div class="carousel-inner">
                    <div class="carousel-item active">
                            <h4>{{strval(1).'. '.$top10[0]->product_name}}</h4>
                            <a href="<?php echo '/product/'.$top10[0]->id.''; ?>"> <img class="card-img"  id="card-book-img" src="{{ asset('/assets/'.$top10[0]->productImages[0]->getImage->path_image.'') }}"></a>
                        </div>
                        <div class="carousel-item">
                            <h4>{{strval(2).'. '.$top10[1]->product_name}}</h4>
                            <a href="<?php echo '/product/'.$top10[1]->id.''; ?>"><img class="card-img"  id="card-book-img" src="{{ asset('/assets/'.$top10[1]->productImages[0]->getImage->path_image.'') }}"></a>
                        </div>
                        <div class="carousel-item">
                            <h4>{{strval(3).'. '.$top10[2]->product_name}}</h4>
                            <a href="<?php echo '/product/'.$top10[2]->id.''; ?>"><img class="card-img"  id="card-book-img" src="{{ asset('/assets/'.$top10[2]->productImages[0]->getImage->path_image.'') }}"></a>
                        </div>
                        <div class="carousel-item">
                            <h4>{{strval(4).'. '.$top10[3]->product_name}}</h4>
                            <a href="<?php echo '/product/'.$top10[3]->id.''; ?>"><img class="card-img"  id="card-book-img" src="{{ asset('/assets/'.$top10[3]->productImages[0]->getImage->path_image.'') }}"></a>
                        </div>
                        <div class="carousel-item">
                            <h4>{{strval(5).'. '.$top10[4]->product_name}}</h4>
                            <a href="<?php echo '/product/'.$top10[4]->id.''; ?>"><img class="card-img"  id="card-book-img" src="{{ asset('/assets/'.$top10[4]->productImages[0]->getImage->path_image.'') }}"></a>
                        </div>
                        <div class="carousel-item">
                            <h4>{{strval(6).'. '.$top10[5]->product_name}}</h4>
                            <a href="<?php echo '/product/'.$top10[5]->id.''; ?>"><img class="card-img"  id="card-book-img" src="{{ asset('/assets/'.$top10[5]->productImages[0]->getImage->path_image.'') }}"></a>
                        </div>
                        <div class="carousel-item">
                            <h4>{{strval(7).'. '.$top10[6]->product_name}}</h4>
                            <a href="<?php echo '/product/'.$top10[6]->id.''; ?>"><img class="card-img"  id="card-book-img" src="{{ asset('/assets/'.$top10[6]->productImages[0]->getImage->path_image.'') }}"></a>
                        </div>
                        <div class="carousel-item">
                            <h4>{{strval(8).'. '.$top10[7]->product_name}}</h4>
                            <a href="<?php echo '/product/'.$top10[7]->id.''; ?>"><img class="card-img"  id="card-book-img" src="{{ asset('/assets/'.$top10[7]->productImages[0]->getImage->path_image.'') }}"></a>
                        </div>
                        <div class="carousel-item">
                            <h4>{{strval(9).'. '.$top10[8]->product_name}}</h4>
                            <a href="<?php echo '/product/'.$top10[8]->id.''; ?>"><img class="card-img"  id="card-book-img" src="{{ asset('/assets/'.$top10[8]->productImages[0]->getImage->path_image.'') }}"></a>
                        </div>
                        <div class="carousel-item">
                            <h4>{{strval(10).'. '.$top10[9]->product_name}}</h4>
                            <a href="<?php echo '/product/'.$top10[9]->id.''; ?>"><img class="card-img"  id="card-book-img" src="{{ asset('/assets/'.$top10[9]->productImages[0]->getImage->path_image.'') }}"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::check())
    <div class="row home_row">
        <div class="col text-center">
            <div class="card shadow-lg" id="home_card_rec" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('/assets/banner_rec.jpg')}}');">
                <div class="card-body">
                    <h1 class="card-title" style="color: #FFFFFF"> Don't know what to read next? </h1>
                    <h2 class="card-text"  style="color: #FFFFFF"> We've got you covered! </h2>
                    <p class="card-text"  style="color: #FFFFFF"> Click the button and you'll be redirected to a product!</p>
                    @php $id = $idx = rand(1, sizeof($products)); @endphp 
                    <a class="button button-outline" id="bt_rec" href="<?php echo '/product/'.$id.''; ?>">Recomend me something</a>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <div class="row home_row">
        <div class="col text-center">
            <div class="card shadow-lg text-center" id="home_card_quote">
                <div class="card-body">
                    @php
                        $idx = rand(1, sizeof($quotes)); 
                        $cnt = 1;
                        $str = '';
                        foreach ($quotes as $qt){
                            if(strval($cnt) == $idx){
                                $str = $qt;
                                break;
                            }

                            $cnt = $cnt + 1;
                        }
                    @endphp
                    <h2 class="card-text" id="home_quote" > {{ $str->quote }} </h2>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection