<?php

namespace App\Http\Controllers;

use App\Rules\Phone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rule\Password;

class ValidationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
           'first name' => ['required', 'string', 'max:50'],
           'last name' => ['nullable', 'string', 'max:50'],
           'age' => ['nullable', 'ingteger', 'min:18', 'max:100'],
           'amount' => ['required', 'numeric', 'min:1', 'max:9999999'],
           'gender' => ['nullable', 'string', 'in:male,female'],
           'zip' => ['reqiured', 'digits:6'],
           'subscription' => ['nullable', 'boolean'],
           'agreement' => ['accepted'],
           'password' => ['required', 'string', 'min:7', 'confirmed'],
           'password_confirmation' => ['required', 'string', 'min:7', 'confirmed'],
           'current_password' => ['required', 'string', 'current_password'],
           'email' => ['required', 'string', 'email', 'exist:users,email'],
        //    'country_id' => ['required', 'integer', 'exist:countries,id'],
           'country_id' => ['required', 'integer', Rule::exists('countries', 'id')->where('active', true)],
        //    'phone' => ['require', 'string', 'unique:users,phone'],
           'phone' => ['require', 'string', new Phone, Rule::unique('users', 'phone')->ignore(123)],
           'website' => ['nullable', 'string', 'url'],
           'uuid' => ['nullable', 'string', 'uuid'],
           'ip' => ['nullable', 'string', 'ip'],
           'avatar' => ['required', 'file', 'image', 'max:1024'],
           'birth_date' => ['nullable', 'string', 'date'],
           'start_date' => ['required', 'string', 'date', 'after_or_equal:today'],
           'finish_date' => ['required', 'string', 'date', 'after:star_date'],
           'services' => ['nullable', 'array', 'min:1', 'max:10'],
           'services.*' => ['required, integer'],
           'delivery' => ['required', 'array', 'size:2'],
           'delivery.date' => ['required', 'string', 'date_format:Y.m.d'],
           'delivery.time' => ['required', 'string', 'date_format:H.i.s'],
           'secret' => ['required', 'string', function ($attribute, $value, \CLosure $fail) {
                if ($value !== config('example.pro')) {
                    $fail(__('Wrong secret key')); 
                }
           }]
        ]);
    }
}
