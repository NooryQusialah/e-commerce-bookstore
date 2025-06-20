<x-main-layout>
    <div class="pt-3 pb-3 container d-flex align-items-center justify-content-center min-vh-200 text-body-secondary" style="font-family: 'Work Sans'; font-size: 0.8rem; direction: rtl;">
        <div class="card bg-dark text-white shadow-lg p-4 w-100">
            <div class="row flex-row" style="direction: ltr;">
                <!-- Book image and info -->
                <div class="col-md-6 text-center d-flex align-items-center justify-content-center">
                    <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="img-fluid w-75 p-3" alt="Product Image">
                </div>
                <div class="col-md-6 py-md-5" style="direction: rtl;">
                    <!-- Book details -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>{{ $book->title }}</h2>
                        @if($book->isBn)
                            <h6>الرقم التسلسلي :  {{ $book->isBn }}</h6>
                        @endif
                    </div>
                    <p>{{ $book->description }}</p>
                    @if($book->category)
                        <h6>قسم : {{ $book->category->name }}</h6>
                    @endif
                    @if($book->publisher_id)
                        <h6>الناشر : {{ $book->publisher->user->name }}</h6>
                    @endif
                    @if($book->author->count() > 0)
                        <h6>المؤلفون:
                            @foreach($book->author as $author)
                                {{ $loop->first ? '' : ' و ' }}{{ $author->user->name }}
                            @endforeach
                        </h6>
                    @endif
                    <h6>يحتوي علي : {{ $book->numberOfPages }} ورقة </h6>
                    <h6>سنة النشر : {{ $book->publishYear }}</h6>
                    <h6>عدد النسخ : {{ $book->numberOfCopies }}</h6>

                    <!-- Rating display -->
                    <div class="mb-2">
                        <span class="score">
                            <div class="score-wrap">
                                <span class="stars-active" style="width: {{ $book->rate($book) * 20 }}%">
                                    @for($i=0; $i<5; $i++)
                                        <i class="fa fa-star star" aria-hidden="true"></i>
                                    @endfor
                                </span>
                                <span class="stars-inactive">
                                    @for($i=0; $i<5; $i++)
                                        <i class="fa fa-star star" aria-hidden="true"></i>
                                    @endfor
                                </span>
                            </div>
                        </span>
                        <span class="text-secondary ms-2"> {{ $book->ratings()->count() }} تقييم</span>
                    </div>

                    <!-- Price -->
                    <div class="d-flex gap-3 flex-wrap mt-3">
                        <div class="form-check">
                            <input class="form-check-input d-none" type="radio" name="size1" id="size1s" checked>
                            <label class="btn btn-outline-secondary" for="size1s">
                                <div><strong>السعر</strong></div>
                                <div>{{ $book->price }} $</div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Rating form -->
                @auth
                    <h4 class="mb-3">قيم هذا الكتاب </h4>
                    <div class="rating">
                        @for ($i = 5; $i >= 1; $i--)
                            <span class="rating-star {{ auth()->user()->rated($book) && auth()->user()->bookRating($book)->value == $i ? 'checked' : '' }}" data-value="{{ $i }}"></span>
                        @endfor
                    </div>
                @endauth
            </div>

            <div class="row mt-4 align-items-center">
                <div class="col">
                    <div class="d-flex gap-3 flex-wrap mt-3"></div>
                </div>
                <div class="col text-end">
                    <button class="btn btn-outline-success">أضف إلى السلة</button>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.rating-star').click(function () {
                var submitStars = $(this).data('value');
                $.ajax({
                    type: 'POST',
                    url: '/books/{{ $book->id }}/rate',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        value: submitStars
                    },
                    success: function () {
                        location.reload();
                    },
                    error: function (xhr) {
                        alert('حدث خطأ أثناء التقييم');
                        console.log(xhr.responseText); // Log Laravel error
                    }
                });
            });
        });
    </script>
@endpush
</x-main-layout>

