<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Products extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search, $description, $product_id, $cost, $price, $purchased, $image, $brand_id;
    public $direction = 'DESC', $sort = "id";
    public $perPage = 5;
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'description' => 'required|min:4',
        'cost' => 'required|number',
        'price' => 'required|number|min:1',
        'purchased' => 'date'
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
        $customers = Product::where('description', 'like', '%' . $this->search . '%')
            ->where('status', '!=', 'deleted')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->perPage);

        return view('livewire.products', compact('products'));
    }

    // Search a register
    public function show(Product $product)
    {
    }

    // Create new register
    public function store()
    {
    }

    // Update a register
    public function update()
    {
    }

    // Delete register
    public function destroy(Product $product)
    {
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
