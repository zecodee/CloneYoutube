<div class="sidebar">
    <div class="shortcut-links">
        <a href="/">
            <i class='bx bxs-home {{ $title === 'Home' ? 'active' : '' }} '></i>
            <p class="{{ $title === 'Home' ? 'active' : '' }} ">Home</p>
        </a>

        {{-- <a href="">
            <i class='bx bxs-videos {{ $title === 'Subscriprion' ? 'active' : '' }} '></i>
            <p class=" {{ $title === 'Subscriprion' ? 'active' : '' }} ">Subscriprion</p>
        </a> --}}

        @if (auth()->check())
            <a href="/{{ $user->username }}/upload">
                <i class='bx bxs-add-to-queue'></i>
                <p class="">Upload</p>
            </a>
            @else
            <a href="/auth">
                <i class='bx bxs-add-to-queue'></i>
                <p class="">Upload</p>
            </a>
        @endif

        @if (auth()->check())
            <a href="/playlist/{{ $user->username }}">
                <i class='bx bx-list-plus {{ $title === 'Playlist' ? 'active' : '' }} '></i>
                <p class=" {{ $title === 'Playlist' ? 'active' : '' }} ">Playlist</p>
            </a>
        @else
            <a href="/auth">
                <i class='bx bx-list-plus {{ $title === 'Playlist' ? 'active' : '' }} '></i>
                <p class=" {{ $title === 'Playlist' ? 'active' : '' }} ">Playlist</p>
            </a>
        @endif

        <hr>
    </div>
    <div class="channel-list">
        <h3>CHANNEL FOR YOU</h3>
        @foreach ($users as $otherUser)
            @if ($user && $otherUser->id !== $user->id)
                @if ($otherUser->image == null)
                    <a href="/channel/{{ $otherUser->username }}"><img src="{{ asset('images/profile.svg') }}" alt=""><p>{{ $otherUser->username }}</p></a>
                @else
                    <a href="/channel/{{ $otherUser->username }}"><img src="{{ asset('storage/' . $otherUser->image) }}" alt=""><p>{{ $otherUser->username }}</p></a>
                @endif
            @elseif (!$user)
                @if ($otherUser->image == null)
                    <a href="/channel/{{ $otherUser->username }}"><img src="{{ asset('images/profile.svg') }}" alt=""><p>{{ $otherUser->username }}</p></a>
                @else
                    <a href="/channel/{{ $otherUser->username }}"><img src="{{ asset('storage/' . $otherUser->image) }}" alt=""><p>{{ $otherUser->username }}</p></a>
                @endif
            @endif
        @endforeach
    </div>
</div>