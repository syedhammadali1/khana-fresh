<?php

namespace App\Http\Livewire\Component\Frontend\Menu\User\Single;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Product extends Component
{
    public $model, $key, $select, $oldSelect, $pkey, $canChange, $plan_id,
        $days = [
            'Mon' => 'Monday',
            'Tue' => 'Tuesday',
            'Wed' => 'Wednesday',
            'Thu' => 'Thursday',
            'Fri' => 'Friday',
            'Sat' => 'Saturday',
            'Sun' => 'Sunday'
        ];
    public function mount()
    {
        $this->select = $this->model->pivot->day;
        $this->pkey = $this->model->pivot->key;
        $this->plan_id = $this->model->pivot->plan_id;
        if ($this->select == $this->days[Carbon::now()->format('D')]) {
            $this->canChange = true;
        }
        unset($this->days[Carbon::now()->format('D')]);
    }
    public function changeDay()
    {
        // auth()->user()->meals[$key]->pivot
        //     ->where('user_id', auth()->id())
        //     ->where('product_id', $this->model->id)
        //     ->where('plan_id', $this->plan_id)
        //     ->where('key', $this->pkey)
        //     ->update([
        //         'day' => $this->select
        //     ]);

        // DB::table('product_user')
        //     ->where('product_id', $this->model->id)
        //     ->where('user_id', auth()->id())
        //     ->where('plan_id', $this->plan_id)
        //     ->where('key', $this->pkey)
        //     ->update([
        //         'day' => $this->select
        //     ]);

        // $this->dispatchBrowserEvent('toast', [
        //     'message' => 'Your Meal ' . $this->model->name . ' has been updated to ' . $this->select . '!',
        //     'type' => 'success',
        // ]);

        //blade
        //  @if (!$canChange)
        //                 <div x-data="{ open: false }">
        //                     <div class="main-change" @click="open = ! open"><img
        //                             src="{{ asset('assets/edit-icon.png') }}" width="35" />
        //                     </div>

        //                     <div x-show="open" @click.outside="open = false">
        //                         <select wire:model.defer='select' wire:change='changeDay' class="uk-select"
        //                             style="user-select: auto;">
        //                             @foreach ($days as $item)
        //                                 <option value="{{ $item }}" style="user-select: auto;">
        //                                     {{ $item }}
        //                                 </option>
        //                             @endforeach
        //                         </select>
        //                     </div>
        //                 </div>
        //             @else
        //                 <div class="main-change"><img src="{{ asset('assets/cantedit-icon.png') }}" width="35" />
        //                 </div>
        //             @endif

    }
    public function render()
    {
        return view('livewire.component.frontend.menu.user.single.product',);
    }
}
