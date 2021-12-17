<?php

namespace App\Http\Livewire;

use App\Models\Store;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Shipping;

class NewSale extends Component
{
    public $customer_id, $user_id, $customer_name, $customer_address, $customer_phone, $customer_email, $shipping_id; 

    public function render()
    {
        $products = Product::where('status', 'available')->get();
        $customers = Customer::where('status', 'actived')->orderBy('name', 'ASC')->get();
        $stores = Store::where('status', 'actived')->get();
        $shippings = Shipping::where('status', 'actived')->get();
        return view('livewire.new-sale', compact('products', 'customers', 'stores', 'shippings'));
    }

    public function show_customer(Customer $customer){

    }
}
