<x-dashboard.index>
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('admin.authors.create')}}" class="mb-3">
                <button type="submit" class="btn-primary mb-3" >انشاء مؤلف</button></a>
            <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>الاسم  </th>
                    <th>الصنف </th>
                    <th>الحال </th>
                    <th>تفاصيل  </th>
                    <th>تعديل  </th>
                    <th>حضر  </th>
                    <th>حذف  </th>
                </tr>
                </thead>
                <tbody>
                @foreach($authors as $author)
                    <tr>
                        @if($author->user_id !==null)
                            <td>{{$author->user->name}}</td>
                        @endif
                        <td>{{$author->address}}</td>
                        <td>
                            {{$author->phone}}
                        </td>
                        <td>
                            <a href="{{route('admin.authors.show',$author->id)}}">
                                <button type="submit" class="btn btn-primary">تفاصيل</button></a>
                        </td>
                        <td>
                            <a href="{{route('admin.authors.edit',$author->id)}}">
                                <button type="submit" class="btn btn-primary">تعديل </button></a>
                        </td>
                        <td>
                            <a href="{{ route('admin.authors.block', $author->id) }}">
                                <button type="submit" class="btn btn-warning">
                                    {{ $author->user && $author->user->active == 1 ? 'حظر' : 'رفع الحظر' }}
                                </button>
                            </a>
                        </td>

                        <td>
                            <form action="{{route('admin.authors.destroy',$author->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('هل انت متاكد ؟')">حذف  </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

</x-dashboard.index>
