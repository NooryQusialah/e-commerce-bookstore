<x-dashboard.index>
    <div class=" row justify-content-center mb-3">
        <div class="card col-md-8">
            <div class="card-title text-center mt-3"> تعديل بيانات الصنف </div>
            <div class="card-body">

                <form action="{{route('admin.categories.update',$category->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label for="name_cat" class="col-md-4 col-form-label text-md-right"> اسم الصنف</label>
                        <div class="col-md-6">
                            <input type="text" required id="name_cat" name="name_cat" class="form-control @error('name_cat') is-invalid @enderror" value="{{$category->name}}" autocomplete="name_cat">
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
                            <textarea required id="description_cat" name="description_cat" class="form-control @error('description_cat') is-invalid @enderror" value="" autocomplete="description_cat" cols="30" rows="10">{{$category->description}}</textarea>
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
                            <button type="submit" class="btn btn-primary">عدل </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard.index>
