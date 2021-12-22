<div>
    <div>

        <x-slot name="title">Lista de Ventas</x-slot>
        <x-slot name="page">Ventas</x-slot>

        <x-card-body>
            <x-slot name="card_title">

                <x-searcher />

                <div wire:loading class=""><span class="ms-3 spinner-border text-primary"></span>
                    Cargando...
                </div>

            </x-slot>

            <x-slot name="toolbar">
                <x-modal-button>Nueva Venta</x-modal-button>
            </x-slot>

            <x-table
                :titles="['ID','Cliente', 'Vendedor', 'Esatus', 'Enviado', 'Pagado', 'Total', 'Fecha', 'Acciones']">
                @foreach ($sales as $sale)

                    <!--end::Table row-->
                    <tr>

                        <td>
                            {{ $sale->id }}
                        </td>
                        <td class="">
                            {{ $sale->customer->name }}
                        </td>
                        <td class="">
                            {{ $sale->user->name }}
                        </td>
                        <td class="text-center">
                            @if ($sale->status == 'active')
                                <span class="badge badge-success">Activa</span>
                            @elseif($sale->status == 'cancelled')
                                <span class="badge badge-danger">Cancelada</span>
                            @else
                                <span class="badge badge-dark">Pendiente</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($sale->shipping_status)
                                <span class="badge badge-info">Enviado</span>
                            @else
                                <span class="badge badge-warning">No enviado</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($sale->payment_status)
                                <span class="badge badge-primary">Pagado</span>
                            @else
                                <span class="badge badge-secondary">Sin pago</span>
                            @endif
                        </td>
                        <td class="">
                            $ {{ number_format($sale->total,2) }}
                        </td>
                        <td class="">
                            {{ $sale->created_at }}
                        </td>



                        <td class="d-flex align-items-center">

                            <button wire:click="show({{ $sale->id }})"
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

                            <button
                                class="btn btn-sm btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger btn-icon"
                                title="Eliminar" onclick="cancelSale({{ $sale->id }})">
                                <span class="svg-icon svg-icon-danger svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3"
                                            d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM13.4 14L15.5 11.9C15.9 11.5 15.9 10.9 15.5 10.5C15.1 10.1 14.5 10.1 14.1 10.5L12 12.6L9.89999 10.5C9.49999 10.1 8.9 10.1 8.5 10.5C8.1 10.9 8.1 11.5 8.5 11.9L10.6 14L8.5 16.1C8.1 16.5 8.1 17.1 8.5 17.5C8.7 17.7 9.00001 17.8 9.20001 17.8C9.40001 17.8 9.69999 17.7 9.89999 17.5L12 15.4L14.1 17.5C14.3 17.7 14.6 17.8 14.8 17.8C15 17.8 15.3 17.7 15.5 17.5C15.9 17.1 15.9 16.5 15.5 16.1L13.4 14Z"
                                            fill="black" />
                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                    </svg>
                                </span>
                            </button>

                        </td>

                    </tr>
                @endforeach
            </x-table>


            <x-slot name="card_footer">
                <div class="d-flex justify-content-between">

                    <div class="d-flex justify-content-center">
                        @if ($sales->count() >= 5 && $search == '')
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
                        {{ $sales->links() }}

                    </div>

                </div>
            </x-slot>

        </x-card-body>



        @push('scripts')


            {{-- @include('layouts.template.scripts') --}}

            <script>
                function cancelSale(id) {

                    Swal.fire({
                        html: `¿Seguro que quieres <span class="badge badge-danger">Cancelar</span> esta venta?`,
                        icon: "question",
                        buttonsStyling: false,
                        showCancelButton: true,
                        confirmButtonText: "Ok, Cancelar",
                        cancelButtonText: 'No, Regresar',
                        customClass: {
                            confirmButton: "btn btn-danger",
                            cancelButton: 'btn btn-secondary'
                        }
                    }).then((response) => {
                        if (response.isConfirmed) {
                            window.livewire.emit('cancel_sale', id);
                        }
                    });
                };
            </script>
        @endpush



    </div>

</div>
