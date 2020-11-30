<x-master-layout>
    @section('content')
        @foreach(QData::getLastBooks() as $book)
            <article class="flex flex-col shadow my-4" style="width: 100%">
                <!-- Article Image -->
                <a href="#" class="hover:opacity-75">
                    <x-img-with-src-default :img="$book->category->photo"></x-img-with-src-default>
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$book->category->name}}</a>
                    <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$book->name}}</a>
                    <p href="#" class="text-sm pb-3">
                        {{__('by')}} <a href="#" class="font-semibold hover:text-gray-800">{{$book->userCreated->name}}</a>, {{__('publish_on',['date'=>$book->created_at->toDayDateTimeString()])}}
                    </p>
                    <a href="#" class="pb-6">
                        {{ \Illuminate\Support\Str::substr($book->description,0,100) }}...
                    </a>
                    <a href="#" class="uppercase text-gray-800 hover:text-black">{{__('continue_reading')}} <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
        @endforeach
    @endsection
</x-master-layout>

{{QData::getUsersWithBook()}}
