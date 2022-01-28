@extends('layouts.app')

@section('title', 'Product Page')

@section('content')

@if($product->id <= 30 && count($prodEdition) != 0)
    @php
        //dd($prodEdition );
        $month = null;
        $datetime = DateTime::createFromFormat('Y-m-d', $prodEdition[0]->date);
        $year = $datetime->format('Y');
        $montH = $datetime->format('m');
        if($montH == 1) $month = 'Janeiro';
        else if($montH == 2) $month = 'Fevereiro';
        else if($montH == 3) $month = 'Março';
        else if($montH == 4) $month = 'Abril';
        else if($montH == 5) $month = 'Maio';
        else if($montH == 6) $month = 'Junho';
        else if($montH == 7) $month = 'Julho';
        else if($montH == 8) $month = 'Agosto';
        else if($montH == 9) $month = 'Setembro';
        else if($montH == 10) $month = 'Outubro';
        else if($montH == 11) $month = 'Novembro';
        else if($montH == 12) $month = 'Dezembro';
    @endphp
@endif

<div class="row-md product d-flex shadow-lg p-3 mb-3 bg-body rounded offset-3">
    <div class="card-body col-md">
        <div class="carouselController">
            <div id="carouselExampleIndicators" class="carousel carouselProd slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                        <button type="button" id="bt" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" id="bt" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        @if($product->id <= 30)
                            @if(count($prodImages) == 3)
                                <button type="button" id="bt" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            @endif
                        @else
                            <button type="button" id="bt" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        @endif
                </div>
                @if($product->id > 30)
                    <div class="carousel-inner inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('/assets/502x.webp') }}" class="d-flex">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('/assets/will.jpg') }}" class="d-flex">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('/assets/hitler.webp') }}" class="d-flex">
                        </div>
                    </div>
                @else
                    <div class="carousel-inner imageController">
                        <div class="carousel-item active">
                            <img src="{{ asset('/assets/'.$prodImages[0]->getImage->path_image.'') }}" class="d-block">
                        </div>
                        @if(count($prodImages) == 3)
                            <div class="carousel-item">
                                <img src="{{ asset('/assets/'.$prodImages[1]->getImage->path_image.'') }}"class="d-block">
                            </div>;
                            <div class="carousel-item">
                                <img src="{{ asset('/assets/'.$prodImages[2]->getImage->path_image.'') }}"class="d-block">
                            </div>;
                        @else
                            <div class="carousel-item">
                                <img src="{{ asset('/assets/'.$prodImages[1]->getImage->path_image.'') }}"class="d-block">
                            </div>;
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body col-md-8">
        <div class="productDescription pt-5"> 
            <div class="Title and Main info">
                <div>
                    <span class="productName display-1 text-capitalize"> {{$product->product_name}} </span>
                </div>
                <div> 
                    @if($product->id > 30)
                        <span class="writer text-black-50 display-5"> J.K. Rowling </span> 
                    @else 
                        <span class="writer text-black-50 display-5"> {{$prodAuthor[0]->authorBelongs->name}}  </span>
                    @endif
                </div>
                <div class="tecInfo">
                    @if($product->id >30 || count($prodEdition) == 0)
                        <span class="editor"> Dom do Quixote, setembro de 2008 </span>
                        <span>&nbsp;‧&nbsp;</span>
                        <span class="isbn"> 9789899087088{{$product->id}} </span>
                        <span>&nbsp;‧&nbsp;</span>
                        <span class="productDetails"> <a href='#details'> product details </a> </span>
                    @else
                        <span class="editor"> {{$prodEdition[0]->editionEditor->name}}, {{$month}} of {{$year}} </span>
                        <span>&nbsp;‧&nbsp;</span>
                        <span class="isbn"> 9789899087088{{$product->id}} </span>
                        <span>&nbsp;‧&nbsp;</span>
                        <span class="productDetails"> <a href='#details'> product details </a> </span>
                    @endif
                </div>
            </div>
            <div class="rating">
                @php 
                    $temp = $product->star_rating;

                    for($i = 0; $i < 5; $i++){
                        if($temp >= 1){
                            $temp -= 1;
                            echo '<i class="bi bi-star-fill bigger p-1"></i>';
                        }
                        else if($temp == 0.5){
                            $temp -= 0.5;
                            echo '<i class="bi bi-star-half bigger p-1"></i>';
                        }
                        else{
                            echo '<i class="bi bi-star bigger p-1"></i>';
                        }
                    }
                @endphp
            </div>
            <div class="quote">
                <span> “The keys to life are running and reading. When you're running, there's a little person that talks to you and says, "Oh I'm tired. My lung's about to pop. I'm so hurt. There's no way I can possibly continue." You want to quit. If you learn how to defeat that person when you're running. You will how to not quit when things get hard in your life. For reading: there have been gazillions of people that have lived before all of us. There's no new problem you could have--with your parents, with school, with a bully. There's no new problem that someone hasn't already had and written about it in a book.” </span>
            </div>
            <div class="sale d-flex flex-column">
                <p class="price text-end"> <strong> {{$product->price}} </strong> <i class="bi bi-coin"></i> </p> 
                <span class="text-end">
                    @if( Auth::check()  && Auth::user()->id == 1 )
                        <button type="button" class="addWishlist btn rounded-pill fw-bold" disabled>  Add to wishlist <i class="bi bi-heart-fill"></i> </button>
                        <button type="button" class="addCart btn rounded-pill fw-bold" disabled> Add to cart  <i class="bi bi-bag-fill"></i> </button>
                    @elseif (Auth::check() && App\Http\Controllers\ProductController::inWishlist($product->id))
                        <button type="button" class="addWishlist btn rounded-pill fw-bold" style="background-color: #446b59" disabled> In Wishlist </button>
                        <button type="button" class="addCart btn rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#addCart"> Add to cart <i class="bi bi-bag-fill"></i> </button>
                    @elseif( !Auth::check())
                        <button type="button" class="addCart btn rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#addCart"> Add to cart <i class="bi bi-bag-fill"></i> </button>    
                    @else
                    <button type="button" id="btn_addW" value="{{$product->id}}" class="addWishlist btn rounded-pill fw-bold"> Add to wishlist <i class="bi bi-heart-fill"></i> </button>
                        <button type="button" class="addCart btn rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#addCart"> Add to cart <i class="bi bi-bag-fill"></i> </button>    
                    
                    @endif 
                </span>
                <p class="shipping text-end"> <strong> Shipping rates </strong> +3.97$ </p>
            </div>
        </div>
    </div>
