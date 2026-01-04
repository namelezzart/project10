<div class="card-body">
    <div class="d-flex justify-content-between">
        <div>
            <h4>{{ $slot }}</h4>
        </div>

        @isset($right)
            <div>
                {{ $right }}   
            </div>
        @endisset 
    </div> 
</div>
