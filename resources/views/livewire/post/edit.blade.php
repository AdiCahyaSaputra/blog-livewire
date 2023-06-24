<main class="py-2 px-8">

  <h1 class="text-2xl font-bold">Edit Post Data</h1>
  <hr class="mt-4 mb-2" />


  <div class="space-y-2">
    <p class="text-lg font-bold">Post Title</p>
    <input wire:model='title' type="text" class="p-1 outline-none border-2 focus:border-black" />
  </div>
  <div class="mt-2 space-y-2">
    <p class="text-lg font-bold">Post Body</p>
    <textarea wire:model='body' rows="4" class="p-1 outline-none border-2 focus:border-black"></textarea>
  </div>

  <button class="py-2 px-4 bg-black text-white/70 hover:text-white rounded-md mt-2" onclick="editPost('{{ $post->id }}')">Edit</button>

  <script>
    function editPost(id) {
      Livewire.emit('editPost', parseInt(id))
    }
  </script>

</main>
