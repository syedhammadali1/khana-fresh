<?php

namespace App\Http\Livewire\Component\Frontend\Menu\User\Single;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Livewire\Component;

class ProductWeek extends Component
{
    public $userplan, $week, $for, $wa, $wb, $canChange, $attribute;

    public function mount()
    {
        $this->week = $this->week->format('Y-m-d');
        $this->attribute =  str_replace(" ", "", $this->for);
        if ($this->for == 'week 1') {
            $this->wa = CarbonImmutable::parse($this->userplan->created_at)->format('Y-m-d');
        } else {
            $this->wa = CarbonImmutable::parse($this->week)->startOfWeek()->format('Y-m-d');
        }

        if ($this->for == 'week 4') {
            $this->wb = CarbonImmutable::parse($this->userplan->expire_at)->format('Y-m-d');
        } else {
            $this->wb = CarbonImmutable::parse($this->week)->endOfWeek()->format('Y-m-d');
        }

        $this->canChange = isWeekDateEditable($this->week);
    }

    protected $rules = [
        'week' => [
            'before_or_equal:wb', 'after_or_equal:wa'
        ],

    ];
    protected $validationAttributes = [
        'wa' => 'first day of this week',
        'wb' => 'last day of this week',
    ];

    public function updated($propertyName)
    {
        $this->validate(
            [
                'week' => [
                    function ($attribute, $value, $fail) {
                        $val = CarbonImmutable::parse($value);
                        if ($val->isSunday()) {
                            $fail('We deliver on Tuesday to Suturday');
                        } elseif ($val->isMonday()) {
                            $fail('We deliver on Tuesday to Suturday');
                        }
                    }
                ]
            ],
        );
        try {
            //code...
            $this->validateOnly($propertyName);
            $this->userplan->update([
                $this->attribute => $this->week
            ]);
            $this->dispatchBrowserEvent('toast', [
                'message' => 'Your ' . $this->for . ' date has been updated to ' . $this->week,
                'type' => 'success',
            ]);
            if (!isWeekDateEditable($this->week)) {
                $this->dispatchBrowserEvent('toast', [
                    'message' => 'You cannot update your ' . $this->for . ' date after you refresh the page cause it\'s under 72 hours!',
                    'type' => 'danger',
                ]);
            }
        } catch (\Exception $e) {
            //throw $th;
        }
    }

    public function render()
    {
        return view('livewire.component.frontend.menu.user.single.product-week');
    }
}
