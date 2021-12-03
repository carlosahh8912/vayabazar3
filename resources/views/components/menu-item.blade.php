@props(['active', 'icon', 'link', 'name'])

@php
$classes = ($active ?? false)
            ? 'menu-item  active'
            : 'menu-item';
@endphp


<div class="menu-item">
    <a class="menu-link" href="{{ $link }}">
        <span class="menu-icon">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
            {{ $icon }}
            <!--end::Svg Icon-->
        </span>
        <span class="menu-title">{{ $name }}</span>
    </a>
</div>