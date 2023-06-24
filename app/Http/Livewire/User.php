<?php

namespace App\Http\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;

class User extends Component
{
  public $name;
  protected $listeners = ['editUser'];

  public function editUser($id)
  {
    ModelsUser::find($id)->update([
      'name' => $this->name
    ]);

    session()->flash('edit-success', 'Berhasil mengedit data user');
  }

  public function render()
  {
    return view('livewire.user', [
      'user' => ModelsUser::find(1)
    ]);
  }
}
