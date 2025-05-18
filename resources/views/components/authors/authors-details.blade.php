<div class="container pt-3 pb-3 text-body-secondary" style="font-family: 'Work Sans',sans-serif; font-size: 0.8rem; direction: rtl;">
    <div class="row g-4">
        @if($authors->count()>0)
            @foreach($authors as $author)
                <div class="col-md-3 d-flex align-items-stretch">
                    <div class="card bg-dark text-white shadow-lg p-4 w-100">
                        <div class="text-center">
                            <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="img-fluid w-75 p-3" alt="Product Image">
                        </div>
                        <div style="direction: rtl;">
                            @if($author->user_id)
                                <h5 class="text-center">{{$author->user->name}}</h5>
                            @endif
                            <h6>نبذه</h6>
                            <p>{{$author->description}}</p>
                            <h6>العنوان : {{$author->address}} </h6>
                            <div class="d-flex gap-3 flex-wrap mt-3">
                                @if($author->books->isEmpty())
                                    <h6 class="mt-3">لم يتم نشر أي كتاب حتى الآن</h6>
                                @else
                                    <a href="{{ route('books.authors.index', $author) }}" class="text-decoration-none">
                                        <h6 class="mt-3">
                                            عدد الكتب التي تم نشرها {{ $author->books->count() }}
                                            {{ $author->books->count() == 1 ? 'كتاب' : 'كتب' }}
                                        </h6>
                                    </a>
                                @endif
                            </div>

                            <div class="text-end mt-3">

                                <h5>للتوصل  : {{$author->phone}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        @else
            <div class="alert alert-info my-3" role="alert">
                لايوجد مؤلفوين
            </div>

        @endif

    </div>
</div>
