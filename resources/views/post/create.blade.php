@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <form method="post" action="{{route('post-store')}}" enctype="multipart/form-data"
                  class="border p-4 rounded shadow-sm bg-white">
                @csrf
                <h3 class="mb-4 text-center">Create new post</h3>

                <div class="mb-3">
                    <x-form-label for="caption">Post Caption</x-form-label>
                    <x-form-input type="text" name="caption" value="{{old('caption')}}"/>
                    <x-form-error name="caption"></x-form-error>
                </div>
                <div class="mb-3">
                    <x-form-label for="post_text">Post Text</x-form-label>
                    <textarea class="form-control"
                              name="post_text">{{old('post_text') !== null ? old('post_text'): "What's on you mind?" }}</textarea>
                    <x-form-error name="post_text"></x-form-error>
                </div>
                <div class="mb-3">
                    <x-form-label for="post_image">Post Image</x-form-label>
                    <x-form-input type="file" name="post_image"/>
                    <x-form-error name="post_image"></x-form-error>
                </div>

                <div class="mb-3">
                    <x-form-label for="price">Price</x-form-label>
                    <x-form-input type="number" name="price"/>
                    <x-form-error name="price"></x-form-error>
                </div>

                <x-form-button type="submit">Submit</x-form-button>
            </form>
        </div>

    </div>
@endsection
