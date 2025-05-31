<x-dashboard.index>
    <div class=" -mt-6 pt-3 pb-3 container d-flex align-items-center justify-content-center min-vh-200  text-body-secondary" style="font-family: 'Work Sans'; font-size: 0.8rem; direction: rtl;">
        <div class="-mt-6 card bg-white text-black shadow-lg p-4 w-100">
            <div class="row flex-row" style="direction: ltr;">
                <div class="col-md-6 text-center d-flex align-items-center justify-content-center">
                    <img src="{{ $author->user->profileImage ? asset($author->user->profileImage) : asset('images/default.png') }}" class="img-fluid w-75 p-3" alt="author profileImage">
                </div>
                <div class="col-md-6 py-md-5" style="direction: rtl;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>الاسم : {{$author->user->name}}</h2>
                    </div>
                    <h4>النبذه </h4>
                    <p> {{$author->description}}</p>
                    <h6> العنوان  :  {{$author->address}}</h6>

                    <h6>رقم الهاتف  :   {{$author->phone}}</h6>


                    <div class="d-flex gap-3 flex-wrap mt-3">
                        <div class="form-check">
                            <input class="form-check-input d-none" type="radio" name="size1" id="size1s" checked>
                            <label class="btn btn-outline-secondary" for="size1s">
                                <div><strong>عدد الكتب المؤلفة </strong></div>
                                <div>{{$author->books()->count()}} </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.index>
