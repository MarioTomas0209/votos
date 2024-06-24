<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class ItemsComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = "bootstrap";
    public $cant = 10;
    public $name;
    public $type;
    public $image_url;
    public $current_image_url;
    public $Id = 0;

    public function render()
    {
        $items = Item::orderBy('id', 'desc')->paginate($this->cant);

        return view('livewire.items-component', compact('items'));
    }

    public function clear()
    {
        $this->reset([
            'Id',
            'name',
            'type',
            'image_url',
            'current_image_url',
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
            'name' => 'required|unique:items',
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

    public function edit(Item $item)
    {
        $this->Id = $item->id;
        $this->name = $item->name;
        $this->type = $item->type;
        $this->current_image_url = $item->image_url;

        $this->resetErrorBag();
        $this->dispatch('open-modal', 'modalItems');
    }

    public function update()
    {

        $rules = [
            'name' => 'required|unique:items,name,' . $this->Id,
            'type' => 'required',
            'image_url' => 'nullable|image|max:10048',
        ];

        $this->validate($rules, $this->message());

        $item = Item::find($this->Id);

        if ($this->image_url) {
            if ($item->image_url) {
                Storage::disk('public')->delete($item->image_url);
            }

            $imagePath = $this->image_url->store('items', 'public');
            $item->image_url = $imagePath;
        }

        $item->name = $this->name;
        $item->type = $this->type;
        $item->save();

        $this->clear();
        $this->dispatch('close-modal', 'modalItems');
        $this->dispatch('alert', 'Item actualizado');
    }

    #[On('destroyItem')] public function destroy($id)
    {
        try {
            $item = Item::findOrFail($id);

            if ($item->comparisons()->exists()) {
                $this->dispatch('alert', 'No se puede eliminar el item debido a restricciones de integridad.');
                return;
            }

            if ($item->image_url) {
                Storage::disk('public')->delete($item->image_url);
            }

            $item->delete();

            $this->dispatch('alert', 'Item eliminado correctamente.');
        } catch (QueryException $e) {
            $this->dispatch('alert', 'No se puede eliminar el item debido a restricciones de integridad.');
        }
    }
}
