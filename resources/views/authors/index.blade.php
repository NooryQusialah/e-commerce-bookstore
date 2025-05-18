<x-main-layout>
    <x-books.search-book :action="route('authors.search')" placeholder="ابحث من هنا عن مولفؤن  "/>
    <hr>
    <x-authors.authors-details :authors="$authors"/>
</x-main-layout>
