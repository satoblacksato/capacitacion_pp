<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name')}}</title>
    <meta name="author" content="">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
            integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

    <script src="{{asset('js/app.js')}}" defer></script>

    <link rel="stylesheet" href="{{ asset('css/global_custom.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

    <script src="{{asset('js/global_custom.js')}}" defer></script>
    @component('_partials._events-realtime')
    @endcomponent

    @component('_partials._chat')
    @endcomponent

    @stack('script-custom')

</head>
<body class="bg-white font-family-karla">

<!-- Top Bar Nav -->
<nav class="w-full py-4 bg-blue-800 shadow">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between">
        @if (Route::has('login'))
            <nav>
                <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                    @auth
                        <li><a class="hover:text-gray-200 hover:underline px-4"
                               href="{{ url('/dashboard') }}">Dashboard</a></li>
                    @else
                        <li><a class="hover:text-gray-200 hover:underline px-4" href="{{ route('login') }}">Login</a>
                        </li>

                        @if (Route::has('register'))
                            <li><a class="hover:text-gray-200 hover:underline px-4" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endif
                </ul>
            </nav>
        @endif

        @can('change-lang')
            <div class="flex items-center text-lg no-underline text-white pr-6">
                <a class="" href="{{route('change_lang','es')}}">
                    {{__('spanish')}}
                </a>
                <a class="pl-6" href="{{route('change_lang','en')}}">
                    {{__('english')}}
                </a>
            </div>
        @endcan
    </div>

</nav>

<!-- Text Header -->
<header class="w-full container mx-auto">
    <div class="flex flex-col items-center py-12">
        <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#">
            {{__('site_title')}}
        </a>
        <p class="text-lg text-gray-600">
            {{__('site_description')}}
        </p>
    </div>
</header>

<!-- Topic Nav -->
<nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
    <div class="block sm:hidden">
        <a
            href="#"
            class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
            @click="open = !open"
        >
            Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
        </a>
    </div>
    <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
        <div
            class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
            @foreach($categories as $category)
                <a href="{{route('get_books',$category->slug)}}"
                   class="hover:bg-gray-400 rounded py-2 px-4 mx-2">{{$category->name}}</a>
            @endforeach
        </div>
    </div>
</nav>


<div class="container mx-auto flex flex-wrap py-6">
    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3" id="app">
        @yield('content')
    </section>

    <!-- Sidebar Section -->
    <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

        <div class="w-full bg-white shadow flex flex-col my-4 p-6">
            <p class="text-xl font-semibold pb-5">{{__('site_title')}}</p>
            <p class="pb-2">{{__('site_about')}}</p>
            <a href="#"
               class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                Get to know us
            </a>
        </div>

        @can('list-user-book')
            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">@lang('admin.users')</p>
                <div class="grid grid-cols-5 gap-5">
                    @foreach($usersWithBook as $user)
                        <a href="{{route('get_books_users',$user->slug)}}">
                            <img class="hover:opacity-75" src="{{QData::getImageFromUser($user)}}"
                                 title="{{__('user_with_book',['user'=>$user->name,'countBook'=>$user->books_created_count])}}">
                        </a>
                    @endforeach
                </div>
                <a href="#"
                   class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-6">
                    <i class="fab fa-instagram mr-2"></i> Follow @dgrzyb
                </a>
            </div>
        @endcan

    </aside>

</div>

<footer class="w-full border-t bg-white pb-12">
    <div
        class="relative w-full flex items-center invisible md:visible md:pb-12"
        x-data="getCarouselData()"
    >
        <button
            class="absolute bg-blue-800 hover:bg-blue-700 text-white text-2xl font-bold hover:shadow rounded-full w-16 h-16 ml-12"
            x-on:click="decrement()">
            &#8592;
        </button>
        <template x-for="image in images.slice(currentIndex, currentIndex + 6)" :key="images.indexOf(image)">
            <img class="w-1/6 hover:opacity-75" :src="image">
        </template>
        <button
            class="absolute right-0 bg-blue-800 hover:bg-blue-700 text-white text-2xl font-bold hover:shadow rounded-full w-16 h-16 mr-12"
            x-on:click="increment()">
            &#8594;
        </button>
    </div>
    <div class="w-full container mx-auto flex flex-col items-center">
        <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
            @can('static-about')
                <a href="{{route('about_us')}}" class="uppercase px-3">@lang('about_us')</a>
            @endcan
            @can('static-privacy')
                <a href="{{route('policy_privacy')}}" class="uppercase px-3">@lang('policy_privacy')</a>
            @endcan
            @can('static-terms')
                <a href="{{route('terms_conditions')}}" class="uppercase px-3">@lang('terms_conditions')</a>
            @endcan
            <a href="{{route('contact_us')}}" class="uppercase px-3">@lang('contact_us')</a>
        </div>
        <div class="uppercase pb-6">&copy; myblog.com</div>
    </div>
</footer>

<script>
    function getCarouselData() {
        return {
            currentIndex: 0,
            images: [
                'https://source.unsplash.com/collection/1346951/800x800?sig=1',
                'https://source.unsplash.com/collection/1346951/800x800?sig=2',
                'https://source.unsplash.com/collection/1346951/800x800?sig=3',
                'https://source.unsplash.com/collection/1346951/800x800?sig=4',
                'https://source.unsplash.com/collection/1346951/800x800?sig=5',
                'https://source.unsplash.com/collection/1346951/800x800?sig=6',
                'https://source.unsplash.com/collection/1346951/800x800?sig=7',
                'https://source.unsplash.com/collection/1346951/800x800?sig=8',
                'https://source.unsplash.com/collection/1346951/800x800?sig=9',
            ],
            increment() {
                this.currentIndex = this.currentIndex === this.images.length - 6 ? 0 : this.currentIndex + 1;
            },
            decrement() {
                this.currentIndex = this.currentIndex === this.images.length - 6 ? 0 : this.currentIndex - 1;
            },
        }
    }
</script>

</body>
</html>
