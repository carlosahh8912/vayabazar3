<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use App\Models\Shipping;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class Shippings extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search, $name, $shipping_id;
    public $direction = 'DESC', $sort = "id";
    public $perPage = 5;
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'name' => 'required|min:3|unique:stores'
    ];
    protected $listeners = ['destroy'];

    public function updated()
    {
        $this->validate();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // View de index page
    public function render()
    {
        $shippings = Shipping::where('name', 'like', '%' . $this->search . '%')
            ->where('status', '!=', 'deleted')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->perPage);

        return view('livewire.shippings', compact('shippings'));
    }

    // Search a register
    public function show(Shipping $shipping)
    {
        try {

            if (!$shipping) {
                throw new Exception("No se encontro la tienda.");
            }

            $this->shipping_id = $shipping->id;
            $this->name = $shipping->name;

            $this->modal(true);
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    // Create new register
    public function store()
    {
        try {
            $this->validate($this->rules);

            $shipping = Shipping::create([
                'name' => ucfirst($this->name)
            ]);

            $this->modal(false);
            $this->resetUI();
            $this->emit('toastr', ['title' => 'Creado', 'message' => 'La Marca se ha guardado correctamente!', 'icon' => 'success']);
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    // Update a register
    public function update()
    {
        $this->validate();

        if (!empty($this->getErrorBag()->messages())) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $this->getErrorBag()->messages(), 'icon' => 'error']);
        }

        $shipping = Shipping::find($this->shipping_id);

        if ($this->shipping_id) {

            $shipping->update([
                'name' => ucfirst($this->name)
            ]);


            $this->modal(false);
            $this->resetUI();
            $this->emit('toastr', ['title' => '¡Actualizado!', 'message' => 'La marca se acualizó correctamente.', 'icon' => 'success']);
        }
    }

    // Delete register
    public function destroy(Shipping $shipping)
    {
        try {

            if (!$shipping) {
                throw new Exception("No se encontro el cliente.");
            }

            if (!$shipping->delete()) {
                throw new Exception("Ocurrio un error durante el proceso.");
            }

            $this->emit('toastr', ['title' => 'Eliminado', 'message' => 'El cliente se a eliminado correctamente', 'icon' => 'success']);
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    // Reset input from modal
    public function resetUI()
    {
        $this->name = null;
        $this->shipping_id = null;
        $this->search = null;
    }

    // Interaction whit modal open and Close
    public function modal($status)
    {
        $this->emit('modal', $status);
    }
}
