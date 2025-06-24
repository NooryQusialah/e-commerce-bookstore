
<div class="row">
    <div class="col-md-12">
        <a href="{{route('admin.books.create')}}" class="mb-1">
            <button type="submit" class="btn-primary mb-1" >انشاء كتاب</button></a>
        <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>العنوان </th>
                <th>التصنيف </th>
                <th>المؤلفون </th>
                <th>الناشر </th>
                <th>الكمية </th>
                <th>تفاصيل  </th>
                <th>تعديل  </th>
                <th>حذف  </th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{$book->title}}</td>
                    <td>{{ $book->category?->name ?? 'لا يوجد قسم' }}</td>
                    <td>
                        @if($book->author->count() > 0)
                            @foreach($book->author as $author)
                                {{ !$loop->first ? ' و ' : '' }}
                                {{ $author->user?->name ?? 'مجهول' }}
                            @endforeach
                        @else
                            لا يوجد مؤلف
                        @endif
                    </td>

                    <td>
                        @if($book->publisher()->count()>0)

                                {{$book->publisher->user?->name ?? 'مجهول '}}
                            @else
                            لايوجد ناشر
                        @endif
                    </td>
                    <td>{{$book->numberOfCopies.'كتاب'}}</td>
                    <td>
                        <a href="{{route('admin.books.show',$book->id)}}">
                            <button type="submit" class="btn btn-primary">تفاصيل</button></a>
                    </td>
                    <td>
                        <a href="{{route('admin.books.edit',$book->id)}}">
                            <button type="submit" class="btn btn-warning">تعديل </button></a>
                    </td>
                    <td>
                        <form action="{{route('admin.books.destroy',$book->id)}}" method="post">
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

@push('scripts')
    <script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#books-table').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/2.3.2/i18n/ar.json"
                },
                "pageLength": 5,
            });
        });
    </script>

@endpush
