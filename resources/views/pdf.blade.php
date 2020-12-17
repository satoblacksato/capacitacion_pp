<h1>{{$title}}</h1>

<b style="color: green">PRESENTANDO PDF</b>


<table style="width: 100%">
    <tr>
        <td style="background: #1c4b30;color: white">NOMBRE</td>
        <td style="background: #1c4b30;color: white">EMAIL</td>
        <td style="background: #1c4b30;color: white">FECHA CREACION</td>
    </tr>

    @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
        </tr>
    @endforeach


</table>
