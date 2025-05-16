
<x-main-layout>
    <div class="container">
        <x-books.search-book :action="route('books.search')"/>
        <hr>
            <div class="mt-50 mb-50">
                <div class="row">
                    @if($books->count() > 0)
                        <h3 class=" d-flex justify-content-center my-3 ">{{$title}}</h3>
                                <x-books.book-card :books="$books" :title="$title"/>
                            @else
                            <div class="alert alert-info my-3" role="alert">
                                لايوجد كتب حتي الان
                            </div>
                    @endif

                </div>
            </div>
    </div>
</x-main-layout>
