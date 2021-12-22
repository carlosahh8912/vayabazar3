<?php

namespace App\Http\Livewire;

use Exception;
use PDOException;
use App\Models\Sale;
use App\Models\Brand;
use App\Models\Store;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\SaleDetail;
use App\Models\Shipping;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class NewSale extends Component
{
    use WithPagination;

    public $customer_id, $user_id, $customer_name, $customer_address, $customer_phone, $customer_email;
    public $product_id, $product_description, $product_cost, $product_price, $product_stock;
    public $shipping_id, $store_id, $brand_id;
    public $total_cost, $total_items, $tax, $total, $notes, $payment_status = false, $shipping_status = false;

    public $perPage = 4;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['show_customer', 'save_sale', 'clear_cart', 'remove_item'];

    public function mount()
    {
        $this->user_id = Auth::user()->id;
        $this->get_totals();
    }

    public function render()
    {
        $cart = Cart::getContent();
        $products = Product::where('status', 'available')->where('brand_id', $this->brand_id)->orderBy('id', 'DESC')->paginate($this->perPage);
        $customers = Customer::where('status', 'actived')->orderBy('name', 'ASC')->get();
        $stores = Store::where('status', 'actived')->get();
        $shippings = Shipping::where('status', 'actived')->get();
        $brands = Brand::where('status', 'actived')->orderBy('name', 'ASC')->paginate(8);
        return view('livewire.new-sale', compact('products', 'customers', 'stores', 'shippings', 'brands', 'cart'));
    }

    public function show_customer(Customer $customer)
    {
        if (!$customer) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => 'El cliente no existe.', 'icon' => 'error']);
        }

        $this->customer_id = $customer->id;
        $this->customer_name = $customer->name;
        $this->customer_email = $customer->email;
        $this->customer_phone = $customer->phone;
        $this->customer_address = $customer->address;
    }

    public function add_cart(Product $product)
    {
        if ($this->in_cart($product->id)) {
            $this->emit('toastr', ['title' => 'Atención', 'message' => 'El producto ya esta en tu carrito.', 'icon' => 'info']);
        } else {
            Cart::add($product->id, $product->description, $product->price, 1, ['image' => $product->image, 'cost' => $product->cost]);
            $this->get_totals();
            $this->emit('toastr', ['title' => '¡Correcto!', 'message' => 'Producto agregado.', 'icon' => 'success']);
        }
    }

    public function in_cart($product)
    {
        $item = Cart::get($product);
        if ($item) {
            return true;
        } else {
            return false;
        }
    }

    public function remove_item($product)
    {
        if(!Cart::get($product)){
            $this->emit('toastr', ['title' => 'Error!', 'message' => 'El producto no se encuentra en el carrito.', 'icon' => 'error']);
        }

        Cart::remove($product);
        $this->get_totals();
        $this->emit('toastr', ['title' => '¡Correcto!', 'message' => 'El producto se elimino del carrito.', 'icon' => 'success']);
    }

    public function save_sale()
    {
        if ($this->total <= 0) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => 'No hay productos agregados en la venta.', 'icon' => 'error']);
            return;
        }

        if ($this->customer_id <= 0 || empty($this->customer_id) || is_null($this->customer_id)) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => 'Debes seleccionar un cliente.', 'icon' => 'error']);
            return;
        }

        if ($this->shipping_id <= 0 || empty($this->shipping_id) || is_null($this->shipping_id)) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => 'Debes seleccionar una paquetería.', 'icon' => 'error']);
            return;
        }

        if ($this->store_id <= 0 || empty($this->store_id) || is_null($this->store_id)) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => 'Debes seleccionar una tienda.', 'icon' => 'error']);
            return;
        }

        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'user_id' => $this->user_id,
                'customer_id' => $this->customer_id,
                'shipping_id' => $this->shipping_id,
                'store_id' => $this->store_id,
                'shipping_address' => $this->customer_address,
                'total_cost' => $this->total_cost,
                'total' => $this->total,
                'payment_status' => $this->payment_status,
                'shipping_status' => $this->shipping_status,
                'status' => 'active'
            ]);

            if (!$sale) {
                throw new Exception("Ocurrio un error durante el proceso por favor intentalo nuevamente.");
            }

            $items = Cart::getContent();

            foreach($items as $item){
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item->id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'cost' => $item->attributes->cost
                ]);

                $product = Product::find($item->id);
                $product->stock = 0;
                $product->status = 'sold';
                $product->save();
            }

            DB::commit();

            Cart::clear();
            $this->get_totals();
            $this->emit('alert', ['title' => '¡Correcto!', 'message' => 'El producto se elimino del carrito.', 'icon' => 'success']);
            $this->resetUI();
        } catch (PDOException $e) {
            DB::rollBack();
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        } catch (Exception $e) {
            DB::rollBack();
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    public function clear_cart()
    {
        Cart::clear();
        $this->get_totals();
        $this->emit('toastr', ['title' => '¡Correcto!', 'message' => 'Se han eliminado todos los productos', 'icon' => 'success']);
    }

    public function resetUI()
    {
        $this->customer_id = null;
        $this->customer_name = null;
        $this->customer_email = null;
        $this->customer_phone = null;
        $this->customer_address = null; 
        $this->shipping_id = null; 
        $this->store_id = null;
        $this->brand_id = null;
        $this->shipping_status = false;
        $this->payment_status = false;
    }

    public function get_totals(){
        $this->total_cost = 0;
        $this->total = Cart::getTotal();
        $this->total_items = Cart::getTotalQuantity();
    }
}
