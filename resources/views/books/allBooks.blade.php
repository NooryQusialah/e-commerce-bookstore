<x-main-layout>
    <div class="container py-4">
        <x-books.search-book :action="route('books.search')" />
        <hr>

        <div class="my-4">
            <div class="row">
                @if($books->count() > 0)
                    <h3 class="text-center my-3 w-100">{{ $title }}</h3>
                    <x-books.book-card :books="$books" :title="$title"/>
                @else
                    <div class="alert alert-info text-center w-100 my-3" role="alert">
                        لا يوجد كتب حتى الآن
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-main-layout>
