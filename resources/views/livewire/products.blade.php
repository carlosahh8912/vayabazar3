<div>

    <x-slot name="title">Lista de Productos</x-slot>
    <x-slot name="page">Productos</x-slot>

    <x-card-body>
        <x-slot name="card_title">

            <x-searcher />

            <div wire:loading class=""><span class="ms-3 spinner-border text-primary"></span> Cargando...
            </div>

        </x-slot>

        <x-slot name="toolbar">
            <x-modal-button>Nuevo Producto</x-modal-button>
        </x-slot>

        <x-table :titles="['ID','Producto','stock','costo', 'precio', 'status', 'comprado', 'Acciones']">
            @foreach ($products as $product)

                <!--end::Table row-->
                <tr class="">

                    <td>
                        {{ $product->id }}
                    </td>

                    <td class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <a href="#">
                                <div class="symbol-label">
                                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="product_img"
                                        class="w-100 img-fluid h-100">
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $product->description }}</a>
                        </div>
                    </td>

                    <td>
                        {{ $product->stock }}
                    </td>

                    <td>
                        $ {{ $product->cost }}
                    </td>

                    <td>
                        $ {{ $product->price }}
                    </td>

                    <td>
                        @if ($product->status == 'available')
                            <span class="badge badge-light-success">Disponible</span>
                        @elseif ($product->status == 'unavailable')
                            <span class="badge badge-light-danger">No disponible</span>
                        @elseif ($product->status == 'sold')
                            <span class="badge badge-light-info">Vendido</span>
                        @else
                            <span class="badge badge-light-dark">No disponible</span>
                        @endif
                    </td>

                    
                    <td>
                        {{ date_format(date_create($product->purchased), 'd-m-Y') }}
                    </td>


                    <td class="d-flex align-items-center">

                        <button
                            class="btn btn-sm btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary btn-icon me-1">
                            <span class="svg-icon svg-icon-primary svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z"
                                        fill="black" />
                                    <path opacity="0.3"
                                        d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z"
                                        fill="black" />
                                </svg>
                            </span>
                        </button>

                        <button wire:click="show({{ $product->id }})"
                            class="btn btn-sm btn-outline btn-outline-dashed btn-outline-info btn-active-light-info btn-icon me-1">
                            <span class="svg-icon svg-icon-info svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
                                        fill="black" />
                                    <path
                                        d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
                                        fill="black" />
                                    <path
                                        d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
                                        fill="black" />
                                </svg>
                            </span>
                        </button>

                        @if ($product->status != 'sold')
                            <button
                                class="btn btn-sm btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger btn-icon"
                                title="Eliminar" onclick="deleted({{ $product->id }})">
                                <span class="svg-icon svg-icon-danger svg-icon-2"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                            fill="black" />
                                        <path opacity="0.5"
                                            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                            fill="black" />
                                        <path opacity="0.5"
                                            d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                            fill="black" />
                                    </svg></span>
                            </button>
                        @endif

                    </td>

                </tr>
            @endforeach
        </x-table>


        <x-slot name="card_footer">
            <div class="d-flex justify-content-between">

                <div class="d-flex justify-content-center">
                    @if ($products->count() >= 5 && $search == '')
                        <div>
                            <label class="col-12 col-sm-6 col-md-6" style="width: 120px;">
                                <select wire:model="perPage" class="form-select" style="width: 110px;">
                                    <option value="5">
                                        5
                                    </option>
                                    <option value="10">
                                        10
                                    </option>
                                    <option value="25">
                                        25
                                    </option>
                                    <option value="50">
                                        50
                                    </option>
                                    <option value="100">
                                        100
                                    </option>
                                </select>
                            </label>
                        </div>
                        <span class="" style="padding-top: 8px;padding-left: 6px;">
                            por página
                        </span>
                    @endif
                </div>
                <div class="">
                    {{ $products->links() }}

                </div>

            </div>
        </x-slot>

    </x-card-body>


    <x-modal-form title="{{ empty($product_id) ? 'NUEVA MARCA' : 'ACTUALIZAR MARCA' }}" id="formModal">

        <x-slot name="content">

            <div class="mb-5">
                <label class="required form-label">Producto</label>
                <input wire:model.lazy="description" name="description" type="text"
                    class="form-control form-control-solid  {{ $errors->has('description') ? 'is-invalid' : '' }}"
                    placeholder="Nombre de la marca" required />
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="row">
                <div class="mb-5 col-6">
                    <label class="required form-label">Costo</label>
                    <input wire:model.lazy="cost" name="cost" type="number"
                        class="form-control form-control-solid  {{ $errors->has('cost') ? 'is-invalid' : '' }}"
                        placeholder="Nombre de la marca" required />
                    @error('cost') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-5 col-6">
                    <label class="required form-label">Precio</label>
                    <input wire:model.lazy="price" name="price" type="number"
                        class="form-control form-control-solid  {{ $errors->has('price') ? 'is-invalid' : '' }}"
                        placeholder="Nombre de la marca" required />
                    @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

            </div>

            <div class="mb-5">
                <label class="required form-label">Fecha de compra</label>
                <input wire:model.lazy="purchased" name="purchased" type="date"
                    class="form-control form-control-solid  {{ $errors->has('purchased') ? 'is-invalid' : '' }}"
                    placeholder="Nombre de la marca" required />
                @error('purchased') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5" wire:ignore>
                <label class="required form-label">Marca</label>
                <select wire:model.lazy="brand_id" name="brand_id" id="brand_id" 
                    class="form-control form-control-solid  {{ $errors->has('brand_id') ? 'is-invalid' : '' }}" required>
                    <option disabled selected>Marca del producto</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                @error('brand_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            @if (!is_null($product_id))
            <div class="mb-5">
                <label class="required form-label">Estatus</label>
                <select wire:model.lazy="status" name="status" placeholder="Selecciona un estatus" class="form-control form-control-solid  {{ $errors->has('status') ? 'is-invalid' : '' }}" required>
                    <option disabled>Estatus del producto</option>
                    <option value="available">Disponible</option>
                    <option value="unavailable">No Disponible</option>
                    <option value="sold">Vendido</option>
                </select>
                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            @endif

            <div class="mb-5">
                <label class="form-label">Imágen</label>
                <input wire:model="image"
                    class="form-control form-control-solid {{ $errors->has('image') ? 'is-invalid' : '' }}"
                    type="file" name="image" accept=".png, .jpg, .jpeg" />
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div wire:loading wire:loading.target="image" class="text-small text-info text-center"><span class="ms-3 spinner-border text-info"></span> Cargando Imágen...</div>

            @if ($image)
                <div class="">
                    <img class="img-thumbnail rounded mx-auto d-block" width="150"
                        src="{{ $image->temporaryUrl() }}">
                </div>
            @endif

        </x-slot>

        <x-slot name="footer">
            <div class="d-flex justify-content-end">

                <button wire:click="resetUI()" class="btn btn-light btn-active-light-primary me-2"
                    data-bs-dismiss="modal">Cancelar</button>

                @if (empty($product_id) || $product_id == 0 || $product_id == '')
                    <button type="button" id="store" wire:click.prevent="store()" wire:loading.attr="disabled"
                        wire:loading.class="disabled" class="btn btn-primary">
                        <span wire:loading.class="d-none" wire:target="store" class="indicator-label">
                            Guardar
                        </span>
                        <span wire:loading wire:target="store" class="indicator-progress">
                            Guardando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                @else
                    <button type="button" id="update" wire:click.prevent="update()" wire:loading.attr="disabled"
                        wire:loading.class="disabled" class="btn btn-info">
                        <span wire:loading.class="d-none" wire:target="update" class="indicator-label">
                            Actializar
                        </span>
                        <span wire:loading wire:target="update" class="indicator-progress">
                            Actualizando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                @endif

            </div>

        </x-slot>

    </x-modal-form>

    @push('scripts')

        @include('layouts.template.scripts')

        <script>

            function deleted(id) {

                Swal.fire({
                    html: `¿Seguro que quieres <span class="badge badge-danger">Eliminar</span> esta marca?`,
                    icon: "question",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "Ok, Eliminar",
                    cancelButtonText: 'No, Cancelar',
                    customClass: {
                        confirmButton: "btn btn-danger",
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((response) => {
                    if (response.isConfirmed) {
                        window.livewire.emit('destroy', id);
                    }
                });
            };
        </script>
    @endpush



</div>
