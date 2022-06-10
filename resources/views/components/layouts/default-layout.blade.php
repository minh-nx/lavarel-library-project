<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ $title }}</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap's link
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"/>
    --}}

    {{-- Additional links --}}
    @isset($links)
        {{ $links }}
    @endisset
</head>

<body>
{{-- Header zone --}}
<div {{ $layoutAttributes ?? $attributes }}>
    <x-layouts.header :selected="$selected" id="header"/>
</div>

{{-- Main content --}}
<div {{ $attributes }}>
    {{ $content }}
</div>

{{-- Additional content --}}
{{ $slot }}

{{-- Footer zone --}}
<div {{ $layoutAttributes ?? $attributes }}>
    <x-layouts.footer id="footer"/>
</div>

{{-- Script zone --}}
@isset($scripts)
    <script>
        {{ $scripts }}
    </script>
@endisset
</body>
</html>
