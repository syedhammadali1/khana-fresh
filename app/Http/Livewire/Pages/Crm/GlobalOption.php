<?php

namespace App\Http\Livewire\Pages\Crm;

use App\Models\Option;
use App\Models\Options;
use Livewire\Component;

class GlobalOption extends Component
{
    public $selectedItem,
        $action,
        $updateInputKey,
        $updateInputValue,
        $description,
        $data = [],
        $restrictedDates,
        $updatedData = [];

    protected $validationAttributes = [
        'updateInputKey' => 'Key',
        'updateInputValue' => 'Value'
    ];

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;
        $this->action = $action;
        $this->data = Options::find($itemId);
        $this->updateInputKey = $this->data['key'];
        $this->updateInputValue = $this->data['value'];

        if ($action == 'edit') {
            $this->dispatchBrowserEvent('modal', [
                'name' => '#modalForm',
                'action' => 'show',
            ]);
        } else {
            // $this->dispatchBrowserEvent('openModal');
        }
    }

    public function save()
    {

        // if set to true then it means add ka method call huwa hai.
        $addAction = true;

        // key ager admin email hai.
        if ($this->updateInputKey == 'admin_email') {
            $this->validate([
                'updateInputValue' => 'required'
            ]);
            $this->updatedData = [
                'value' => $this->updateInputValue
            ];
            // if set to false then it mean add ka method call nai huwa.
            $addAction = false;
        }
        // key agar restricted_delivery_dates
        if ($this->updateInputKey == 'restricted_delivery_dates') {
            $this->updatedData = [
                'value' => $this->updateInputValue
            ];
            // if set to false then it mean add ka method call nai huwa.
            $addAction = false;
        }

        // ager add ka method call nai howa tou obvio update chalay ga.
        if (!$addAction) {
            Options::find($this->selectedItem)->update($this->updatedData);
        }

        // add method
        if ($addAction) {
            $this->validate([
                'updateInputKey' => 'required',
                'updateInputValue' => 'required',
                'description' => 'required|min:10'
            ]);
            $this->updatedData = [
                'key' => $this->updateInputKey,
                'description' => $this->description,
                'value' => $this->updateInputValue
            ];
            Options::create($this->updatedData);
        }
        $this->dispatchBrowserEvent('modal', [
            'name' => '#modalForm',
            'action' => 'hide',
        ]);
    }

    public function add()
    {
        $this->updateInputKey = '';
        $this->updateInputValue = '';
        $this->description = '';
        $this->action = 'add';
        $this->dispatchBrowserEvent('modal', [
            'name' => '#modalForm',
            'action' => 'show',
        ]);
    }



    public function render()
    {

        return view('livewire.pages.crm.global-option', [
            'options' => Options::paginate(10),
            'r' => convertStringToArray(Options::where('key', 'restricted_delivery_dates')->first()->value)
        ])
            ->extends('layouts.app')
            ->slot('wrapper');
    }


}
