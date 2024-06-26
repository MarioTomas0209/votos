<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;
use App\Models\Comparison;
use Livewire\Attributes\On;

class ItemsComparisonsComponent extends Component
{

    public $cant = 10;
    public $Id = 0;
    public $item1_id;
    public $item2_id;
    public function render()
    {
        $comparisons = Comparison::with('item1', 'item2')->paginate($this->cant);

        $usedItemIds = Comparison::pluck('item1_id')->merge(Comparison::pluck('item2_id'))->toArray();

        $items = Item::whereNotIn('id', $usedItemIds)->get();

        return view('livewire.items-comparisons-component', compact('comparisons', 'items'));
    }


    public function clear()
    {
        $this->reset([
            'item1_id',
            'item2_id',
        ]);
        $this->resetErrorBag();
    }

    public function message()
    {
        return [
            'item1_id.required' => 'El campo Item 1 es obligatorio.',
            'item2_id.required' => 'El campo Item 2 es obligatorio.',
            'item1_id.exists' => 'El campo Item 1 debe ser un ítem válido.',
            'item2_id.exists' => 'El campo Item 2 debe ser un ítem válido.',
            'item1_id.different' => 'El campo Item 1 y Item 2 deben ser diferentes.',
            'item2_id.different' => 'El campo Item 2 y Item 1 deben ser diferentes.',
        ];
    }

    public function store()
    {
        $rules = [
            'item1_id' => 'required|different:item2_id|exists:items,id',
            'item2_id' => 'required|exists:items,id',
        ];

        $messages = $this->message();

        $this->validate($rules, $messages);

        $item1Exists = Comparison::where('item1_id', $this->item1_id)->orWhere('item2_id', $this->item1_id)->exists();
        $item2Exists = Comparison::where('item1_id', $this->item2_id)->orWhere('item2_id', $this->item2_id)->exists();

        if ($item1Exists || $item2Exists) {
            $this->addError('item1_id', 'Uno o ambos ítems ya están en una comparación.');
            return;
        }

        $comparison = new Comparison();
        $comparison->item1_id = $this->item1_id;
        $comparison->item2_id = $this->item2_id;
        $comparison->votes_item1 = 0;
        $comparison->votes_item2 = 0;
        $comparison->save();

        $this->clear();
        $this->dispatch('close-modal', 'modalItemsComparison');
        $this->dispatch('Alert', 'Registrado');
    }

    #[On('destroyComparison')]
    public function delete($id) {

        $comparison = Comparison::findOrFail($id);
        $comparison->delete();
    }
}
