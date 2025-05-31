
<x-dashboard.index>

    <div class="row justify-content-center">
        <div class="card col-md-10">
            <div class="card-title text-center mt-3">تعديل بيانات  المؤلف </div>

            <div class="card-body">
                <form action="{{ route('admin.authors.update',$author->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="userName">الاسم  </label>
                            <input type="text"  id="userName" name="userName" class="form-control @error('userName') is-invalid @enderror" value="{{ $author->user->name }}">
                            @error('userName') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="userDescription">نبذة  </label>
                            <textarea type="text" required id="userDescription" name="userDescription" class="form-control @error('userDescription') is-invalid @enderror" value="{{ old('userDescription') }}" >{{$author->description}}</textarea>
                            @error('userDescription') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="userAddress"> العنوان </label>
                            <input type="text" required id="userAddress" name="userAddress" class="form-control @error('userAddress') is-invalid @enderror" value="{{ $author->address }}">
                            @error('userAddress') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="userPhone">رقم الهاتف </label>
                            <input type="text" required id="userPhone" name="userPhone" class="form-control @error('userPhone') is-invalid @enderror" value="{{ $author->phone }}">
                            @error('userPhone') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
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
