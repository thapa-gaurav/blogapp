@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-6 mb-3 mb-sm-0 ">
        <div class="card " style="width: 20rem;">
            <img src="{{asset('/storage/'.$post->post_image)}}" class="card-img-top" alt="...">
            <h5 class="card-title">{{$post->caption}}</h5>
            <p class="card-text">{{$post->post_text}}</p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Created by: {{$post->user->username}}</li>
                <li class="list-group-item">Likes: {{$post->like_count}}</li>
                <li class="list-group-item">Price: {{$post->price}}</li>
            </ul>
            <div class="card-body">
                <div class="row mx-1 justify-content-between">
                    <a href="{{route('post-index')}}" class="btn btn-primary">All posts</a>
                    <a href="{{route('post-edit',$post)}}" class="btn btn-secondary">Edit</a>
                    <form action="{{route('post-destroy',$post)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class=" deleteButton btn btn-danger">Delete</button>
                    </form>
                    <form action="{{route('esewa',$post)}}" method="post">
                        @csrf
                        <button class="btn btn-danger">Pay</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        document.querySelector('.deleteButton').addEventListener('click',(event)=>{
            event.preventDefault();
            if (confirm("Are you sure you want to delete this item?")) {
                event.target.closest('form').submit();
            }
        })
    </script>
@endsection
