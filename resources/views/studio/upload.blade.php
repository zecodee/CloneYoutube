@extends('profile.personal_profile')

@section('personal-content')
<style>
    .content-page {
        display: flex;
        justify-content: space-around;
    }

    .content-page:nth-child(3){
        flex-direction: column;
        justify-content: center;
    }

    .upload-vid {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 50%;
        height: auto;
        position: relative;
        max-width: 480px;
        margin-bottom: 20px; 
    }

    .video-content {
        width: 100%;
        overflow: hidden;
        border-radius: 10px;
        border: 1px solid #fff
    }

    video {
        width: 100%;
        height: 240px; 
    }

    .content {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .text {
        font-size: 18px;
        color: #ffffff;
    }

    .input-vidio {
        width: 200px;
        height: 50px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        outline: none;
        transition: background-color 0.3s ease;
        display: inline-block;
        padding: 15px 25px;
        margin-top: 12px;
        font-size: 1rem;
        text-align: center;
        text-decoration: none;
        border-radius: 4px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .input-vidio:hover {
        background-color: #45a049;
    }

    .input-vidio:active {
        background-color: #3e8e41;
    }

    .input-vidio::file-selector-button {
        display: none;
    }

    .upload-img {
        width: 40%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .input-image-label {
        margin-top: 1rem;
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .input-image-label:hover {
        background-color: #45a049;
    }

    .input-image-label::file-selector-button {
        display: none;
    }

    .image-preview {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 245px;
        text-align: center;
        border: 1px solid #fff;
        border-radius: 10px;
    }

    #image-preview {
        max-width: 100%;
        max-height: 200px;
        display: block;
        margin: auto;
    }

    .save-btn {
        color: #ffffff;
        font-size: 1rem;
        font-weight: 500;
        background: #815B5B;
        width: 120px;
        padding: 12px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        margin-bottom: 2rem;
    }

    .save-btn:hover {
        color: #d4d4d4;
        background: #6a4d4d;
        transform: scale(.9);
        transition: 320ms ease;
    }

    .upload-text {
        margin-bottom: 1.5rem;
    }
    
    .title {
        width: 100%;
        height: auto;
        padding: 20px;
        background: transparent;
        border: 1px solid #fff;
        outline: none;
        font-size: 1rem;
        color: #fff;
    }

    .desc {
        width: 100%;
        height: 220px;
        padding: 20px;
        background: transparent;
        border: 1px solid #fff;
        outline: none;
        font-size: 1rem;
        color: #fff;
    }
</style>

    <div class="title-page">
        <h1>{{ $title }}</h1>
    </div>

        <form action="/{{ $user->username }}/upload" method="post" enctype="multipart/form-data">
            @csrf
        <div class="content-page">
                <div class="upload-vid">
                    <div class="video-content">
                        <video id="preview-video" autoplay controls></video>
                        <img id="preview-image" src="" alt="Preview Image" style="display:none;">
                    </div>
                    <div id="cancel-btn" style="display:none;">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="file-name" style="display:none;">
                        File name here
                    </div>
                    <input id="video" name="video" type="file" accept="video/*" class="input-vidio" required>
                </div>
                <div class="upload-img">
                    <label for="thumbnail" class="image-preview">
                        <img id="image-preview" src="{{ asset('images/null.png') }}" alt="Preview Image">
                    </label>
                    <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="input-image" style="display: none;" required>
                    <label for="thumbnail" class="input-image-label">Choose Thumbnail</label>
                </div>
        </div>
        <div class="content-page">
            <div class="upload-text">
                <input type="text" name="title" id="title" class="title" value="{{ old('title') }}" placeholder="Add title..." autocomplete="off" required>
                @error('title')
                <div class="invalid">
                    {{ $message }}
                </div>   
                @enderror
            </div>

            <div class="upload-text">
                <textarea name="description" id="description" class="desc" required placeholder="Add description...">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid">
                    {{ $message }}
                </div>   
                @enderror
            </div>
        </div>
        <button class="save-btn">Save</button>
        </form>
@endsection