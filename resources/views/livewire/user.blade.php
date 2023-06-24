<div>

  @if(session()->has('edit-success'))
  <p>{{ session('edit-success') }}</p>
  @endif

  <h1>{{ $user->name }}</h1>

  <input wire:model="name" />
  <button onclick="editUser('{{ $user->id }}')">Edit User</button>

  <script>
    function editUser(id) {
      Livewire.emit('editUser', parseInt(id));
    }
  </script>
</div>
