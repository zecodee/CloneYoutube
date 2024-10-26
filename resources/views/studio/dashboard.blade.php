@extends('profile.personal_profile')

@section('personal-content')
<style>
    .content-page {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        grid-column-gap: 1rem;
        grid-row-gap: 30px;
        margin-top: 15px;
        justify-items: center;
    }

    .vid-list .thumbnail {
        width: 500px;
        height: 380px;
        border-radius: 5%;
    }

    .vid-list .flex-div {
        align-items: flex-start;
        margin-top: 7px;
    }

    .vid-list .flex-div img {
        width: 35px;
        margin-right: 10px;
        border-radius: 50%;
    }

    .vid-info {
        color: #c3c3c3;
        font-size: 13px;
    }

    .vid-info a {
        font-size: 1.2rem;
        color: #eeeeee;
        font-weight: 600;
        display: block;
        margin-bottom: 5px;
    }

    .vid-info p {
        font-size: 1rem;
    }
</style>
    <div class="title-page">
        <h1>{{ $title }}</h1>
    </div>

    <div class="content-page">
        @foreach ($videos as $vid)
        <div class="vid-list">
            <a href="/{{ $vid->title }}">
                <img src="{{ asset('storage/' . $vid->thumbnail) }}" alt="Thumbnail Video" class="thumbnail">
            </a>
            <div class="vid-info">
                <a href="/{{ $vid->title }}">{{ $vid->title }}</a>
                <p>{{ $vid->user->username }}</p>
                <p>{{ $vid->days_since_creation }}</p>
                <div class="crud-button">
                    <form action="/{{ $user->username }}/dashboard/{{ $vid->id }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">
                            <i class='bx bxs-trash'></i>
                        </button>
                    </form>

                    <a href="/{{ $user->username }}/dashboard/{{ $vid->id }}/edit" class="btn-edit">
                        <i class='bx bxs-edit'></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection