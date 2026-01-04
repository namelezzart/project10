@if (session()->has('alert'))
    @php($alert = session('alert'))

    <div class="alert alert-{{ $alert['type'] }} mb-0 rounded-0 text-center small py-2">
        {{ $alert['message'] }}
    </div>
@endif
