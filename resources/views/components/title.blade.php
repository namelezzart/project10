<div class="border-bottom pt-3 mb-4">
    @isset($link)
        {{ $link }}
    @endisset

    <div class="d-flex justify-content-between">
            <h1 class = "mb-3">
                {{ $slot }}
            </h1>

            @isset($right)
                <div class="pt-2">
                    {{ $right }}
                </div>
            @endisset
    </div>
</div>

{{-- <x-errors/> --}}

    