@props(['selected'])

<header {{ $attributes }}>
    <x-layouts.logo class="logo"/>

    <x-layouts.navigation-menu selected="{{ $selected }}"/>
</header>