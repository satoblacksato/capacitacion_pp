<div>
    @if($image!=null)
        <div class="col-md-12 text-center">
            <img src="{{asset('/storage/'.$image)}}" class="img-responsive img-rounded"
                 style="height: 200px" alt="{{$name}}">
        </div>
    @endif
</div>
