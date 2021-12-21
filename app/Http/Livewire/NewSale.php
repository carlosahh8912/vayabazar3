<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Store;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Shipping;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class NewSale extends Component
{
    use WithPagination;
    
    public $customer_id, $user_id, $customer_name, $customer_address, $customer_phone, $customer_email; 
    public $product_id, $product_description, $product_cost, $product_price, $product_stock;
    public $shipping_id, $store_id, $brand_id;
    public $total_cost, $total_items, $tax, $total, $notes, $payment_status, $shipping_status, $cart=[];

    public $perPage = 4;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['show_customer', 'save_sale', 'clear_cart'];

    public function mount(){
        $this->user_id = Auth::user()->id;
    }

    public function render()
    {
        $cart = Cart::getContent();
        $products = Product::where('status', 'available')->where('brand_id', $this->brand_id)->orderBy('id', 'DESC')->paginate($this->perPage);
        $customers = Customer::where('status', 'actived')->orderBy('name', 'ASC')->get();
        $stores = Store::where('status', 'actived')->get();
        $shippings = Shipping::where('status', 'actived')->get();
        $brands = Brand::where('status', 'actived')->orderBy('name', 'ASC')->paginate(5);
        return view('livewire.new-sale', compact('products', 'customers', 'stores', 'shippings', 'brands', 'cart'));
    }

    public function show_customer(Customer $customer){
        if (!$customer) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => 'El cliente no existe.', 'icon' => 'error']);
        }

        $this->customer_id = $customer->id;
        $this->customer_name = $customer->name;
        $this->customer_email = $customer->email;
        $this->customer_phone = $customer->phone;
        $this->customer_address = $customer->address;
    }

    public function add_cart(Product $product){
        Cart::add($product->id, $product->description, $product->cost, 1, ['image' => $product->image, 'cost' => $product->cost]);

        if($this->in_cart($product->id)){
            $this->emit('toastr', ['title' => 'No se agrego', 'message' => 'El producto ya esta en tu carrito.', 'icon' => 'info']);
        }else{
            $this->total = Cart::getTotal();
            // $this->total_items = Cart::getTotal();
            $this->emit('toastr', ['title' => '¡Correcto!', 'message' => 'Producto agregado.', 'icon' => 'success']);
        }


    }

    public function in_cart($product){
        $item = Cart::get($product);
        if($item){
            return true;
        }else{
            return false;
        }
    }

    public function save_sale(){

    }

    public function resetUI(){

    }
}
