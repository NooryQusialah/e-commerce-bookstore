<h3 class=" d-flex justify-content-center my-3 ">{{$title}}</h3>
<div class="col-lg-3 col-md-4 col-sm-2 mt-2">
    <div class="card mb-3">
        <div>
            <div class="card-img-actions">
                <a href="{{route('books.details',$book)}}">
                <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="card-img img-fluid" width="96" height="350" alt="">
                </a>
            </div>
        </div>
        <div class="card-body bg-light text-center">
            <div class="mb-2">
                <h6 class="font-weight-semibold  mb-2">
                    <a href="#" class="text-default mb-2 text-decoration-none" data-abc="true">{{$book->title}}</a>
                </h6>
                <a href="#" class="text-muted text-decoration-none" data-abc="true">
                    @if($book->category != null)
                        {{$book->category->name}}
                    @endif
                </a>
            </div>
            <h3 class="mb-0 font-weight-semibold">{{$book->price}}</h3>
            <div>
                <i class="fa fa-star star"></i>
                <i class="fa fa-star star"></i>
                <i class="fa fa-star star"></i>
                <i class="fa fa-star star"></i>
            </div>
        </div>
    </div>
</div>
