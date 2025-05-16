<x-main-layout>
    <x-books.search-book :action="route('categories.search')" placeholder="ابحث من هنا عن قسم "/>
    <hr>
    <x-categories.categories :categories="$categories"/>
</x-main-layout>
