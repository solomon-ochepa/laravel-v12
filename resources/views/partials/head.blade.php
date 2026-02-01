<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="{{ csrf_token() }}" name="csrf-token">

<title>{{ $title ? $title . ' - ' : '' }}{{ config('app.name', 'Laravel') }}</title>

<!-- Fonts -->
<link href="https://fonts.bunny.net" rel="preconnect">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
