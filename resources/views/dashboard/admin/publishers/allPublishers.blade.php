<x-dashboard.index>
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('admin.publishers.create')}}" class="mb-3">
                <button type="submit" class="btn-primary mb-3" >انشاء ناشر</button></a>
            <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>الاسم  </th>
                    <th>العنوان </th>
                    <th>الرقم </th>
                    <th>تفاصيل  </th>
                    <th>تعديل  </th>
                    <th>حضر  </th>
                    <th>حذف  </th>
                </tr>
                </thead>
                <tbody>
                @foreach($publishers as $publisher)
                    <tr>
                        @if($publisher->user_id !==null)
                            <td>{{$publisher->user->name}}</td>
                        @endif
                        <td>{{$publisher->address}}</td>
                        <td>
                            {{$publisher->phone}}
                        </td>
                        <td>
                            <a href="{{route('admin.publishers.show',$publisher->id)}}">
                                <button type="submit" class="btn btn-primary">تفاصيل</button></a>
                        </td>
                            <td>
                                <a href="{{route('admin.publishers.edit',$publisher->id)}}">
                                    <button type="submit" class="btn btn-primary">تعديل </button></a>
                            </td>
                            <td>
                                <a href="{{ route('admin.publishers.block', $publisher->id) }}">
                                    <button type="submit" class="btn btn-warning">
                                        {{ $publisher->user && $publisher->user->active == 1 ? 'حظر' : 'رفع الحظر' }}
                                    </button>
                                </a>
                            </td>

                        <td>
                            <form action="{{route('admin.publishers.destroy',$publisher->id)}}" method="post">
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
