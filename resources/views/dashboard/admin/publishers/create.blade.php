
<x-dashboard.index>

    <div class="row justify-content-center">
        <div class="card col-md-10">
            <div class="card-title text-center mt-3">إضافة ناشر جديد</div>

            <div class="card-body">
                <form action="{{ route('admin.publishers.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="userName">الاسم  </label>
                            <input type="text"  id="userName" name="userName" class="form-control @error('userName') is-invalid @enderror" value="{{ old('userName') }}">
                            @error('userName') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="userEmail"> الايميل </label>
                            <input type="email" required id="userEmail" name="userEmail" class="form-control @error('userEmail') is-invalid @enderror" value="{{ old('userEmail') }}">
                            @error('userEmail') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="userDescription">نبذة  </label>
                            <textarea type="text" required id="userDescription" name="userDescription" class="form-control @error('userDescription') is-invalid @enderror" value="{{ old('userDescription') }}" ></textarea>
                            @error('userDescription') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="userAddress"> العنوان </label>
                            <input type="text" required id="userAddress" name="userAddress" class="form-control @error('userAddress') is-invalid @enderror" value="{{ old('userAddress') }}">
                            @error('userAddress') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="userPassword"> كلمة المرور </label>
                            <input type="password" required id="userPassword" name="userPassword" class="form-control @error('userPassword') is-invalid @enderror" value="{{ old('userPassword') }}">
                            @error('userPassword') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="userPhone">رقم الهاتف </label>
                            <input type="text" required id="userPhone" name="userPhone" class="form-control @error('userPhone') is-invalid @enderror" value="{{ old('userPhone') }}">
                            @error('userPhone') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="userProfileImage">صورة </label>
                            <input type="file" required id="userProfileImage" name="userProfileImage" class="form-control @error('userProfileImage') is-invalid @enderror" value="{{ old('userProfileImage') }}">
                            @error('userProfileImage') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
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
