@use("App\Utils\Sorting")
@use("App\Utils\Text")

@props([
    'text' => '',
    'route',
    'sortBy',
    'sort',
    'direction',
    'isDebug' => false
])
@php

if ($text === "") {
   $text = $sortBy ? Text::capitalize($sortBy) : '';
}

$href = route($route, [
    'sort' => $sortBy,
    'direction' => Sorting::direction($sortBy, $sort, $direction)
]);

$attrs = [];
if ($isDebug) {
    $debug_href = parse_url($href, PHP_URL_PATH) . '?' . parse_url($href, PHP_URL_QUERY);
    $attrs = ['data-debug-href' => $debug_href];
}

$classes = [
    'sort-link',
    'sort-link_active' => $sortBy === $sort,
    'sort-link_debug' => $isDebug,
]
@endphp

<a {{ $attributes->class($classes)->merge($attrs) }}
   href="{{ $href }}"
>
    {{ $icon ?? '' }}
    
    @if($slot->isNotEmpty())
        {{ $slot }}
    @else
        {{ $text }}
    @endif
    {{ Sorting::arrow($sortBy, $sort, $direction) }}
</a>