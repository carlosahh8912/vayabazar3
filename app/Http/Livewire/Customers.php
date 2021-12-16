<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Customers extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $search, $name, $email, $address, $phone, $customer_id;
    public $direction = 'DESC', $sort = "id";
    public $perPage = 5;
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'name' => 'required|min:4',
        'email' => 'unique:customers|email',
        'phone' => 'digits:10'
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
        $customers = Customer::where('name', 'like', '%' . $this->search . '%')
        ->where('status', '!=','deleted')
        ->orderBy($this->sort, $this->direction)
        ->paginate($this->perPage);

        return view('livewire.customers', compact('customers'));
    }

    // Search a register
    public function show(Customer $customer){
        try {

            if (!$customer) {
                throw new Exception("No se encontro el cliente.");
            }

            $this->customer_id = $customer->id;
            $this->name = $customer->name;
            $this->email = $customer->email;
            $this->phone = $customer->phone;
            $this->address = $customer->address;

            $this->modal(true);
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    // Create new register
    public function store(){
        try {
            $this->validate($this->rules);

            $brand = Customer::create([
                'name' => ucfirst($this->name),
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address
            ]);

            $this->modal(false);
            $this->resetUI();
            $this->emit('toastr', ['title' => 'Creado', 'message' => 'El cliente se ha guardado correctamente!', 'icon' => 'success']);
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    // Update a register
    public function update(){
        try {
            $this->validate([
                'name' => "required|min:4",
                'email' => "unique:customers,email,{$this->customer_id}",
            ]);

            if (!empty($this->getErrorBag()->messages())) {
                throw new Exception("Hay campos que requieren su atención.");
            }

            $customer = Customer::find($this->customer_id);
            
            if ($this->customer_id) {

                $customer->update([
                    'name' => ucfirst($this->name),
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'address' => $this->address
                ]);


                $this->modal(false);
                $this->resetUI();
                $this->emit('toastr', ['title' => '¡Actualizado!', 'message' => 'El cliente se acualizó correctamente.', 'icon' => 'success']);

            }
        } catch (Exception $e) {
            $this->emit('toastr', ['title' => '¡Error!', 'message' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    // Delete register
    public function destroy(Customer $customer){
        try {

            if (!$customer) {
                throw new Exception("No se encontro el cliente.");
            }

            if (!$customer->delete()) {
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
        $this->email = null;
        $this->phone = null;
        $this->address = null;
        $this->customer_id = null;
        $this->search = null;
    }

    // Interaction whit modal open and Close
    public function modal($status)
    {
        $this->emit('modal', $status);
    }
}
