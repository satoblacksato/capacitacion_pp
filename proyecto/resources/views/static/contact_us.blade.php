<x-master-layout>
    @section('content')

        <article class="flex flex-col my-4" style="width: 100%">
            <h1>@lang('contact_us')</h1>

                {!! Form::open(['route'=>'send_email']) !!}

                    {!! Field::text('name',['label'=>__('admin.NOMBRE'),'class'=>'block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner']) !!}

                    {!! Field::email('email',['label'=>__("E-Mail Address"),'class'=>'block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner']) !!}

                    {!! Field::textarea('description',['label'=>__("admin.DESCRIPCION"),'class'=>'block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner']) !!}

                    {!! Form::submit(__('send'),
                                ['class'=>'border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500
                                            ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline'
                                ]) !!}

                {!! Form::close() !!}

        </article>

    @endsection
</x-master-layout>
