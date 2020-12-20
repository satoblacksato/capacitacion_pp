<x-master-layout>
    @section('content')
            <article class="flex flex-col shadow my-4" style="width: 100%">

                <table id="tbData">
                    <thead>
                        <th>PROFILE</th>
                        <th>NOMBRE</th>
                        <th>EMAIL</th>
                        <th>FECHA CREACION</th>
                    </thead>
                    <tbody>
                        @php /*
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <img src="{{$user->profile_photo_url}}">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                        </tr>
                        @endforeach
                        */
                        @endphp
                    </tbody>
                </table>


            </article>
    @endsection
    @push('script-custom')
            <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" defer></script>

            <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" defer></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" defer></script>
            <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" defer></script>
            <script>
            window.onload=function(){
                $("#tbData").DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
                   processing:true,
                   serverSide:true,
                   ajax:{
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                       url: "{{route('getUsers')}}",
                       type:'POST'
                   },
                   columns:[
                       {data:'profile_photo',name:'profile_photo'},
                       {data:'name',name:'name'},
                       {data:'email',name:'email'},
                       {data:'created_at',name:'created_at'}
                   ]
                });
            }
        </script>
    @endpush
</x-master-layout>
