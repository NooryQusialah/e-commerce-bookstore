<x-main-layout>
        <div class="container">
            <a class="btn btn-primary mb-2 mt-3" href="{{ route('books.index') }}"><i class="fas fa-plus"></i> شراء كتاب جديد</a>
            <div class="d-flex justify-content-center row">
                <div class="col-md-10">
                    @if($myBooks->count())
                        @foreach($myBooks as $book)
                            <div class="row p-2 bg-white border rounded mb-3">
                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="{{ $book->coverImage ? asset($book->coverImage) : asset('images/default.png') }} " alt="no image"></div>
                                <div class="col-md-6 my-auto">
                                    <h5><a href="{{ route('books.details', $book) }}">{{ $book->title }}</a></h5>
                                    <div class="d-flex flex-row">
                                        <div class="ratings mr-2">
                                    <span class="score">
                                        <div class="score-wrap">
                                            <span class="stars-active" style="width:{{ $book->rate()*20 }}%">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </span>
                                            <span class="stars-inactive">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-1 spec-1"><span>{{ $book->category != null ? $book->category->name : '' }}</span></div>
                                    <div class="mt-1 mb-1 spec-1"><span>تاريخ الشراء: {{ $book->pivot->created_at->diffForHumans()}}<br></span></div>
                                    <p class="text-justify text-truncate para mb-0">عدد النسخ: {{ $book->pivot->numberOfCopies}}<br><br></p>
                                </div>
                                <div class="align-items-center align-content-center col-md-3 border-left my-auto">
                                    <div class="d-flex flex-row align-items-center">
                                        <h4 class="mr-1">{{ $book->price }}$</h4>
                                    </div>
                                    <h6 class="text-success">المجموع الكلي: {{ $book->pivot->numberOfCopies * $book->price}}$</h6>
                                    <div class="d-flex flex-column mt-4"><a href="{{ route('books.details', $book) }}" class="btn btn-outline-primary btn-sm" type="button">تفاصيل الكتاب</a></div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-danger mx-auto" role="alert">
                            لايوجد مشتريات بعد، ستجد هنا جميع المنتجات التي اشتريتها
                        </div>
                    @endif
                </div>
            </div>
        </div>
</x-main-layout>