</div>

<!-- Add To Cart Modal -->
<div>
    <form action="/addCart/{{$product->id}}" method="post">
        @csrf
        <div class="modal fade" id="addCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold fs-2" id="exampleModalLabel"> Add To Cart </h5>
                        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row-sm p-5 justify-content-center">
                        <div class="col-sm-8 offset-2">
                            <div class="row-md pb-5 text-center">
                                <span class="text-center fs-2 fw-bold"> Quantity </span>
                            </div>
                            <div class="row-md d-flex">
                                <div class="col-md text-end offset-0">
                                    <span class="input-group-btn">
                                        <button id="minus" class="inputBtn btn btn-white rounded-pill btn-minuse fw-bold fs-2" type="button"><i class="bi bi-cart-dash"></i></button>
                                    </span>
                                </div>
                                <div class="col-md">
                                    <input name="quantity" type="text" id="val" class="form-control no-padding add-color text-center height-25" maxlength="3" value="1">
                                </div>
                                <div class="col-md">
                                    <span class="input-group-btn">
                                        <button id="plus" class="inputBtn btn btn-red rounded-pill btn-plus fw-bold fs-2" type="button"><i class="bi bi-cart-plus"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </div>

                    <div class="modal-footer gap-3">
                        <button class="btn btn-primary rounded-pill fw-bold fs-5 text-capitalize" id="naosei"> Add Cart <i class="bi bi-bag-fill"></i> </button>
                    </div>
                    </div>  
                </div>
            </div>
        </div>
    </form>
</div>


<div id="details" class="row-md synopsis d-flex gap-3 offset-1">
    <div class="col-md card-body text-center shadow-lg p-4 mb-3 bg-body rounded "> 
        <span class="synopsisTitle"> About the book </span>
    </div>
    <div class="col-md-8 card-body shadow-lg p-4 mb-3 bg-body rounded">
        <div id="module" class="container d-flex flex-column">
            <h3 class="fw-bold">Synopsis</h3>
            <p class="collapse" id="collapseExample" aria-expanded="false" >
                {{$product->synopsis}}
            </p>
            <span class="text-end">
                <button class="showMore btn rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"></button>
            </span>
        </div>
    </div>

</div>

