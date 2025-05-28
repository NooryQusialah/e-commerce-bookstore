<x-dashboard.index>
    <div class=" row justify-content-center mb-3">
        <div class="card col-md-8">
            <div class="card-title text-center mt-3"> إضافة صنف جديد</div>
            <div class="card-body">

                <form action="{{route('admin.categories.store')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="name_cat" class="col-md-4 col-form-label text-md-right"> اسم الصنف</label>
                        <div class="col-md-6">
                            <input type="text" required id="name" name="name_cat" class="form-control @error('name_cat') is-invalid @enderror" value="{{old('name_cat')}}" autocomplete="name_cat">
                            @error('name_cat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description_cat" class="col-md-4 col-form-label text-md-right"> وصف الصنف</label>
                        <div class="col-md-6">
                            <textarea required id="description" name="description_cat" class="form-control @error('description_cat') is-invalid @enderror" value="{{old('description_cat')}}" autocomplete="description_cat" cols="30" rows="10"></textarea>
{{--                            <input type="text" required id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}" autocomplete="description">--}}
                            @error('description_cat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">أضف</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard.index>
