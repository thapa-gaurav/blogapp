@props(['post'])
<div style="width:300px;border: 2px solid black;padding: 10px; margin: 15px">
    <div style="border:2px dotted black;">
        <p><strong><span>Name:</span></strong>{{$post->user->name}}</p>
        <p><span>@</span>{{$post->user->username}}</p>
    </div>

    <p style="font-size: large;"><strong>{{$post->caption}}</strong></p>
    <p>{{$post->post_text}}</p>
    <div>
        @if($post->post_image)
            <img src="{{asset("/storage/".$post->post_image)}}" alt="" style="" width="300px;">
        @else
            <p>no Image available</p>
        @endif
        <div>
            <p>
                <span> Liked by </span>{{$post->like_count}}<span> People.</span></p>
            @auth
                @if(!in_array(Auth::user()->username,$post->like->pluck('user.username')->toArray()))
                    <form action="{{route('like-store',['post'=>$post->id])}}" method="post">
                        @csrf
                        <x-form-button class="likeButton">Like</x-form-button>
                    </form>
                @else
                    <form action="{{route('like-destroy',['post'=>$post->id])}}" method="post">
                        @method('delete')
                        @csrf
                        <x-form-button class="likeButton">Liked</x-form-button>
                    </form>
                @endif
            @endauth
            @if($post->like_count > 0)
                <x-form-button class="showLikers">Show Likers</x-form-button>
                <div class="likedUser" style="display: none">
                    <ul>
                        @foreach($post->like as $like)
                            <li>{{ $like->user->name }} <span>@</span>{{ $like->user->username }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

        </div>
        <div>
            <form action="{{route('comment-store',['post'=>$post->id])}}" method="post">
                @csrf
                <textarea name="comment" style="width: 300px;"></textarea>
                <x-form-button>Comment</x-form-button>
                <x-form-error name="comment"></x-form-error>
            </form>
            <div class="commentUser">
                @if($post->comment_count > 0)
                    <ul style="display: flex;flex-direction: column;gap:5px;padding-left: 0">
                        @foreach($post->comment as $comment)
                            <x-post-comment :comment="$comment"></x-post-comment>
                        @endforeach
                    </ul>
                @else
                    <p>No comments</p>
                @endif
            </div>
        </div>
        @can('edit-post',$post)
            <div style="display: flex;justify-content: space-around">
                <form action="{{route('post-destroy',['post'=>$post])}}" method="post">
                    @csrf
                    @method('delete')
                    <x-form-button class="deleteButton" type="submit">Delete</x-form-button>
                </form>
                <a href="{{route('post-edit',['post'=>$post->id])}}">
                    <button style="margin-left:15px;margin-right: 15px">Edit</button>
                </a>
            </div>
        @endcan
    </div>
</div>
