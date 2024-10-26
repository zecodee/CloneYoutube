<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZeTube</title>
    <link rel="stylesheet" href="{{ asset('css/style_channel.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- navbar -->
    @include('partials.home.navbar')

    <!-- sidebar -->
    @include('partials.home.sidebar')

    <div class="container">
        <div class="profile">
            <div class="img-profile">
                @if ($detail->image == null)
                <img src="{{ asset('images/profile.svg') }}" alt="{{ $detail->name }}" class="profile-img">
                @else
                <img src="{{ asset('storage/' . $detail->image) }}" alt="{{ $detail->name }}" class="profile-img">
                @endif
            </div>
            <div class="info-profile">
                <h1>{{ $detail->username }}</h1>
                <p>{{ $detail->name }}</p>
                <p>{{ $detail->email }} | {{ $detail->subscriberCount() }} Subscriber | {{ $total_video }} Video</p>
                @if ($is_own_channel)
                    <div class="subs">
                        <a href="/{{ $user->username }}/dashboard">Kelola Channel</a>                    
                    </div>
                @else
                    @if (auth()->check())
                        @if (auth()->user()->subscribe->contains('subscribe_id', $detail->id))
                            <form action="/unsubscribe/{{ $detail->username }}" method="post">
                                @csrf
                                <button type="submit" class="subs">Unsubscribe</button>
                            </form>
                        @else
                            <form action="/subscribe/{{ $detail->username }}" method="post">
                                @csrf
                                <button type="submit" class="subs">Subscribe</button>
                            </form>
                        @endif
                    @else
                        <div class="subs">
                            <a href="/auth">Subscribe</a>                    
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <hr class="line">
        <div class="list-container">
            @foreach ($videos as $vid)
            <div class="vid-list">
                <a href="/{{ $vid->title }}">
                    <img src="{{ asset('storage/' . $vid->thumbnail) }}" alt="{{ $vid->title }}" class="thumbnail">
                </a>
                
                <div class="flex-div">
                    <div class="vid-info">
                        <a href="/{{ $vid->title }}" class="vid-title">{{ $vid->title }}</a>
                        <p class="vid-sub">{{ $vid->days_since_creation }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>