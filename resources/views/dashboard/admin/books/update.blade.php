
<x-dashboard.index>

    <div class="row justify-content-center">
        <div class="card col-md-10">
            <div class="card-title text-center mt-3">تعديل بيانات الكتاب</div>

            <div class="card-body">
                <form action="{{ route('admin.books.update',$book->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">عنوان الكتاب</label>
                            <input type="text" required id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $book->title }}">
                            @error('title') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="isBn">الرقم التسلسلي</label>
                            <input type="text" required id="isBn" name="isBn" class="form-control @error('isBn') is-invalid @enderror" value="{{ $book->isBn}}">
                            @error('isBn') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cover_image">صورة الكتاب</label>
                            <input type="file"  id="cover_image" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" value="{{ $book->coverImage }}">
                            @error('cover_image') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="category">الصنف</label>
                            <select id="category" name="category" class="form-control @error('category') is-invalid @enderror">
                                <option disabled {{$book->category == null ? "selected":""}}>اختر تصنيفا</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{$book->category == $category ? "selected":""}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="authors">المؤلفون</label>
                            <select id="authors" name="authors[]" class="form-control @error('authors') is-invalid @enderror" multiple>
                                <option disabled {{$book->author()->count() == 0 ? 'selected':''}}>اختر المؤلفون</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{$book->author->contains($author) ? 'selected':''}}>{{ $author->user->name }}</option>
                                @endforeach
                            </select>
                            @error('authors') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="publisher">الناشر</label>
                            <select id="publisher" name="publisher" class="form-control @error('publisher') is-invalid @enderror">
                                <option disabled {{$book->publisher == null ? 'selected':''}} >اختر ناشرا</option>
                                @foreach($publishers as $publisher)
                                    <option value="{{ $publisher->id }}"{{$book->publisher ==$publisher ? 'selected':''}}>{{ $publisher->user->name }}</option>
                                @endforeach
                            </select>
                            @error('publisher') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="description">وصف الكتاب</label>
                            <textarea type="text" required id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" >{{$book->description}}</textarea>
                            @error('description') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="price">سعر الكتاب</label>
                            <input type="text" required id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ $book->price }}">
                            @error('price') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="publish_year">سنة النشر</label>
                            <input type="text" required id="publish_year" name="publish_year" class="form-control @error('publish_year') is-invalid @enderror" value="{{$book->publishYear}}">
                            @error('publish_year') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="numberOfPages">عدد الصفحات</label>
                            <input type="text" required id="numberOfPages" name="numberOfPages" class="form-control @error('numberOfPages') is-invalid @enderror" value="{{ $book->numberOfPages }}">
                            @error('numberOfPages') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="numberOfCopies">عدد النسخ</label>
                            <input type="text" required id="numberOfCopies" name="numberOfCopies" class="form-control @error('numberOfCopies') is-invalid @enderror" value="{{ $book->numberOfCopies}}">
                            @error('numberOfCopies') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
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
