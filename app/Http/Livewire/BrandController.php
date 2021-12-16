<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use Exception;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class BrandController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search, $name, $image, $brand_id;
    public $direction = 'DESC', $sort = "id";
    public $perPage = 5;
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'name' => 'required|min:3|unique:brands'
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

    public function render()
    {
        $brands = Brand::where('name', 'like', '%' . $this->search . '%')
            ->where('status', 'actived')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->perPage);

        return view('livewire.brand', compact('brands'));
    }

    public function show(Brand $brand)
    {
        try {

            if (!$brand) {
                throw new Exception("No se encontro la marca.");
            }

            $this->brand_id = $brand->id;
            $this->name = $brand->name;
            $this->image = null;

            $this->modal(true);
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    public function store()
    {
        try {
            $this->validate($this->rules);

            $brand = Brand::create([
                'name' => ucfirst($this->name)
            ]);

            $customFileName = $this->name;

            if ($this->image) {
                $customFileName = Str::slug($this->name) . '_' . uniqid() . '_.' . $this->image->extension();
                $this->image->storeAs('brands', $customFileName);
                $brand->image = $customFileName;
                $brand->save();
            }
            $this->modal(false);
            $this->resetUI();
            $this->emit('toastr', ['title' => 'Creado', 'message' => 'La marca se ha guardado correctamente!', 'icon' => 'success']);
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    public function update()
    {

        try {
            $this->validate([
                'name' => "required|min:3|unique:brands,name,{$this->brand_id}"
            ]);

            if (!empty($this->getErrorBag()->messages())) {
                throw new Exception("Hay campos que requieren su atención.");
            }

            $brand = Brand::find($this->brand_id);
            if ($this->brand_id) {
                $brand->update([
                    'name' => ucfirst($this->name)
                ]);

                $customFileName = $this->name;

                if ($this->image) {
                    $customFileName = Str::slug($this->name) . '_' . uniqid() . '_.' . $this->image->extension();
                    $this->image->storeAs('brands', $customFileName);

                    if (!is_null($brand->image)) {
                        if (file_exists('storage/brands/' . $brand->image)) {
                            unlink('storage/brands/' . $brand->image);
                        }
                    }

                    $brand->image = $customFileName;
                    $brand->save();
                }

                $this->modal(false);
                $this->resetUI();
                $this->emit('toastr', ['title' => '¡Actualizado!', 'message' => 'La marca se acualizó correctamente.', 'icon' => 'success']);
            }
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    public function destroy(Brand $brand)
    {
        try {

            if (!$brand) {
                throw new Exception("No se encontro la marca.");
            }

            if (!$brand->delete()) {
                throw new Exception("Ocurrio un error durante el proceso.");
            }

            if (!is_null($brand->image)) {
                if (file_exists('storage/brands/' . $brand->image)) {
                    unlink('storage/brands/' . $brand->image);
                }
            }

            $this->emit('toastr', ['title' => 'Eliminado', 'message' => 'La marca se a eliminado correctamente', 'icon' => 'success']);
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    public function resetUI()
    {
        $this->name = null;
        $this->image = null;
        $this->brand_id = null;
        $this->search = null;
    }

    public function modal($status)
    {
        $this->emit('modal', $status);
    }
}
