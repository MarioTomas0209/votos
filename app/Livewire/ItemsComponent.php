<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ItemsComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = "bootstrap";
    public $cant = 10;
    public $name;
    public $type;
    public $image_url;
    public $Id = 0;

    public function render()
    {
        $items = Item::orderBy('id', 'desc')->paginate($this->cant);

        return view('livewire.items-component', compact('items'));
    }

    public function clear()
    {
        $this->reset([
            'name',
            'type',
            'image_url',
        ]);
        $this->resetErrorBag();
    }

    public function message()
    {
        return [
            'image_url.required' => 'La imagen es obligatoria',
            'image_url.max' => 'La imagen no debe ser mayor que 10 mb.'
        ];
    }

    public function store()
    {
        $rules = [
            'name' => 'required:unique:items',
            'type' => 'required',
            'image_url' => 'required|image|max:10048',
        ];

        $this->validate($rules, $this->message());

        $imagePath = $this->image_url->store('items', 'public');

        $item = new Item();
        $item->name = $this->name;
        $item->type = $this->type;
        $item->image_url = $imagePath;
        $item->save();

        $this->clear();
        $this->dispatch('close-modal', 'modalItems');
        $this->dispatch('alert', 'Items registrado');
    }
}
