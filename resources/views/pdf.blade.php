

@php $datas=$users->chunk(20); @endphp


@foreach($datas as $keyD=>$data)
    <h1>{{$title}}</h1>

    <b style="color: green">PRESENTANDO PDF</b>
    <table style="width: 100%">
        <tr>
            <td style="background: #1c4b30;color: white">FOTO</td>
            <td style="background: #1c4b30;color: white">NOMBRE</td>
            <td style="background: #1c4b30;color: white">EMAIL</td>
            <td style="background: #1c4b30;color: white">FECHA CREACION</td>
        </tr>

        @foreach($data as $user)
            <tr>
                <td> <img width="45px" class="hover:opacity-75" src="{{QData::getImageFromUser($user)}}"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>
            </tr>
        @endforeach
    </table>
    @if(($keyD+1)<$datas->count())
        <div style="page-break-after:always; clear:both"></div>
    @endif

@endforeach
