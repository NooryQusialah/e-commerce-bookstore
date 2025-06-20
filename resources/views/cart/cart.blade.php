<x-main-layout>

    <div class="row justify-content-center mt-2 ml-2 pr-2 ">
        <div class="col-md-12">
            <div class="card ml-2 mr-2">
                <div class="card-title text-center mb-1 text-muted fw-bold">
                    عربة التسوق
                </div>
                <div class="card-body">
                    @if($allBooksInCart->count())
                        @php($totalPrice=0)
                        @foreach($allBooksInCart as $book)
                            @php($totalPrice+= $book->price * $book->pivot->numberOfCopies)
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap mt-1">
                                    <div class="w-100 ">
                                        <div class="d-flex justify-content-between ">
                                            <div>
                                                <h5 class="mb-1">عنوان الكتاب:  {{$book->title}} </h5>
                                                <p class="mb-1 text-muted">سعر الكتاب : {{$book->price}}$</p>
                                                <p class="mb-1 text-muted">الكمية: {{$book->pivot->numberOfCopies}}</p>
                                                <p class="mb-1 text-muted fw-bold">الإجمالي: {{$book->price * $book->pivot->numberOfCopies}}$</p>
                                            </div>
                                            <div class="d-flex flex-column gap-2">
                                                <form action="{{route('removeOneCart',$book->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-warning btn-sm">حذف نسخة واحدة</button>
                                                </form>
                                                <form action="{{route('removeAllCart',$book->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">حذف الكل</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                        <div class="text-center mt-1">
                            <h4 class="mb-1 mt-1 text-muted fw-bold">اجمالي المبلغ كامل :   {{$totalPrice}} $</h4>
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            لايوجد كتب في السلة
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
