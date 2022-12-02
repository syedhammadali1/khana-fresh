<?php

namespace App\Http\Livewire\Component\Frontend\Menu;

use App\Models\Product as ModelsProduct;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    public $search = '';
// search bar reset
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.component.frontend.menu.product',[
            'products' => ModelsProduct::with('media')->where('name', 'like', '%'.$this->search.'%')->paginate(12),
        ]);
    }
}
