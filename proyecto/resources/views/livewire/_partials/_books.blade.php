<div class="markdown mt-8 mb-6 px-6 mx-auto lg:mr-auto xl:mx-0 xl:px:12">
    <div class="flex items-center markdown">
        <h1>@lang('admin.books_by_category',['category'=>$category->name])</h1>
    </div>
    <p class="mt-0 mb-4 text-gray-600">
        @lang('admin.books_by_category_description')
    </p>
    <hr class="my-8 border-b-2 border-gray-200"/>
</div>
<div class="container my-12 mx-auto px-4 md:px-12">
    <div class=" flex flex-wrap -mx-1 lg:-mx-4 grid grid-cols-1 md:grid-cols-3">
        @foreach($category->myBooks as $book)
            <div class="md:flex bg-white rounded-lg p-4 m-2" >
                <x-img-with-src-default class="h-16 w-16 md:h-24 md:w-24 rounded-full mx-auto md:mx-0 md:mr-6"
                                        :name="$category->name" :img="optional($book->photos()->first())->name"></x-img-with-src-default>
                <div class="text-center md:text-left">
                    <h2 class="text-lg"> {{$book->name}}</h2>
                    <div class="text-purple-500">{{$category->name}}</div>
                    <div class="text-gray-600"> {{$book->created_at->diffForHumans()}}</div>
                    <div class="space-y-6">
                        <div class="dropdown inline-block relative">
                            <button class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center">
                                <span class="mr-1">@lang('admin.OPCIONES')</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                            </button>
                            <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                                <li class=""><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="{{route('edit_book',$book)}}">@lang('admin.btn_edit')</a></li>
                                <li class=""><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="{{route('view_book',$book)}}">@lang('admin.view')</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</div>
