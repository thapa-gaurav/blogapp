{{--<x-layout>--}}
{{--    @auth--}}
{{--        @if(auth()->user()->unreadNotifications->count() > 0)--}}
{{--            <div id="notificationsDisplay" style="display: flex; flex-direction: column; border: 1px solid cadetblue;height: 200px; margin-top:11px">--}}
{{--                <h3 style="margin: 0;">Notifications</h3>--}}
{{--                <div class="notifications">--}}
{{--                    @foreach(auth()->user()->unreadNotifications as $notification)--}}
{{--                        <div style="display: flex;align-items: center">--}}
{{--                            <p style="display: inline; margin: 20px;">{{$notification->data['comment']}}</p>--}}
{{--                            <form method="post" action="notifications/mark-as-read/{{$notification->id}}">--}}
{{--                                @csrf--}}
{{--                                <x-form-button>Mark as read</x-form-button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    @endauth--}}
{{--    <div style="display: flex;justify-content: space-around;margin-top: 10px;flex-wrap:wrap">--}}
{{--        @foreach($posts as $post)--}}
{{--            <x-post-card :post="$post"></x-post-card>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--    {{$posts -> links()}}--}}
{{--    <script>--}}
{{--        document.querySelectorAll('.deleteButton').forEach(button => {--}}
{{--            button.addEventListener('click', (event) => {--}}
{{--                event.preventDefault();--}}
{{--                if (confirm("Are you sure you want to delete this item?")) {--}}
{{--                    event.target.closest('form').submit();--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--        // let showLikersButton = document.getElementById('showLikers');--}}
{{--        let likedUser = document.getElementById('likedUser');--}}
{{--        document.querySelectorAll('.showLikers').forEach(button =>--}}
{{--            button.addEventListener('click', (event) => {--}}
{{--                event.preventDefault();--}}
{{--                //--}}
{{--                // if (button.nextSibling.style.display === 'flex') {--}}
{{--                //     button.nextSibling.style.display = 'none';--}}
{{--                // } else {--}}
{{--                //     button.nextSibling.style.display = 'flex';--}}
{{--                // }--}}
{{--                document.querySelectorAll('.likedUser').forEach(element => {--}}
{{--                    if (element.style.display === 'flex') {--}}
{{--                        element.style.display = 'none';--}}
{{--                    } else {--}}
{{--                        element.style.display = 'flex';--}}
{{--                    }--}}
{{--                })--}}
{{--            }));--}}

{{--    </script>--}}
{{--</x-layout>--}}
@extends('layouts.app')
{{--@section('title','Posts')--}}
{{--@section('pageTitle','posts')--}}
@section('content')
 <section class="content">
        <!-- Main content -->
        <section class="content">
            <a href="{{route('export-pdf')}}" class="btn btn-sm btn-danger">
                <i class="fas fa-file-pdf"></i> Export as PDF
            </a>
            <a href="{{ route('export-excel') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-file-excel"></i> Export as Excel
            </a>
            <a href="{{ route('export-csv') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-file-csv"></i> Export as Csv
            </a>
            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Text</th>
                            <th>Caption</th>
                            {{--                        <th>Description</th>--}}
                            {{--                        <th>Category</th>--}}
                            {{--                        <th>Created by</th>--}}
                            {{--                        <th>Status</th>--}}
                            {{--                        <th>Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $index => $post)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>
                                    @if($post->post_image)
                                        <img src="{{ asset('storage/'.$post->post_image) }}" alt="Post Image" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{{$post->post_text}}</td>
                                <td>{{ Str::limit($post->caption, 50) }}</td>
                                {{--                            <td>{{ $post->category->title ?? 'N/A' }}</td>--}}
                                {{--                            <td>{{ $post->creator->name }}</td>--}}
                                {{--                            <td>--}}
                                {{--                                @if($post->status==1)--}}
                                {{--                                    <span class="badge badge-success">Active</span>--}}
                                {{--                                @else--}}
                                {{--                                    <span class="badge badge-danger">Inactive</span>--}}
                                {{--                                @endif--}}
                                {{--                            </td>--}}
                                <td>
                                    <a href="{{route('post-show',$post->id)}}" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{route('post-edit',$post->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                                    {{--                                <form action="{{route('posts.destroy',$post->id)}}" method="post" class="d-inline">--}}
                                    {{--                                    @csrf--}}
                                    {{--                                    @method('DELETE')--}}
                                    {{--                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                                    {{--                                </form>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{$posts -> links()}}
        </section>
    </section>
@endsection
