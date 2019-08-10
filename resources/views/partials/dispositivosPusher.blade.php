<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<script type="text/javascript">
  let pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
    authEndpoint: '{{ url("/broadcasting/auth") }}',
    auth: {
      headers: {
        'X-CSRF-Token': '{{ csrf_token() }}'
      }
    },
    cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
    forceTLS: @json(env('PUSHER_FORCE_TLS', false))
  });

  var channel = pusher.subscribe('private-user.{{ Auth::user()->id }}');
  channel.bind('data.stored', function(data) {
    $.each(data.data, function(k, v) {
      $(`#dispositivo-${data.dispositivo} .dispositivo-data-${k+1}`)
        .attr('data-original-title', v)
        .text(v)
    })
  });
</script>
