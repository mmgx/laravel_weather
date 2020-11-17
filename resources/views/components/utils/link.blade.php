@props(['active' => '', 'text' => '', 'hide' => false, 'icon' => false])

<a {{ $attributes->merge(['href' => '#', 'class' => $active]) }}>@if ($icon)<i class="{{ $icon }}"></i> @endif{{ strlen($text) ? $text : $slot }}</a>
