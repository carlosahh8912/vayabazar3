<x-sidebar>

    <x-menu-item name="Dashboard" :link="route('dashboard')">
        <x-slot name="icon">
            <span class="svg-icon svg-icon-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
                    <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                        fill="black" />
                </svg>
            </span>
        </x-slot>
    </x-menu-item>

    <x-menu-item name="Clientes" :link="route('customers')" class="active">
        <x-slot name="icon">
            <span class="svg-icon svg-icon-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
                    <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                        fill="black" />
                </svg>
            </span>
        </x-slot>
    </x-menu-item>

    <x-menu-item name="Productos" :link="route('products')" class="active">
        <x-slot name="icon">
            <span class="svg-icon svg-icon-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
                    <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                        fill="black" />
                </svg>
            </span>
        </x-slot>
    </x-menu-item>

    <x-menu-item name="Ventas" :link="route('sales')" class="active">
        <x-slot name="icon">
            <span class="svg-icon svg-icon-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
                    <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                        fill="black" />
                </svg>
            </span>
        </x-slot>
    </x-menu-item>

    <x-menu-item name="Marcas" :link="route('brands')" class="active">
        <x-slot name="icon">
            <span class="svg-icon svg-icon-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
                    <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                        fill="black" />
                </svg>
            </span>
        </x-slot>
    </x-menu-item>

    <x-menu-item name="Tiendas" :link="route('stores')" class="active">
        <x-slot name="icon">
            <span class="svg-icon svg-icon-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
                    <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                        fill="black" />
                </svg>
            </span>
        </x-slot>
    </x-menu-item>

    <x-menu-item name="Paqueterias" :link="route('shippings')" class="active">
        <x-slot name="icon">
            <span class="svg-icon svg-icon-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
                    <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                        fill="black" />
                </svg>
            </span>
        </x-slot>
    </x-menu-item>

</x-sidebar>
