<?php

namespace App\Livewire\Tables;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'name';

    public $sortAsc = true;

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc') // Default sorting
            ->paginate($this->perPage);
        return view('livewire.tables.user-table', [
            'users' => $users
        ]);
    }
}
