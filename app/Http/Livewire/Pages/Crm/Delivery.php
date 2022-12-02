<?php

namespace App\Http\Livewire\Pages\Crm;

use App\Models\UserPlan;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class Delivery extends Component
{
    use WithPagination;
    public $from, $to;
    public function mount()
    {
        $dates = getDeliveryDate();
        $this->from = $dates['from'];
        $this->to = $dates['to'];
    }
    public function filter()
    {
        $this->from = Carbon::parse($this->from)->toDateString();
        $this->to = Carbon::parse($this->to)->toDateString();
        $this->render();
    }
    public function filterReset()
    {
        $dates = getDeliveryDate();
        $this->from = $dates['from'];
        $this->to = $dates['to'];
        $this->render();
    }

    public function render()
    {
        return view('livewire.pages.crm.delivery', [
            'plans' =>  UserPlan::where('status', '=', 2)
                ->where(function ($query) {
                    $query->orWhereBetween('week1', [$this->from, $this->to])
                        ->orWhereBetween('week2', [$this->from, $this->to])
                        ->orWhereBetween('week3', [$this->from, $this->to])
                        ->orWhereBetween('week4', [$this->from, $this->to]);
                })
                ->paginate(10)
        ])
            ->extends('layouts.app')
            ->slot('wrapper');
    }

    // public function downloadPDF(UserPlan $user_plan)
    // {
    //     // dd($user_plan);
    //     $data = [
    //         'title' => 'Welcome to ItSolutionStuff.com',
    //         'date' => date('m/d/Y')
    //     ];

    //     $pdf = PDF::loadView('mypdf', $data);
    //     return $pdf->download('itsolutionstuff.pdf');
    // }
}
