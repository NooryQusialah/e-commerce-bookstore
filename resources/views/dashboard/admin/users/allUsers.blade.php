<x-dashboard.index>
    <div class="row">
        <div class="col-md-12">
            <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>الاسم  </th>
                    <th>الصنف </th>
                    <th>الحالة </th>
                    <th>حذف  </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>

                        @if($user->role_id==1)
                            <td>مستخدم </td>
                        @endif
                        <td>
                            <a href="{{ route('admin.users.block', $user->id) }}">
                                <button type="submit" class="btn btn-warning">
                                    {{ $user->active == 1 ? 'حظر' : 'رفع الحظر' }}
                                </button>
                            </a>
                        </td>
                        <td>
                            <form action="{{route('admin.users.destroy',$user->id)}}" method="post">
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
