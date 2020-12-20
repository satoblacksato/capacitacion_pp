<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>

    @if(config('app.env')!='production')
        Pusher.logToConsole = true;
    @endif

  //  alertify.set({ delay: 15000 });

    var pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {
        cluster: '{{config('broadcasting.connections.pusher.options.cluster')}}'
    });

    var channel = pusher.subscribe('channel-books');

    channel.bind('App\\Events\\CreatedNewBook', (data)=> {
        alertify.success(data.message);
    });
</script>
