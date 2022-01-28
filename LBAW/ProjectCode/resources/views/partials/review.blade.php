
@if( !$review->banned($review->id_user))
  <div class="reviewCard shadow-lg p-3 mb-1 bg-body rounded">
    <div class="card-body px-5">
      <div class="d-flex gap-3 align-items-center">
        <h3 class="m-0 text-capitalize">{{$review->owner->username}}</h3>
        @if(Auth::check())
          @if( Auth::user()->id == 1 && $review->owner->id != 1)
            <button type="button" class="btn rounded-pill revBut" id="delBut" data-bs-toggle="modal" data-bs-target="#banUser{{$review->id_user}}"> Ban User </button>
          @endif
        @endif
      </div>
      <div class="reviewRating pt-1 pb-1">
        @php 
          $temp = $review->star_rating;
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
      <div class="comment"> {{ $review->comment }} </div>
      @if(Auth::check())
        @if( Auth::user()->id == $review->id_user)
          <div class="reviewButtons text-end pt-2">
              <form class="deleteForm" action="/rev/{{$review->id}}/{{$review->id_product}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn rounded-pill revBut" id="delBut"> Delete </button>
              </form>
              <!-- Button trigger modal -->
              <button type="button" class="btn rounded-pill revBut m-0" id="editBut" data-bs-toggle="modal" data-bs-target="#editReview">
                  Edit
              </button>

              <!-- Modal -->
              <form action="/product/{{$review->id}}/{{$review->id_product}}" method="post">
                @csrf
                @method('PUT')
                <div class="modal fade" id="editReview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  " id="exampleModalLabel"> <strong> Edit review </strong></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="row-sm p-5 justify-content-center">
                              <div class="col-sm-8 offset-2">
                                  <label for="comments" class="col-sm-2 col-form-label">Comment</label>
                                  <input name="commentEdit" 
                                      id="commentID" class="form-control{{ $errors->has('commentEdit') ? ' is-invalid ' : ''}} sizeControl" type="text" 
                                      value="{{$review->comment}}" aria-label="default input example" rows="10" >
                                  <label for="ratings" class="col-sm-2 col-form-label">Rating</label>
                                  <input name="ratingEdit" id="ratingID" class="form-control{{ $errors->has('ratingEdit') ? ' is-invalid ' : ''}}" type="text" placeholder="{{$review->star_rating}}" aria-label="default input example">
                              </div>
                            </div>

                          <div class="modal-footer gap-3">
                            <button class="btn btn-primary rounded-pill" id="naosei"> Edit Review </button>
                          </div>
                        </div>  
                      </div>
                  </div>
                </div>
                <div class="text-center text-danger p-0 m-0">
                  @if ($errors->any())
                    @foreach($errors->all() as $error)
                        <p> {{$error}} </p>
                    @endforeach
                  @endif
                </div>
              </form>
          </div>
        @endif
      @endif
    </div>
  </div>

  <!-- Add To Cart Modal -->
  <div>
    <form action="/banProd/{{$review->id_user}}/{{$review->id_product}}" method="post">
        @csrf
        @method('post')
        <div class="modal fade" id="banUser{{$review->id_user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold fs-2" id="exampleModalLabel"> Ban User </h5>
                        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row-sm p-5 justify-content-center">
                        <div class="col-sm-8 offset-2">
                            <div class="row-md pb-5 text-center">
                                <span class="text-center fs-2 fw-bold"> Reason </span>
                            </div>
                            <div class="row-md d-flex offset-1">
                              <input name="Reason" 
                                  id="banID" class="form-control{{ $errors->has('banUser') ? ' is-invalid ' : ''}} sizeControl" type="text" 
                                  placeholder="Enter a maximum of 240 characters" aria-label="default input example">
                            </div>
                        </div>
                      </div>

                    <div class="modal-footer gap-3">
                        <button type="submit" class="btn btn-primary rounded-pill fw-bold fs-5 text-capitalize" id="naosei"> Ban User <i class="bi bi-exclamation-octagon-fill"></i></button>
                    </div>
                    </div>  
                </div>
            </div>
        </div>
    </form>
  </div>
@endif