
<x-main-layout>
    <div class="container">
        <x-books.search-book/>
        <hr>
            <div class="mt-50 mb-50">
                <div class="row">
                    @if($books->count() > 0)
                        @foreach($books as $book)
                            @if($book->numberOfCopies > 0)
                                <x-books.book-card :book="$book" :title="$title"/>
                            @endif
                        @endforeach
                            @else
                            <div class="alert alert-info my-3" role="alert">
                                لايوجد كتب حتي الان
                            </div>
                    @endif

                </div>
            </div>

    </div>
</x-main-layout>
