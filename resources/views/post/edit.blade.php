@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <form method="post" action="{{route('post-update',$post)}}" enctype="multipart/form-data"
                  class="border p-4 rounded shadow-sm bg-white">
                @csrf
                @method('patch')
                <h3 class="mb-4 text-center">Edit post</h3>

                <div class="mb-3">
                    <x-form-label for="caption">Post Caption</x-form-label>
                    <x-form-input type="text" name="caption" value="{{$post->caption}}"/>
                    <x-form-error name="caption"></x-form-error>
                </div>
                <div class="mb-3">
                    <x-form-label for="post_text">Post Text</x-form-label>
                    <textarea class="form-control"
                              name="post_text">{{$post->post_text}}</textarea>
                    <x-form-error name="post_text"></x-form-error>
                </div>
                <div class="mb-3">
                    <x-form-label for="post_image">Post Image</x-form-label>
                    <x-form-input type="file" name="post_image"/>
                    <x-form-error name="post_image"></x-form-error>
                </div>

                <x-form-button type="submit">Submit</x-form-button>
            </form>
        </div>

    </div>
@endsection
