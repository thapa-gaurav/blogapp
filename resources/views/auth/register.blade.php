@extends('layouts.app')
@section('content')
    <form method="post" action="{{route('register-create')}}" style="display: flex;
        flex-direction: column;
        gap: 20px;
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;">
        @csrf
        <div>
            <x-form-label for="name">Name</x-form-label>
            <x-form-input type="text" name="name" value="{{old('name')}}"/>
            <x-form-error name="name"></x-form-error>
        </div>
        <div>
            <x-form-label for="email">Email</x-form-label>
            <x-form-input type="email" name="email" value="{{old('email')}}"/>
            <x-form-error name="email"></x-form-error>
        </div>
        <div>
            <x-form-label for="username">Username</x-form-label>
            <x-form-input type="text" name="username" value="{{old('username')}}"/>
            <x-form-error name="username"></x-form-error>
        </div>
        <div>
            <x-form-label for="password">Password</x-form-label>
            <x-form-input type="password" name="password"/>
            <x-form-error name="password"></x-form-error>
        </div>
        <div>
            <x-form-label for="password_confirmation">Confirm Password</x-form-label>
            <x-form-input type="password" name="password_confirmation"/>
            <x-form-error name="password_confirmation"></x-form-error>
        </div>

        <x-form-button type="submit">Submit</x-form-button>
    </form>
@endsection
