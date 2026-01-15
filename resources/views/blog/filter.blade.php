    <x-form action="{{ route('blog') }}" method="get">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <x-input name="search" value="{{ request('search') }}" placeholder="{{ __('Search') }}" />
                </div> 
            </div>
 
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <x-input name="from_date" value="{{ request('from_date') }}" placeholder="{{ __('From date') }}" />
                </div> 
            </div>

            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <x-input name="to_date" value="{{ request('to_date') }}" placeholder="{{ __('To date') }}" />
                </div> 
            </div>

            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <x-button type="submit">
                        {{ __('Apply') }}
                    </x-button>
                </div> 
            </div>
        </div>
    </x-form>