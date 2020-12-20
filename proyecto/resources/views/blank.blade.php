<x-master-layout>
    @section('content')
        <article class="flex flex-col my-4" style="width: 100%">
            @if($identificator=='C')
                <books-category category_name="{{$category->name}}" route="{{route('books_by_category',$category->slug)}}"></books-category>
            @else
                <books-users user_name="{{$user->name}}" route="{{route('books_by_user',$user->slug)}}"></books-users>
            @endif

        </article>
    @endsection
</x-master-layout>
