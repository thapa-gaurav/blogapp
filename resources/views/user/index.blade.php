<x-layout>
    <div style="display: flex;justify-content: space-between; margin-top: 20px;">
        <div>
{{--            {{dd(\Illuminate\Support\Facades\Auth::user())}}--}}
            <x-form-button><x-nav-link href="{{route('user-showLikedPosts',['user'=>Auth::user()->id])}}" style="text-decoration: none; padding:5px;">Liked</x-nav-link></x-form-button>
            <x-form-button>
                <x-nav-link href="{{route('user-showCommentedPosts',['user'=>Auth::user()->id])}}" style="text-decoration: none;padding:5px;">Commented</x-nav-link>
            </x-form-button>
        </div>
        @auth
        <div>
           <x-form-button> <x-nav-link href="{{route('password-edit')}}" style="text-decoration: none; padding:5px;">Change Password</x-nav-link></x-form-button>
        </div>
        @endauth
    </div>
    <div style="display: flex;justify-content: space-around;margin-top: 10px;flex-wrap:wrap">
        @foreach($posts as $post)
            <x-post-card :post="$post"></x-post-card>
        @endforeach
    </div>
    {{$posts -> links()}}
    <script>
        document.querySelectorAll('.deleteButton').forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                if (confirm("Are you sure you want to delete this item?")) {
                    event.target.closest('form').submit();
                }
            });
        });
        // let showLikersButton = document.getElementById('showLikers');
        let likedUser = document.getElementById('likedUser');
        document.querySelectorAll('.showLikers').forEach(button =>
            button.addEventListener('click', (event) => {
                event.preventDefault();
                //
                // if (button.nextSibling.style.display === 'flex') {
                //     button.nextSibling.style.display = 'none';
                // } else {
                //     button.nextSibling.style.display = 'flex';
                // }
                document.querySelectorAll('.likedUser').forEach(element => {
                    if (element.style.display === 'flex') {
                        element.style.display = 'none';
                    } else {
                        element.style.display = 'flex';
                    }
                })
            }));

    </script>
</x-layout>
