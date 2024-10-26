<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        {{-- <div class="banner">
            <img src="images/banner.png" alt="">
        </div> --}}

        <div class="list-container">
            
            @if ($videos->isEmpty())
                <div class="no-results">
                    <p>{{ $message }}</p>
                </div>
            @else
                @foreach ($videos as $vid)
                <div class="vid-list">
                    <a href="/{{ $vid->title }}">
                        <img src="{{ 'storage/' . $vid->thumbnail }}" alt="{{ $vid->thumbnail }}" class="thumbnail">
                    </a>
                    
                    <div class="flex-div">
                        @if ($vid->user->image == null)
                            <a href="/channel/{{ $vid->user->username }}">
                                <img src="{{ asset('images/profile.svg') }}" alt="" class="profile-user">
                            </a>
                        @else
                            <a href="/channel/{{ $vid->user->username }}">
                                <img src="{{ 'storage/' . $vid->user->image }}" alt="">
                            </a>
                        @endif

                        <div class="vid-info">
                            <a href="/{{ $vid->title }}" class="vid-title">{{ $vid->title }}</a>
                            <a href="/channel/{{ $vid->user->username }}" class="vid-sub">{{ $vid->user->username }}</a>
                            <p class="vid-sub">{{ $vid->days_since_creation }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif

        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>