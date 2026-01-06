@extends('layouts.auth')

@section('page.title', 'Sign up')

@section('auth.content')
    <x-card>
        <x-card_header>
            <x-card_title>
                {{ __('Sign up') }}
            </x-card_title>

            <x-slot name="right">
                <a href="{{ route('login') }}">
                    {{ __('Log in')}}
                </a>
            </x-slot>
        </x-card_header>

        <x-card_body>
            <x-errors />

            <x-form action="{{ route('register.store') }}" method="POST">
                <x-form_item>
                    <x-label required> {{ __('Name') }}</x-label>
                    <x-input name="name" autofocus/>
                </x-form_item>
 
                <x-form_item>
                    <x-label required> {{ __('Email') }}</x-label>
                    <x-input type="email" name="email" />
                </x-form_item>

                <x-form_item>
                    <x-label required> {{ __('Password') }}</x-label>
                    <x-input type="password" name="password"/>
                </x-form_item>

                <x-form_item>
                    <x-label required> {{ __('Confirm password') }}</x-label>
                    <x-input type="password" name="password_confirmation"/>
                </x-form_item>

                <x-form_item>
                    <x-checkbox name="agreement">
                        {{ __('I agree to the processing of personal data') }}
                    </x-checkbox>
                </x-form_item>
            
                <x-button type="submit">
                    {{ __('Sign up') }}
                </x-button>
            </x-form>
        </x-card_body>
    </x-card>
@endsection