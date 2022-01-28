@extends('layouts.app')

@section('title', 'Product Page')

@section('content')

<!-- Discount and promoted offers Carousel -->
<div class="row-md">
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner imageControl">
      <div class="carousel-item active">
        <img src="{{ asset('/assets/headerC.jpg') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('/assets/headerC.jpg') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('/assets/headerC.jpg') }}" class="d-block w-100" alt="...">
      </div>
    </div>
  </div>
</div>

<!-- Results Found -->

<!-- Filter OffCanvas Button -->
<div class="row-md filterRow">
  <div class="col-sm-2">
    <button class="filterButton btn rounded-pill" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" disabled>
      Choose Filters
    </button>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div>
          Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Product Individual Cards -->
<div class="row gap-5 pb-5 justify-content-center cardRow">
  @foreach ($products as $prod)
    <div class="card shadow-lg p-3 bg-body rounded" style="max-width: 540px;">
      <div class="row">
        <div class="col-md-4">
          @if($prod->id > 30)
            <img src="{{ asset('/assets/502x.webp') }}" class="img-fluid rounded-start">
          @else
            <img src="{{ asset('/assets/'.$prod->productImages[0]->getImage->path_image.'') }}" class="img-fluid rounded-start">
          @endif
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title text-capitalize">
              @php 
                $ret = substr($prod->product_name,0,36);
                echo $ret;
                if(strlen($prod->product_name) > 35){
                  echo '...';
                }
              @endphp
            </h5>
            <div class="ratingSearch">
              @php 
                $temp = $prod->star_rating;

                for($i = 0; $i < 5; $i++){
                    if($temp >= 1){
                        $temp -= 1;
                        echo '<i class="bi bi-star-fill star"></i>';
                    }
                    else if($temp == 0.5){
                        $temp -= 0.5;
                        echo '<i class="bi bi-star-half star"></i>';
                    }
                    else{
                        echo '<i class="bi bi-star star"></i>';
                    }
                }
              @endphp
            </div>
            <p class="card-text">
              @php 
                $ret = ucfirst(substr($prod->synopsis,0,120));
                echo $ret;
                echo '...';
              @endphp
            </p>
            <p class="priceSearch text-end"> <strong> {{$prod->price}} </strong> <i class="bi bi-coin"></i> </p>
            <a href="/product/{{$prod->id}}" class="goProd btn rounded-pill text-center"> See more </a>
          </div>
          
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="d-flex justify-content-center">
    {!!$products->links()!!}
</div>




<!-- Adapted from https://codepen.io/glitchworker/pen/XVdKqj -->
<?php function draw_multi_range_slider($id, $min, $max) { ?>

<div slider id="<?=$id?>">
  <div>
    <div inverse-left style="width:70%;"></div>
    <div inverse-right style="width:70%;"></div>
    <div range style="left:0%;right:0%;"></div>
    <span thumb style="left:0%;"></span>
    <span thumb style="left:100%;"></span>
    <div sign style="left:0%;">
      <span id="value">{{round(($max - $min) * 0 + $min)}}</span>
    </div>
    <div sign style="left:100%;">
      <span id="value">{{round(($max - $min) * 1.0 + $min)}}</span>
    </div>
  </div>
  <input type="range" style="z-index:99;" name="<?=$id?>Min" tabindex="0" value="{{round(($max - $min) * 0.0 + $min)}}" max="<?=$max?>" min="<?=$min?>" step="1" oninput="
  this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[1].style.width=value+'%';
  children[5].style.left=value+'%';
  children[7].style.left=value+'%';children[11].style.left=value+'%';
  children[11].childNodes[1].innerHTML=this.value;" />

  <input type="range" style="z-index:99;" name="<?=$id?>Max" tabindex="0" value="{{round(($max - $min) * 1.0 + $min)}}" max="<?=$max?>" min="<?=$min?>" step="1" oninput="
  this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[3].style.width=(100-value)+'%';
  children[5].style.right=(100-value)+'%';
  children[9].style.left=value+'%';children[13].style.left=value+'%';
  children[13].childNodes[1].innerHTML=this.value;" />
</div>

<?php } ?>


@endsection