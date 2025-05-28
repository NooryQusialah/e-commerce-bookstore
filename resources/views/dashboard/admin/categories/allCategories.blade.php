<x-dashboard.index>
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('admin.categories.create')}}" class="mb-3">
                <button type="submit" class="btn-primary mb-3" >انشاء صنف </button></a>
            <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th> الصنف </th>
                    <th> الوصف </th>
                    <th>تعديل  </th>
                    <th>حذف  </th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->description}}</td>
                        <td>
                            <a href="{{route('admin.categories.edit',$category->id)}}">
                                <button type="submit" class="btn btn-warning">تعديل </button></a>
                        </td>
                        <td>
                            <form action="{{route('admin.categories.destroy',$category->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('هل انت متاكد ؟')">حذف </button>
                            </form>

                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-dashboard.index>
