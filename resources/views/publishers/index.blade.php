<x-main-layout>
    <x-books.search-book :action="route('publishers.search')" placeholder="ابحث من هنا عن ناشرؤن "/>
    <hr>
      <x-publishers.publisher-details :publishers="$publishers"/>

</x-main-layout>
