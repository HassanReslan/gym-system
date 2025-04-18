<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Default Title')</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
   <!-- Scripts -->
 @vite(['resources/css/app.css', 'resources/js/app.js'])
 
  <!-- For Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{asset('css\app.css')}}">
  <script src="{{asset('/js/imageUploader.js')}}" defer></script>


 @livewireStyles
  
</head>
<body>
    @include('layouts.sidebar')
    <div class="main">
    @yield('content')
    </div>
    @livewireScripts
</body>
</html>
