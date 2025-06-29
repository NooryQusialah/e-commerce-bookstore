@push('style')

        .fixed-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            background-color: #f9f9f9;
        }

        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .score-wrap {
            position: relative;
            display: inline-block;
            font-size: 0;
        }

        .stars-active,
        .stars-inactive {
            display: flex;
            white-space: nowrap;
            overflow: hidden;
        }

        .fa-star {
            font-size: 1rem;
            margin-right: 2px;
        }

        .stars-inactive {
            color: #ccc;
            position: absolute;
            top: 0;
            left: 0;
        }
@endpush

@foreach($books as $book)
    @if($book->numberOfCopies > 0)
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mt-3">
            <div class="card">
                <a href="{{ route('books.details', $book) }}">
                    <img src="{{ $book->coverImage ? asset($book->coverImage) : asset('images/default.png') }}"
                         alt="Cover"
                         class="card-img-top fixed-img">
                </a>
                <div class="card-body bg-light text-center d-flex flex-column justify-content-between">
                    <div>
                        <h6 class="card-title mb-1">
                            <a href="#" class="text-dark text-decoration-none">{{ $book->title }}</a>
                        </h6>
                        @if($book->category)
                            <a href="{{ route('books.categories.index', $book->category) }}"
                               class="text-muted text-decoration-none">
                                {{ $book->category->name }}
                            </a>
                        @endif
                    </div>

                    <h5 class="text-primary my-2">{{ $book->price }} $ </h5>

                    <div class="mt-2">
                        <div class="score-wrap position-relative d-inline-block">
                            <span class="stars-active" style="width: {{ $book->rate($book) * 20 }}%">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fa fa-star text-warning"></i>
                                @endfor
                            </span>
                            <span class="stars-inactive">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
