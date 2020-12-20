<x-master-layout>
    @section('content')
        <article class="flex flex-col my-4" style="width: 100%">
            <h1 class="font-bold text-xl-center">ERROR 401</h1>
            {{$exception->getMessage()}}
        </article>
    @endsection
</x-master-layout>
