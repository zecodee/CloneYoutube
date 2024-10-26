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
    <nav class="flex-div">
        <div class="nav-left flex-div">
            <a href="/"><h1 class="title-home">ZeTube</h1></a>
        </div>
        <div class="nav-middle flex-div">
            <div class="search-box flex-div">
                <form action="/search" method="get">
                    @csrf
                    <input type="search" name="query" id="search" placeholder="Search" required>
                    <button type="submit">
                        <img src="images/search.png" alt="">
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

    <div class="container play-container">
        <div class="row">
            <div class="play-video">
                <video controls autoplay loop>
                    <source src="{{ 'storage./' . $detail->video }}" type="video/mp4">
                </video>

                <h3 class="title-vid">{{ $detail->title }}</h3>
    
                <div class="play-video-info">
                    <p>{{ $detail->days_since_creation }}</p>
                    <div>
                        @if (auth()->check())
                            <form action="like" method="post">
                                @csrf
                                <input type="hidden" name="detail_id" value="{{ $detail->id }}">
                                @if ($like_status[$detail->id])
                                    <button class="" type="submit"><i class='bx bxs-like active' ></i>{{ $total_like[$detail->id] }}</button>
                                    @else
                                    <button class="" type="submit"><i class='bx bxs-like' ></i>{{ $total_like[$detail->id] }}</button>
                                @endif
                            </form>
                        @else
                            <a href="/auth" class=""><i class='bx bxs-like' ></i>{{ $total_like[$detail->id] }}</a>
                        @endif

                        @if (auth()->check())
                            <form action="dislike" method="post">
                                @csrf
                                <input type="hidden" name="detail_id" value="{{ $detail->id }}">
                                @if ($dislike_status[$detail->id])
                                    <button class="" type="submit"><i class='bx bxs-dislike active' ></i>{{ $total_dislike[$detail->id] }}</button>
                                    @else
                                    <button class="" type="submit"><i class='bx bxs-dislike' ></i>{{ $total_dislike[$detail->id] }}</button>
                                @endif
                            </form>
                        @else
                            <a href="/auth" class=""><i class='bx bxs-dislike' ></i>{{ $total_dislike[$detail->id] }}</a>
                        @endif

                        <a href="" class=""><i class='bx bxs-share' ></i>Share</a>
                        
                        @if (auth()->check())
                            <form action="playlist" method="post">
                                @csrf
                                <input type="hidden" name="detail_id" value="{{ $detail->id }}">
                                @if ($save_status[$detail->id])
                                <button type="submit" class="active"><i class='bx bx-list-plus active' ></i>Save</button>
                                @else
                                <button type="submit" class=""><i class='bx bx-list-plus' ></i>Save</button>
                                @endif
                            </form>
                        @else
                            <a href="/auth" class=""><i class='bx bx-list-plus' ></i>Save</a>    
                        @endif
                    </div>
                </div>
                <hr>
                <div class="publisher">
                    
                    @if (auth()->check())
                        @if ($detail->user->image == null)
                            <a href="{{ $detail->user->username }}">
                                <img src="{{ asset('images/profile.svg') }}" alt="{{ $detail->user->username }}" class="profile-user">
                            </a>
                        @else
                            <a href="{{ $detail->user->username }}">
                                <img src="{{ 'storage/' . $detail->user->image }}" alt="{{ $detail->user->username }}">
                            </a>
                        @endif
                    <div>
                        <a href="/channel/{{ $detail->user->username }}">{{ $detail->user->username }}</a>
                    @else
                        <a href="/auth">
                            <img src="{{ asset('images/profile.svg') }}" alt="" class="profile-user">
                        </a>
                    <div>
                        <a href="/auth">{{ $detail->user->username }}</a>
                    @endif
                    <span>{{ $detail->user->subscriberCount() }} Subscribers</span>
                    </div>

                    @if (auth()->check())
                        @if (auth()->user()->subscribe->contains('subscribe_id', $detail->id))
                            <form action="/unsubscribe/{{ $detail->user->username }}" method="post">
                                @csrf
                                <button type="submit" class="unsubs">Unsubscribe</button>
                            </form>
                        @else
                            <form action="/subscribe/{{ $detail->user->username }}" method="post">
                                @csrf
                                <button type="submit" class="subs">Subscribe</button>
                            </form>
                        @endif
                    @else
                        <button class="subs">
                            <a href="/auth">Subscribe</a>                    
                        </button>
                    @endif

                </div>

                <div class="vid-description">
                    <p class="description">{{ $detail->description }}</p>
                    <hr>
                    <h4>{{ $total_comment[$detail->id] }} Comments</h4>
                    <div class="add-comment">
                        <form action="comment" method="post">
                            @csrf
                            @if (auth()->check())
                                @if ($user->image == null)
                                <img src="{{ asset('images/profile.svg') }}" alt="{{ $detail->user->username }}" class="profile-user">
                                @else
                                <img src="{{ 'storage/' . $user->image }}" alt="{{ $user->username }}">
                                @endif
                            @else
                                <img src="{{ asset('images/profile.svg') }}" alt="Profile" class="profile-user">
                            @endif
                            <input type="hidden" name="detail_id" value="{{ $detail->id }}">
                            <input type="text" placeholder="Write comments..." class="input-comment" id="comment" name="comment" value="{{ old('comment') }}" autocomplete="off" required>
                            <button type="submit" class=""><i class='bx bxs-paper-plane'></i></button>
                        </form>
                    </div>
                    
                    @foreach ($comments as $comment)
                    <div class="old-comment">
                        @if ($comment->user->image == null)
                            <img src="{{ asset('images/profile.svg') }}" alt="{{ $comment->user->image }}" class="profile-user">
                        @else
                            <img src="{{ 'storage/' . $comment->user->image }}" alt="{{ $comment->user->image }}">
                        @endif
                        
                        <div>
                            <h3>{{ $comment->user->username }} <span>{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span></h3>
                            <p>
                                {{ $comment->comment }}
                            </p>
                            {{-- <div class="acomment-action">
                                <img src="images/like.png" alt="">
                                <span>120k</span>
                                <img src="images/dislike.png" alt="">
                                <span>2</span>
                                <span>REPLY</span>
                                <a href="">All replies</a>
                            </div> --}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="right-sidebar">
                @foreach ($videos as $vid)
                @if ($vid->title !== $detail->title)
                <div class="side-video-list">
                    <a href="{{ $vid->title }}" class="sm-thumbnail">
                        <img src="{{ asset('storage/' . $vid->thumbnail) }}" alt="{{ $vid->title }}">
                    </a>
                    <div class="vid-info">
                        <a href="{{ $vid->title }}">{{ $vid->title }}</a>
                        <p>{{ $vid->user->username }}</p>
                        <p>{{ $vid->days_since_creation }}</p>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>