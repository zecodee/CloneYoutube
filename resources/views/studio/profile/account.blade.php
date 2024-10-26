@extends('profile.personal_profile')

@section('personal-content')
    <style>
        label {
            width: 120px;
            height: auto;
        }
        .content-page {
            display: flex;
            flex-direction: column;
        }

        .input-img {
            display: flex;
            align-items: center;
            width: 100%;
            height: 120px;
            color: #ffffff;
        }
        
        .input-img img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            cursor: pointer;
            object-fit: cover;
        }

        .input-img input {
            display: flex;
            align-items: center;
            width: 100%;
            font-size: 18px;
            margin-left: 1.2rem;
            cursor: pointer;
        }

        .input-img button {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 12px;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 500;
            background: #815B5B;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .input-item {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            height: 80px;
        }

        .input-item label {
            color: #ffffff;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
        }

        .input-item input {
            display: flex;
            align-items: center;
            padding: 8px;
            width: 100%;
            font-size: 18px;
        }

        .input-btn {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }

        .input-btn button {
            color: #ffffff;
            font-size: 1rem;
            font-weight: 500;
            background: #815B5B;
            width: 120px;
            padding: 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .input-btn button:hover {
            color: #d4d4d4;
            background: #6a4d4d;
            transform: scale(.9);
            transition: 320ms ease;
        }
    </style>
    <div class="title-page">
        <h1>{{ $title }}</h1>
    </div>
    
    <div class="content-page">
        <form action="/{{ $user->username }}/account/update" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-img">
                <input type="hidden" name="oldImage" value="{{ $user->image }}">

                @if ($user->image == null)
                <label for="image"><img src="{{ asset('images/profile.svg') }}" alt=""></label>
                @else
                <label for="image"><img src="{{ asset('storage/' . $user->image) }}" alt=""></label>
                @endif

                <input type="file" name="image" id="image">

                @if ($user->image)
                    <button type="submit" form="deleteImageForm">Delete Image</button>
                @endif
            </div>
            @error('image')
            <div class="invalid">
                {{ $message }}
            </div>
            @enderror

            <div class="input-item">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-btn">
                <button type="submit">Save</button>
            </div>
        </form>
    </div>

    <form id="deleteImageForm" action="/{{ $user->username }}/account/delete-image" method="post">
        @csrf
    </form>
@endsection