<div class="sidebar">
    <div class="brand-title">
        <a href="/" class="brand">ZeTube</a>
    </div>
    <div class="sidebar-list">
        <a href="/{{ $user->username }}/dashboard" class="{{ $title === 'Dashboard' ? 'active' : '' }}">
            <i class="bx bxs-home {{ $title === 'Dashboard' ? 'active' : '' }}"></i>
            <p class="{{ $title === 'Dashboard' ? 'active' : '' }}">Dashboard</p>
        </a>
        <a href="/{{ $user->username }}/account" class="{{ $title === 'Account' ? 'active' : '' }}">
            <i class="bx bxs-user {{ $title === 'Account' ? 'active' : '' }}"></i>
            <p class="{{ $title === 'Account' ? 'active' : '' }}">Account</p>
        </a>
        <a href="/{{ $user->username }}/upload" class="{{ $title === 'Content' ? 'active' : '' }}">
            <i class="bx bxs-add-to-queue {{ $title === 'Content' ? 'active' : '' }}"></i>
            <p class="{{ $title === 'Content' ? 'active' : '' }}">Upload</p>
        </a>
        <a href="#" class="{{ $title === 'Playlist' ? 'active' : '' }}">
            <i class="bx bx-list-plus {{ $title === 'Playlist' ? 'active' : '' }}"></i>
            <p class="{{ $title === 'Playlist' ? 'active' : '' }}">Playlist</p>
        </a>
        <hr>
    </div>
    <div class="sidebar-list">
        <a href=""><i class='bx bxs-cog'></i><p class="">Setting</p></a>
        <a href="/"><i class='bx bx-arrow-back' ></i><p class="">Back</p></a>
        <form action="/logout" method="post">
        @csrf
        <button class="logout"><i class='bx bxs-log-out' ></i><p>Logout</p></button>
        </form>
    </div>
</div>