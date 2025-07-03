@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">

        <form method="post" action="{{route('password-update')}}" enctype="multipart/form-data"
              class="border p-4 rounded shadow-sm bg-white">
            @csrf
            @method('patch')
            <h3 class="mb-4 text-center">Edit password</h3>
            <div>
                <x-form-label for="current_password">Password</x-form-label>
                <x-form-input type="password" name="current_password"/>
                <x-form-error name="current_password"></x-form-error>
            </div>
            <div>
                <x-form-label for="new_password">New Password</x-form-label>
                <x-form-input type="password" name="new_password"/>
                <x-form-error name="new_password"></x-form-error>
            </div>
            <x-form-button type="submit">Submit</x-form-button>
        </form>
    </div>

</div>
@endsection
