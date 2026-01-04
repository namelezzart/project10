    <x-card>
        <x-card_header>
            <x-card_title>
                {{ __('Log in') }}
            </x-card_title>

            <x-slot name="right">
                <a href="{{ route('register') }}">
                    {{ __('Sign up')}}
                </a>
            </x-slot>
        </x-card_header>

        <x-card_body>
            <x-form action="{{ route('login.store') }}" method="POST">
                <x-form_item>
                    <x-label required> {{ __('Email') }}</x-label>
                    <x-input type="email" name="email" autofocus/>
                </x-form_item>

                <x-form_item>
                    <x-label required> {{ __('Password') }}</x-label>
                    <x-input type="password" name="password"/>
                </x-form_item>

                <x-form_item>
                    <x-checkbox name="remember">
                        {{ __('Remember me') }}
                    </x-checkbox>
                </x-form_item>
                    
                <x-button type="submit">
                    {{ __('Log in') }}
                </x-button>
            </x-form>
        </x-card_body>
    </x-card>