<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | ZeTube</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style_auth.css') }}">
</head>
<body>
    
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="register" method="post">
                @csrf
                <h1>Create Account</h1>

                <input type="text" placeholder="Name" name="name" autofocus autocomplete="off" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid">
                    {{ $message }}
                </div>   
                @enderror

                <input type="text" placeholder="Username" name="username" autocomplete="off" value="{{ old('username') }}" required>
                @error('username')
                <div class="invalid">
                    {{ $message }}
                </div>   
                @enderror

                <input type="email" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}" required>
                @error('email')
                <div class="invalid">
                    {{ $message }}
                </div>   
                @enderror

                <input type="password" placeholder="Password" name="password" autocomplete="off" value="{{ old('password') }}" required>
                @error('password')
                <div class="invalid">
                    {{ $message }}
                </div>   
                @enderror
                
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <!-------------------------------------------------------------------------------------->
        <div class="form-container sign-in">
            <form action="auth" method="post">
                @csrf
                <h1>Sign In</h1>

                <input type="text" placeholder="Username" name="username" autofocus autocomplete="off" value="{{ old('username') }}" required>
                @error('username')
                <div class="invalid">
                    {{ $message }}
                </div>   
                @enderror

                <input type="email" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}" required>
                @error('email')
                <div class="invalid">
                    {{ $message }}
                </div>   
                @enderror

                <input type="password" placeholder="Password" name="password" autocomplete="off" value="{{ old('password') }}" required>
                @error('password')
                <div class="invalid">
                    {{ $message }}
                </div>   
                @enderror

                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome to ZeTube!</h1>
                    <p>Register your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                    <a href="/" class="hidden" id="back">Back</a>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Let's Try ZeTube!</h1>
                    <p>Login with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                    <a href="/" class="hidden" id="back">Back</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/script_auth.js') }}"></script>
</body>
</html>