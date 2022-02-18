<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use PDOException;

class Products extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search, $description, $product_id, $cost, $price, $purchased, $image, $brand_id, $status;
    public $direction = 'DESC', $sort = "id";
    public $perPage = 5;
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'description' => 'required|min:4',
        'cost' => 'required|numeric',
        'price' => 'required|numeric|min:1',
        'purchased' => 'required|date',
        'brand_id' => 'required|numeric',
    ];
    protected $listeners = ['destroy'];

    public function updated()
    {
        $this->validate($this->rules);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // View de index page
    public function render()
    {
        $products = Product::where('description', 'like', '%' . $this->search . '%')
            ->where('status', '!=', 'removed')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->perPage);

        $brands = Brand::where('status', 'actived')->orderBy('name', 'ASC')->get();

        return view('livewire.products', compact('products', 'brands'));
    }

    // Search a register
    public function show(Product $product)
    {
        try {

            if (!$product) {
                throw new Exception("No se encontro el producto.");
            }

            $this->product_id = $product->id;
            $this->brand_id = $product->brand_id;
            $this->description = $product->description;
            $this->cost = $product->cost;
            $this->price = $product->price;
            $this->purchased = date_format(date_create($product->purchased), 'Y-m-d');
            $this->image = null;
            $this->status = $product->status;

            $this->modal(true);
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    // Create new register
    public function store()
    {
        try {
            $validate = $this->validate($this->rules);

            // if($validate){
            //     throw new Exception("Error en la validación");
            // }

            $brand = Product::create([
                'description' => ucfirst($this->description),
                'brand_id' => $this->brand_id,
                'cost' => intval($this->cost),
                'price' => intval($this->price),
                'purchased' => $this->purchased,
                'stock' => 1,
                'status' => 'available',
            ]);

            $customFileName = '';

            if ($this->image) {
                $customFileName = uniqid() . '_.' . $this->image->extension();
                $this->image->storeAs('products', $customFileName, 's3');
                $brand->image = $customFileName;
                $brand->save();
            }
            $this->modal(false);
            $this->resetUI();
            $this->emit('toastr', ['title' => 'Creado', 'message' => 'El producto se ha guardado correctamente!', 'icon' => 'success']);
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        } catch (PDOException $e) {
            $this->emit('toastr', ['title' => '¡DB Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    // Update a register
    public function update()
    {
        try {
            $this->validate();

            if (!empty($this->getErrorBag()->messages())) {
                throw new Exception("Hay campos que requieren su atención.");
            }

            if ($this->product_id) {
                $product = Product::find($this->product_id);
                $product->update([
                    'description' => ucfirst($this->description),
                    'brand_id' => $this->brand_id,
                    'cost' => $this->cost,
                    'price' => $this->price,
                    'purchased' => $this->purchased,
                    'status' => $this->status,
                ]);

                $customFileName = $this->description;

                if ($this->image) {
                    $customFileName = uniqid() . '_.' . $this->image->extension();
                    $this->image->storeAs('products', $customFileName);

                    if (!is_null($product->image)) {
                        if (file_exists('storage/products/' . $product->image)) {
                            unlink('storage/products/' . $product->image);
                        }
                    }

                    $product->image = $customFileName;
                    $product->save();
                }

                $this->modal(false);
                $this->resetUI();
                $this->emit('toastr', ['title' => '¡Actualizado!', 'message' => 'El producto se acualizó correctamente.', 'icon' => 'success']);
            }
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    // Delete register
    public function destroy(Product $product)
    {
        try {

            if (!$product) {
                throw new Exception("No se encontro el producto.");
            }

            if (!$product->delete()) {
                throw new Exception("Ocurrio un error durante el proceso.");
            }

            if (!is_null($product->image)) {
                if (file_exists('storage/products/' . $product->image)) {
                    unlink('storage/products/' . $product->image);
                }
            }

            $this->emit('toastr', ['title' => 'Eliminado', 'message' => 'El producto se a eliminado correctamente', 'icon' => 'success']);
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    // Reset input from modal
    public function resetUI()
    {
        $this->description = null;
        $this->product_id = null;
        $this->cost = null;
        $this->price = null;
        $this->purchased = null;
        $this->image = null;
        $this->brand_id = null;
        $this->search = null;
    }

    // Interaction whit modal open and Close
    public function modal($status)
    {
        $this->emit('modal', $status);
    }
}
