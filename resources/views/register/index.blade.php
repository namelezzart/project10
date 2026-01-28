@extends('layouts.auth')

@section('page.title', 'Sign up')

@section('auth.content')
    <x-card>
        <x-card_header>
            <x-card_title>
                <i class="bi bi-person-plus me-2"></i>
                {{ __('Sign up') }}
            </x-card_title>

            <x-slot name="right">
                <a href="{{ route('login') }}" class="text-decoration-none">
                    {{ __('Log in')}}
                </a>
            </x-slot>
        </x-card_header>

        <x-card_body>
            {{-- Сообщения об успехе --}}
            @if (session('success'))
                <div class="alert alert-success small p-3 mb-3">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Ошибки валидации --}}
            <x-errors />

            <x-form action="{{ route('register.store') }}" method="POST">
                <x-form_item>
                    <x-label required>
                        <i class="bi bi-person me-1"></i>
                        {{ __('Name') }}
                    </x-label>
                    <x-input name="name" placeholder="John Doe" autofocus />
                </x-form_item>
 
                <x-form_item>
                    <x-label required>
                        <i class="bi bi-envelope me-1"></i>
                        {{ __('Email') }}
                    </x-label>
                    <x-input type="email" name="email" placeholder="your@email.com" />
                </x-form_item>

                <x-form_item>
                    <x-label required>
                        <i class="bi bi-lock me-1"></i>
                        {{ __('Password') }}
                    </x-label>
                    <x-input type="password" name="password" placeholder="••••••••" />
                </x-form_item>

                <x-form_item>
                    <x-label required>
                        <i class="bi bi-lock-fill me-1"></i>
                        {{ __('Confirm password') }}
                    </x-label>
                    <x-input type="password" name="password_confirmation" placeholder="••••••••" />
                </x-form_item>

                <x-form_item>
                    <x-checkbox name="agreement">
                        {{ __('I agree to the processing of personal data') }}
                    </x-checkbox>
                </x-form_item>
            
                <x-button type="submit" class="w-100">
                    <i class="bi bi-person-plus me-2"></i>
                    {{ __('Sign up') }}
                </x-button>
            </x-form>
        </x-card_body>
    </x-card>
@endsection
