<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Livewire\Component;

class Sales extends Component
{
    public $search;
    public $direction = 'DESC', $sort = "id";
    public $perPage = 10;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $sales = Sale::orderBy($this->sort, $this->direction)->paginate($this->perPage);
        return view('livewire.sales', compact('sales'));
    }
}
