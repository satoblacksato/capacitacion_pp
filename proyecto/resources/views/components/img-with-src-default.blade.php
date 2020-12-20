<div>
    <img alt="{{$name}}" class="inline {{$class==''?'block h-auto w-full':$class}}"
         src="{{asset('/storage/'.$img)}}"
         onerror="this.src='https://picsum.photos/{{$w}}/{{$h}}/?random'"
    >
</div>
