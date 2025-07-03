@props(['comment'])
<li style=" list-style: none; border: 1px solid gray; border-radius: 5px; margin: auto; width: 100%;">
    <strong>{{ $comment->comment }} </strong> by
    <span>@</span>{{ $comment->user->username }}</li>
