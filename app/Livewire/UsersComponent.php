<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class UsersComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $users = User::where('is_admin', 0)->paginate(10);

        return view('livewire.users-component', compact('users'));
    }

    #[On('destroyUser')]
    public function delete($id) {
        $user = User::findOrFail($id);
        $user->delete();

        $this->dispatch('alert', 'Usuario eliminado');
    }
}
