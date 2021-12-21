<div class="col-5 mx-2 mb-3 card-flush border-dashed rounded d-flex flex-center flex-column p-3">
    <!--begin::Avatar-->
    <div class="symbol symbol-65px symbol-circle mb-5">
        <img src="{{ asset('storage/products/'.$image) }}" alt="product">
    </div>
    <!--end::Avatar-->
    <!--begin::Name-->
    <p class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-1">{{ $id }}</p>
    <!--end::Name-->
    <!--begin::Info-->
    <div class="d-flex flex-center flex-wrap mb-5">
        <!--begin::Stats-->
        <div class="border border-dashed text-center rounded min-w-125px py-3 px-2 mx-1 mb-3">
            <div class="fw-bold text-gray-400">Costo</div>
            <div class="fs-6 fw-bolder text-gray-700">$ {{ $cost }}</div>
        </div>
        <!--end::Stats-->
        <!--begin::Stats-->
        <div class="border border-dashed text-center rounded min-w-125px py-3 px-2 mx-1 mb-3">
            <div class="fw-bold text-gray-400">Precio</div>
            <div class="fs-6 fw-bolder text-gray-700">$ {{ $price }}</div>
        </div>
        <!--end::Stats-->
    </div>
    <!--end::Info-->
    <!--begin::Follow-->
    <button type="button" wire:click="add_cart({{ $id }})" class="btn btn-sm btn-light-info">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr012.svg-->
        <span class="svg-icon svg-icon-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path
                    d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z"
                    fill="black" />
                <path opacity="0.3"
                    d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z"
                    fill="black" />
                <path opacity="0.3"
                    d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z"
                    fill="black" />
            </svg>
        </span>
        <!--end::Svg Icon-->Agregar
    </button>
    <!--end::Follow-->
</div>
