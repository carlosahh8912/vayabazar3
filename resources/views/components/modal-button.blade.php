@props(['idModal' => 'modal'])


<!--begin::Button-->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $idModal }}"> --}}
<button type="button" class="btn btn-primary" wire:click="modal({{ true }})">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
    <span class="svg-icon svg-icon-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                transform="rotate(-90 11.364 20.364)" fill="black"></rect>
            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
        </svg>
    </span>
    <!--end::Svg Icon-->
    {{ $slot }}
</button>
<!--end::Button-->
