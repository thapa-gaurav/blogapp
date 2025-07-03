@php use Illuminate\Support\Facades\Auth; @endphp
    <!doctype html >
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog app</title>
    {{--    @vite(['resources/js/app.js'])--}}
</head>
<body>

<div>
    <nav style="display: flex; gap: 14px; border: 1px solid black;justify-content: space-between">
        <div style="text-align: center; display: flex;gap: 20px;align-items: center">
            <x-nav-link href="{{route('post-index')}}" style="text-decoration: none">Posts</x-nav-link>
            @auth
                <x-nav-link href="{{route('post-create')}}" Style="text-decoration: none">Create</x-nav-link>
            @endauth
        </div>
        <div style="display: flex;gap:20px;align-items: center">
            <form method="get" action="{{route('post-search')}}">
                @csrf
                <x-form-input type="text" name="search" style="width: 200px;height: 10px;" placeholder="Search caption">
                </x-form-input>
                <x-form-error name="search"></x-form-error>
                <x-form-button>Search</x-form-button>
            </form>
            @guest
                <x-form-button>
                    <x-nav-link href="{{route('register-create')}}" Style="text-decoration: none">Sign up</x-nav-link>
                </x-form-button>
                <x-form-button>
                    <x-nav-link href="{{route('login')}}" Style="text-decoration: none">Log in</x-nav-link>
                </x-form-button>
            @endguest
            @auth
                {{--                <x-form-button><span>@</span>{{Auth::user()->username}}</x-form-button>--}}
                <x-form-button><a href="{{route('user-index',['user'=>Auth::user()->id])}}"
                                  style="text-decoration: none"><span>@</span>{{Auth::user()->username}}</a>
                </x-form-button>
                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <x-form-button>Logout</x-form-button>
                </form>
            @endauth
        </div>
    </nav>

    <main>
        <div>
            {{$slot}}
        </div>
    </main>
    @if(session('success'))
        <div>
            <script>alert(`${{{session('success')}}}`)</script>
        </div>
    @endif
</div>


</body>
</html>
