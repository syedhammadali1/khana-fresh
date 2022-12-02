<?php

namespace App\Http\Livewire\Pages\Crm;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StockDetails extends Component
{
    use WithPagination;
    public $product, $from, $to;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->from = Carbon::parse(now())->toDateString();
        $this->to = Carbon::parse(now())->toDateString();
    }
    public function filter()
    {
        $this->from = Carbon::parse($this->from)->toDateString();
        $this->to = Carbon::parse($this->to)->toDateString();
        $this->render();
    }
    public function filterReset()
    {
        $this->from = Carbon::parse(now())->toDateString();
        $this->to = Carbon::parse(now())->toDateString();
        $this->render();
    }

    public function render()
    {
        return view('livewire.pages.crm.stock-details', [
            'list' =>  DB::table('stock_details_pivot')
                ->where('product_id', $this->product->id)
                ->whereBetween('created_at', [$this->from, $this->to])
                ->get()
        ])
            ->extends('layouts.app')
            ->slot('wrapper');
    }
}
