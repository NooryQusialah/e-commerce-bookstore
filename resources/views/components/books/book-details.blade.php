<x-main-layout>
    <div class=" pt-3 pb-3 container d-flex align-items-center justify-content-center min-vh-200  text-body-secondary" style="font-family: 'Work Sans'; font-size: 0.8rem; direction: rtl;">
                    <div class="card bg-dark text-white shadow-lg p-4 w-100">
                        <div class="row flex-row" style="direction: ltr;">
                            <div class="col-md-6 text-center d-flex align-items-center justify-content-center">
                                <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="img-fluid w-75 p-3" alt="Product Image">
                            </div>
                            <div class="col-md-6 py-md-5" style="direction: rtl;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2>{{$book->title}}</h2>
                                    @if($book->isBn)
                                        <h6>الرقم التسلسلي :  {{$book->isBn}}</h6>
                                    @endif
                                </div>
                                <p> {{$book->description}}</p>
                                @if($book->category)
                                    <h6>قسم :   {{$book->category->name}}</h6>
                                @endif
                                @if($book->publisher_id)
                                    <h6>الناشر : {{$book->publisher->user->name}}</h6>
                                @endif
                                @if($book->author->count() > 0)
                                    <h6>المؤلفون:
                                        @foreach($book->author as $author)
                                            {{ $loop->first ? '' : ' و ' }}{{ $author->user->name }}
                                        @endforeach
                                    </h6>
                                @endif
                                <h6>يحتوي علي :  {{$book->numberOfPages}} ورقة </h6>
                                <h6>سنة النشر : {{$book->publishYear}}</h6>
                                <h6>عدد النسخ : {{$book->numberOfCopies}}</h6>
                                <div class="mb-2">
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star-half-full text-warning"></span>
                                    <span class="text-secondary ms-2">1590 مراجعة</span>
                                </div>

                                <div class="d-flex gap-3 flex-wrap mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input d-none" type="radio" name="size1" id="size1s" checked>
                                        <label class="btn btn-outline-secondary" for="size1s">
                                            <div><strong>السعر</strong></div>
                                            <div>{{$book->price}} $</div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 align-items-center">
                            <div class="col">
                                <div class="d-flex gap-3 flex-wrap mt-3">

                                </div>
                            </div>
                            <div class="col text-end">
                                <button class="btn btn-outline-success">أضف إلى السلة</button>
                            </div>
                        </div>
                    </div>
                </div>
</x-main-layout>
