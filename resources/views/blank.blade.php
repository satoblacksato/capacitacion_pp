<x-master-layout>
    @section('content')
        <article class="flex flex-col my-4" style="width: 100%">
            <books-category category_name="{{$category->name}}" route="{{route('get_books',$category->slug)}}"></books-category>
        </article>
    @endsection
</x-master-layout>
