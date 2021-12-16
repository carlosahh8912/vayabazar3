@props(['id' => null, 'title' => 'titulo'])

<div wire:ignore.self class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" id="{{ $id }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">{{ $title }}</h5>
                <span wire:loading class="indicator-progress">
                    <span class="mx-2 spinner-border-sm spinner-border text-primary"></span> Cargando...
                </span>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" wire:click="resetUI()" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="black"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="black"></rect>
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body border-0">
                {{ $content }}
            </div>

            <div class="modal-footer border-0">
                {{ $footer }}
            </div>

        </div>
    </div>
</div>
