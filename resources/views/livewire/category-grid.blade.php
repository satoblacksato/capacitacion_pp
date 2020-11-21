<div>
    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            @forelse($categories as $category)
                <!-- Column -->
                    <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

                        <!-- Article -->
                        <article class="overflow-hidden rounded-lg shadow-lg">

                            <a href="{{route('create_book',$category)}}">
                                <x-img-with-src-default :name="$category->name" :img="$category->photo"></x-img-with-src-default>
                            </a>

                            <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                                <h1 class="text-lg">
                                    <a class="no-underline hover:underline text-black" href="{{route('create_book',$category)}}">
                                       {{$category->name}}
                                    </a>
                                </h1>
                                <p class="text-grey-darker text-sm">
                                   {{$category->created_at->diffForHumans()}}
                                    {{-- (\Carbon\Carbon::createFromFormat('Y-m-d',$varcc))->diffForHumans() --}}
                                </p>
                            </header>

                            <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                                <a class="flex items-center no-underline hover:underline text-black" href="#">
                                    <img alt="Placeholder" class="block rounded-full" src="https://picsum.photos/32/32/?random">
                                    <p class="ml-2 text-sm">
                                        {{optional($category->userCreated)->name??__('admin.not_user')}}
                                    </p>
                                </a>
                                <a class="no-underline text-grey-darker hover:text-red-dark" href="#">
                                    <span class="hidden">Like</span>
                                    <i class="fa fa-heart"></i>
                                </a>
                            </footer>

                        </article>
                        <!-- END Article -->

                    </div>
                    <!-- END Column -->
            @empty

            @endforelse
        </div>
    </div>
</div>
