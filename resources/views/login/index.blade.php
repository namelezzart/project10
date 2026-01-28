@extends('layouts.auth')

@section('page.title', 'Log in')

@section('auth.content')
    <x-card>
        <x-card_header>
            <x-card_title>
                <i class="bi bi-box-arrow-in-right me-2"></i>
                {{ __('Log in') }}
            </x-card_title>

            <x-slot name="right">
                <a href="{{ route('register') }}" class="text-decoration-none">
                    {{ __('Sign up')}}
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

            <x-form action="{{ route('login.store') }}" method="POST">
                <x-form_item>
                    <x-label required>
                        <i class="bi bi-envelope me-1"></i>
                        {{ __('Email') }}
                    </x-label>
                    <x-input type="email" name="email" placeholder="your@email.com" autofocus />
                </x-form_item>

                <x-form_item>
                    <x-label required>
                        <i class="bi bi-lock me-1"></i>
                        {{ __('Password') }}
                    </x-label>
                    <x-input type="password" name="password" placeholder="••••••••" />
                </x-form_item>

                <x-form_item>
                    <x-checkbox name="remember">
                        {{ __('Remember me') }}
                    </x-checkbox>
                </x-form_item>
                    
                <x-button type="submit" class="w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    {{ __('Log in') }}
                </x-button>
            </x-form>
        </x-card_body>
    </x-card>
@endsection
