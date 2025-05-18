<div class="container pt-3 pb-3 text-body-secondary" style="font-family: 'Work Sans',sans-serif; font-size: 0.8rem; direction: rtl;">
    <div class="row g-4">
       @if($publishers->count()>0)
        @foreach($publishers as $publisher)
        <div class="col-md-3 d-flex align-items-stretch">
            <div class="card bg-dark text-white shadow-lg p-4 w-100">
                <div class="text-center">
                    <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="img-fluid w-75 p-3" alt="Product Image">
                </div>
                <div style="direction: rtl;">
                    @if($publisher->user_id)
                        <h5 class="text-center">{{$publisher->user->name}}</h5>
                    @endif
                    <h6>نبذه</h6>
                    <p>{{$publisher->description}}</p>
                    <h6>العنوان : {{$publisher->address}} </h6>
                    <div class="d-flex gap-3 flex-wrap mt-3">
                        @if($publisher->books->count()==0)
                            <h6 class="mt-3">
                                لم يتم نشر اي كتاب حتئ الان
                            </h6>
                        @elseif($publisher->books->count()==1)

                            <a href="{{route('books.publishers.index',$publisher)}}" class="text-muted text-decoration-none">
                                <h6 class="mt-3">
                                    عدد الكتب التي تم نشرها {{$publisher->books->count()}} كتاب
                                </h6>
                            </a>
                        @else
                            <a href="{{route('books.publishers.index',$publisher)}}" class="text-decoration-none">
                            <h6 class="mt-3">
                                عدد الكتب التي تم نشرها {{$publisher->books->count()}} كتاب
                            </h6>
                            </a>
                        @endif
                    </div>

                    <div class="text-end mt-3">

                        <h5>للتوصل معنا : {{$publisher->phone}}</h5>
                    </div>
                </div>
            </div>
        </div>
            @endforeach

        @else
            <div class="alert alert-info my-3" role="alert">
                لايوجد ناشرؤن
            </div>

        @endif
        <!-- Repeat the .col-md-3 block 3 more times to get 4 cards in a row -->
        <!-- Copy and paste the above block 3 times below -->


    </div>
</div>