<div class="row-md details d-flex gap-3">
    <div class="col-md-8 d-block">
        <div class="bookSpecs text-center card-body shadow-lg p-4 mb-3 bg-body rounded">
            <div id="module" class="container d-flex flex-column">
                <h3 class="fw-bold p-3">Book Details</h3>
                <p class="collapse text-center" id="collapseExample1" aria-expanded="false">
                    @if($product->id >30 || count($prodEdition) == 0)
                        <strong> ISBN: </strong> 9789899087088{{$product->id}}  <br>
                        <strong> Edição/Reimpressão: </strong> 12-2021 <br>
                        <strong> Editor:</strong> Relógio D'Água <br>
                        <strong> Idioma:</strong>  Português <br>
                        <strong> Dimensões:</strong>  151 x 231 x 22 mm <br>
                        <strong> Encadernação:</strong>  Capa mole <br>
                        <strong> Páginas:</strong>  288 <br>
                        <strong> Tipo de Produto:</strong>  Livro <br>
                    @else 
                        <strong> ISBN: </strong> 9789899087088{{$product->id}}  <br>
                        <strong> Edição/Reimpressão: </strong> {{$montH}}-{{$year}} <br>
                        <strong> Editor:</strong> {{$prodEdition[0]->editionEditor->name}} <br>
                        <strong> Idioma:</strong>  Português <br>
                        <strong> Dimensões:</strong>  {{$product->book_width}} dm x {{$product->book_width}} dm x 0.022 dm <br>
                        <strong> Encadernação:</strong>  Capa mole <br>
                        <strong> Páginas:</strong>  288 <br>
                        <strong> Tipo de Produto:</strong>  Livro <br>
                    @endif
                </p>    
                <span class="text-end">
                    <button class="showMore btn rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                    </button>
                </span>
            </div>
        </div>
        <div class="authorMore card-body shadow-lg mb-3 bg-body rounded"> 
            <div class="d-flex flex-row gap-4">
                @if($product->id > 30)
                    <img src=" {{ asset('/assets/2.jpg') }}" class="authorImage">
                    <div class="d-flex flex-column authorDesc"> 
                        <p class="p-4">Joanne Rowling (born 31 July 1965), better known by her pen name J. K. Rowling, is a British author, philanthropist, film producer, and screenwriter. She is best known for writing the 'Harry Potter' fantasy series, which has won multiple awards and sold more than 500 million copies, becoming the best-selling book series in history. The books are the basis of a popular film series, over which Rowling had overall approval on the scripts and was a producer on the final films. She also writes crime fiction under the pen name Robert Galbraith.</p>
                        <span class="text-end py-4 px-4"> <button type="button" class="showMore moreAuthor btn rounded-pill">See More</button> </span>
                    </div>
                @else
                    <img src="{{ asset('/assets/'.$prodAuthor[0]->authorBelongs->id.'.jpg') }}" class="authorImage shadow-lg bg-body rounded">
                    <div class="d-flex flex-column authorDesc p-4"> 
                        <p class="p-4"> {{$prodAuthor[0]->authorBelongs->bio}} </p>
                        <span class="text-end py-4 px-4"> <button type="button" class="showMore moreAuthor btn rounded-pill">See More</button> </span>
                    </div>
                @endif
             </div>
        </div>
    </div>
    <div class="col-md bookSize card-body shadow-lg p-4 mb-3 bg-body rounded"> </div>
</div>

<div class="row-md d-flex justify-content-center mt-4 offset-1 review">
    <div class="col-sm-4 formCard">
        <div class="shadow-lg p-3 mb-3 bg-body rounded">
            <form class="addReviewForm" action="/review/{{$product->id}}" method="post">
                @csrf
                <div class="row-sm p-5 justify-content-center">
                    <div class="col-sm-8 offset-2">
                        <label for="comments" class="col-sm-2 col-form-label">Comment</label>
                        <input name="comment" 
                            id="commentID" class="form-control{{ $errors->has('comment') ? ' is-invalid ' : ''}} sizeControl" type="text" 
                            placeholder="Enter a maximum of 240 characters" aria-label="default input example">
                        <label for="ratings" class="col-sm-2 col-form-label">Rating</label>
                        <input name="rating" id="ratingID" class="form-control{{ $errors->has('rating') ? ' is-invalid ' : ''}} sizeControl" type="text" placeholder="0-5 rating, 0.5 step" aria-label="default input example">
                    </div>
                </div>

                <div class="row-sm text-center">
                    @if( Auth::check() )
                        @php
                        $returnValue = False;
                        foreach( $reviews as $rev ){
                            if( $rev->owner->id == auth()->user()->id ){
                                $returnValue = True;
                                break;
                            }
                        }
                        @endphp
                        @if($returnValue == False)
                            <button class="btn btn-primary addReviewBtn rounded-pill"> Add Review </button>
                        @else
                            <button class="btn btn-primary addReviewBtn rounded-pill" disabled>Add Review</button>
                        @endif
                        
                    @else 
                        <button class="btn btn-primary addReviewBtn rounded-pill"> Add Review </button>
                    @endif

                </div>
            </form>
            <div class="text-center text-danger p-0 m-0">
                @if ($errors->any())
                @foreach($errors->all() as $error)
                    <p> {{$error}} </p>
                @endforeach
                @endif
            </div>
        </div>  
    </div>
    <div class="col-sm">  
        @each('partials.review', $reviews, 'review')
    </div>
</div>

<br>

<script>

document.getElementById("plus").addEventListener("click", function(){
    val = document.getElementById("val").value;
    if(val < {{$product->stock}})
        document.getElementById("val").value = parseInt(val)+1;
});


document.getElementById("minus").addEventListener("click", function(){
    val = document.getElementById("val").value;
    if (val > 1 )
        document.getElementById("val").value = val-1;
});

</script>

<!--Books Suggestions-->
@endsection
