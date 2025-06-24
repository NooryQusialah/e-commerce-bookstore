
@push('style')

    .fixed-img {
    width: 100%;
    height: 250px; /* fixed height for all images */
    object-fit: cover; /* crop to fit nicely */
    background-color: #f9f9f9; /* in case image is transparent or small */
    }

    .card {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    }
@endpush

@foreach($books as $book)
    @if($book->numberOfCopies > 0)
<div class="col-lg-3 col-md-4 col-sm-2 mt-2">
    <div class="card mb-3">
        <div>
            <div class="card-img-actions">
                <a href="{{route('books.details',$book)}}">
                <img src="{{ $book->coverImage ? asset($book->coverImage) : asset('images/default.png') }} " alt="no image"   class="card-img-top fixed-img">
                </a>
            </div>
        </div>
        <div class="card-body bg-light text-center">
            <div class="mb-2">
                <h6 class="font-weight-semibold card-title  mb-2">
                    <a href="#" class="text-default mb-2 text-decoration-none" data-abc="true">{{$book->title}}</a>
                </h6>
                <a href="{{route('books.categories.index',$book->category)}}" class="text-muted text-decoration-none" data-abc="true">
                    @if($book->category != null)
                        {{$book->category->name}}
                    @endif
                </a>
            </div>
            <h3 class="mb-0 font-weight-semibold">{{$book->price}}</h3>
            <div>
                <span class="score">
                    <div class="score-wrap">
                        <span class="stars-active" style="width: {{$book->rate($book)*20}}%">
                            <i class="fa fa-star star" aria-hidden="true"></i>
                            <i class="fa fa-star star" aria-hidden="true"></i>
                            <i class="fa fa-star star" aria-hidden="true"></i>
                            <i class="fa fa-star star" aria-hidden="true"></i>
                            <i class="fa fa-star star" aria-hidden="true"></i>
                        </span>
                        <span class="stars-inactive">
                            <i class="fa fa-star star" aria-hidden="true"></i>
                            <i class="fa fa-star star" aria-hidden="true"></i>
                            <i class="fa fa-star star" aria-hidden="true"></i>
                            <i class="fa fa-star star" aria-hidden="true"></i>
                            <i class="fa fa-star star" aria-hidden="true"></i>
                        </span>

                    </div>
                </span>
            </div>
        </div>
    </div>
</div>
    @endif
@endforeach
