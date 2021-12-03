<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BrandController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search, $name, $image;
    public $direction = 'DESC', $sort = "id";
    public $perPage = 5;
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'name' => 'required|min:6',
        'image' => 'image'
    ];

    public function updated($name)
    {
        $this->validateOnly($name);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $brands = Brand::where('name', 'like', '%'. $this->search .'%')
                        ->where('status', 'actived')
                        ->orderBy($this->sort, $this->direction)
                        ->paginate($this->perPage);

        return view('livewire.brand', compact('brands'));
    }
}
