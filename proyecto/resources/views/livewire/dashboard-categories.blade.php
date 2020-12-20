<div>

    <script>
        window.addEventListener('viewMessage',event=>{
           alert(event.detail.msg);
        });
    </script>

    <h4>Tester: {{$input}}</h4>
    <input wire:model="input"/>

    <div wire:loading>
        Cargando informacion...
    </div>
    <div wire:offline>
        <h2>Revisa tu conectividad de internet</h2>
    </div>

    @foreach($data as $item)
        <x-image-for-admin :name="$item->name" :image="$item->photo"></x-image-for-admin>
        <h4>({{$item->id}}) {{$item->name}}</h4>
    @endforeach

    <button wire:click="getRandom">Random</button>

    <hr/>
    @foreach($users as $item)
        <h4>({{$item->id}}) {{$item->name}}</h4>
    @endforeach


    <hr/>
    <form wire:submit.prevent="save">


        @if ($photo)
            Photo Preview:
            <img src="{{ $photo->temporaryUrl() }}">
        @endif


        <input type="file" wire:model="photo">

        @error('photo') <span class="error">{{ $message }}</span> @enderror
        <br/>
        <button type="submit">Save Photo</button>
    </form>
</div>
