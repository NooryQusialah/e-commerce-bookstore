<x-dashboard.index>
    @php
        $totalPrice=0;
    @endphp
    <div class="row">
        <div class="col-md-12">
            <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>المشتري  </th>
                    <th>الكتاب  </th>
                    <th>السعر </th>
                    <th>عدد النسخ  </th>
                    <th>السعر الاجمالي </th>
                    <th>تاريخ الشراء  </th>
                </tr>
                </thead>
                <tbody>
                @foreach($allBooks as $book)
                    <tr>
                        <td>{{$book->user->name}}</td>
                        <td>{{ $book->book->title}}</td>

                        <td> {{$book->book->price}}</td>

                        <td>{{$book->numberOfCopies.'كتاب'}}</td>
                        <td>
                            {{$book->book->price * $book->numberOfCopies}}
                        </td>
                        <td> {{$book->created_at->diffForHumans()}}</td>
                        @php
                        $totalPrice+=$book->book->price * $book->numberOfCopies
                         @endphp
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="content-center">
            <p class="text-center">{{$totalPrice}}   الاجمالي كامل </p>
        </div>
    </div>

</x-dashboard.index>
