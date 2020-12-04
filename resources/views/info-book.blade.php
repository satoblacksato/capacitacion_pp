<x-master-layout>
    @section('content')

        <article class="flex flex-col my-4" style="width: 100%">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                {{ $book->name }}
            </h1>
            <br/>

        <div class="flex flex-wrap">
            <div class="rounded overflow-hidden shadow-lg" style="width: 100%">
                <x-img-with-src-default :img="optional($book->category)->photo" class="w-full"></x-img-with-src-default>
                <div class="px-6 py-4">
                    <span class="font-italic font-bold">{{__('admin.author',['author'=>optional($book->userCreated)->name])}}</span>
                    <div class="font-bold text-xl mb-2">{{$book->name}}</div>
                    <p class="text-gray-700 text-base">
                        {{$book->description}}
                    </p>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{$book->created_at->diffForHumans()}}</span>
                </div>
            </div>
        </div>
            <br/>
        <h1 class="font-semibold text-xl text-gray-800 leading-tight text-center">
           {{__('admin.PHOTO')}}
        </h1>
        <div class="flex flex-wrap p-5">
                @foreach($book->photos as $photo)
                <div class="w-1/6  rounded overflow-hidden shadow-lg m-5">
                    <x-img-with-src-default :img="$photo->name" class="w-full"></x-img-with-src-default>
                </div>
                @endforeach
        </div>
        @component('_partials._disqus')
        @endcomponent
    </article>
  @endsection
</x-master-layout>
