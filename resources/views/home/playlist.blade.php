<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZeTube</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- navbar -->
    @include('partials.home.navbar')
    
    <!-- sidebar -->
    @include('partials.home.sidebar')

    <!-- main content -->
    <div class="container">
        <div class="list-container">
            @foreach ($playlists as $playlist)
                <div class="vid-list">
                    @if ($playlist->video)
                        <a href="/{{ $playlist->video->title }}">
                            <img src="{{ asset('storage/' . $playlist->video->thumbnail) }}" alt="{{ $playlist->video->thumbnail }}" class="thumbnail">
                        </a>
                        <div class="flex-div">
                            @if ($playlist->video->user && $playlist->video->user->image)
                                <a href="/channel/{{ $playlist->video->user->username }}">
                                    <img src="{{ asset('storage/' . $playlist->video->user->image) }}" alt="" class="profile-user">
                                </a>
                            @else
                                <a href="/channel/{{ $playlist->video->user->username }}">
                                    <img src="{{ asset('images/profile.svg') }}" alt="" class="profile-user">
                                </a>
                            @endif
                            <div class="vid-info">
                                @if ($playlist->video)
                                    <a href="/{{ $playlist->video->title }}" class="vid-title">{{ $playlist->video->title }}</a>
                                @endif
                                @if ($playlist->user)
                                    <a href="/channel/{{ $playlist->video->user->username }}" class="vid-sub">{{ $playlist->video->user->username }}</a>
                                @endif
                                @if ($playlist->video)
                                    <p class="vid-sub">{{ $playlist->video->created_at->diffForHumans() }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>