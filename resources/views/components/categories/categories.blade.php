
<div class="container pt-4 pb-4 text-body-secondary" style="font-family: 'Work Sans'; font-size: 0.8rem; direction: rtl;">

    <div class="row">
        @if($categories->count() > 0 )
        @foreach($categories as $category)
            <div class="col-md-4 mb-4 d-flex">
                <div class="card bg-dark text-white shadow-lg p-3 w-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{route('books.categories.index',$category)}}" class="text-decoration-none">
                            <h5>قسم: {{$category->name}}</h5>
                        </a>
                    </div>
                    <h6 class="mt-2 ">الوصف:</h6>
                    <p class="mb-2">{{$category->description}}</p>

                    <div class="mt-auto">

                        @if($category->books->count()==0)
                            <h6 class="mt-3">
                               لا يحتوي على اي كتاب
                            </h6>
                        @elseif($category->books->count()==1)
                            <h6 class="mt-3">
                                يحتوي على {{$category->books->count()}} كتاب
                            </h6>

                        @else
                            <h6 class="mt-3">
                                يحتوي على {{$category->books->count()}} كتاب
                            </h6>
                        @endif
                    </div>
                 </div>
            </div>

        @endforeach
        @else
            <div class="alert alert-info my-3" role="alert">
                لايوجد اقسام حتي الان
            </div>
        @endif
    </div>
</div>
