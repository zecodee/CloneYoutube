<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZeTube</title>
    <link rel="stylesheet" href="{{ asset('css/style_studio.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    @include('partials.studio.sidebar')
    
    {{-- Personal Content --}}
    <main class="container">
        @yield('personal-content')
    </main>
    <script src="{{ asset('js/upload.js') }}"></script>
</body>
</html>