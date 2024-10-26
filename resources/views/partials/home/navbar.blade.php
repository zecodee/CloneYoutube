<nav class="flex-div">
    <div class="nav-left flex-div">
        <img src="{{ asset('images/menu.png') }}" alt="" class="menu-icon">
        <a href="/"><h1 class="title-home">ZeTube</h1></a>
    </div>
    <div class="nav-middle flex-div">
        <div class="search-box flex-div">
            <form action="/search" method="get">
                @csrf
                <input type="search" name="query" id="search" placeholder="Search" required>
                <button type="submit">
                    <img src="{{ asset('images/search.png') }}" alt="">
                </button>
            </form>
        </div>
    </div>
    <div class="nav-right flex-div">
        @if (auth()->check())
        <a href="/{{ $user->username }}/upload"><i class='bx bxs-video-plus' ></i></a>

            @if ($user->image == null)
            <a href="/{{ $user->username }}/account">
                <img src="{{ asset('images/profile.svg') }}" alt="" class="profile-user">
            </a>
            @else
            <a href="/{{ $user->username }}/account">
                <img src="{{ asset('storage/' . $user->image) }}" alt="" class="profile-user">
            </a>
            @endif

        @else
        <a href="/auth"><img src="{{ asset('images/upload.png') }}" alt="" class="upload-icon"></a>
        <a href="/auth">
            <img src="{{ asset('images/profile.svg') }}" alt="" class="profile-user">
        </a>
        @endif
    </div>
</nav>