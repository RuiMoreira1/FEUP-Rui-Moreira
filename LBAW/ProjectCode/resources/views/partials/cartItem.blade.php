

<div class="row-md d-flex align-items-center  card-body shadow-lg p-4 mb-3 bg-body rounded">

    <div class="col-md-4 prodCartImage">
        <img src="{{ asset('/assets/'.$product->cartProduct->productImages[0]->getImage->path_image.'') }}" class="d-block">
    </div>
    <div class="col-md-5">
        <div class="fw-bold fs-1 p-3 text-center text-capitalize"> {{$product->cartProduct->product_name }} </div>
        <div class="input-group row-md mt-5 gap-2">
            <div class="col-md text-end offset-0">
                <span class="input-group-btn">
                    <button id="minus{{$product->id_product}}" class="inputBtn btn btn-white rounded-pill btn-minuse fw-bold fs-2" type="button"><i class="bi bi-cart-dash"></i></button>
                </span>
            </div>
            <div class="col-md">
                <input type="text" id="val{{$product->id_product}}" class="form-control no-padding add-color text-center height-25 fw-bold fs-5" maxlength="3" value="{{$product->quantity}}" disabled>
            </div>
            <div class="col-md">
                <span class="input-group-btn">
                    <button id="plus{{$product->id_product}}" class="inputBtn btn btn-red rounded-pill btn-plus fw-bold fs-2" type="button"><i class="bi bi-cart-plus"></i></button>
                </span>
            </div>
        </div><!-- /input-group -->
    </div>
    <div class="col-md">
        <p class="text-center fs-1 fw-bold"> Price </p>
        <div class="text-center">
            <span id="priceChange{{$product->id_product}}" class="fs-1">{{number_format((float)$product->cartProduct->price, 2, '.', '')}}</span> 
            <span class="fs-1"><i class="bi bi-coin"></i> </span> 
        </div>
    </div>
    <div class="col-md text-center">
        <form class="deleteForm" action="/cart/{{$product->id_product}}" method="post">
              @csrf
              @method('delete')
              <button type="submit" class="removeCart btn rounded-pill fw-bold"> Remove From Cart <i class="bi bi-bag-fill"></i> </button>
        </form>
    </div>

</div>


<script>

//const val = document.getElementById("val{{$product->id_product}}").value

document.getElementById("priceChange{{$product->id_product}}").textContent = {{$product->cartProduct->price}}*{{$product->quantity}};

document.getElementById("plus{{$product->id_product}}").addEventListener("click", function(){
    val = document.getElementById("val{{$product->id_product}}").value;
    document.getElementById("val{{$product->id_product}}").value = parseInt(val)+1;

    
    priceVal = {{$product->cartProduct->price}} * parseInt(document.getElementById("val{{$product->id_product}}").value);

    document.getElementById("priceChange{{$product->id_product}}").textContent = priceVal.toFixed(2);

});


document.getElementById("minus{{$product->id_product}}").addEventListener("click", function(){
    val = document.getElementById("val{{$product->id_product}}").value;
    if (val > 1)
        document.getElementById("val{{$product->id_product}}").value = val-1;

    priceVal = {{$product->cartProduct->price}} * parseInt(document.getElementById("val{{$product->id_product}}").value);

    document.getElementById("priceChange{{$product->id_product}}").textContent = priceVal.toFixed(2);
});



</script>