<main class="py-2 px-8">

  @if(session()->has('create-success'))
  <p class="py-2 px-4 text-white bg-green-600 rounded-md mb-2">{{ session('create-success') }}</p>
  @endif

  @if(session()->has('create-error'))
  <p class="py-2 px-4 text-white bg-red-600 rounded-md mb-2">{{ session('create-error') }}</p>
  @endif

  @if(session()->has('delete-success'))
  <p class="py-2 px-4 text-white bg-green-600 rounded-md mb-2">{{ session('delete-success') }}</p>
  @endif

  @if(session()->has('delete-error'))
  <p class="py-2 px-4 text-white bg-red-600 rounded-md mb-2">{{ session('delete-error') }}</p>
  @endif

  @if(session()->has('edit-success'))
  <p class="py-2 px-4 text-white bg-green-600 rounded-md mb-2">{{ session('edit-success') }}</p>
  @endif

  @if(session()->has('edit-error'))
  <p class="py-2 px-4 text-white bg-red-600 rounded-md mb-2">{{ session('edit-error') }}</p>
  @endif

  @if($isPromptOpen)
  <div class="absolute inset-0 bg-black/80 z-10 flex items-center justify-center">
    <div class="p-4 rounded-md bg-white">
      <h1 class="text-2xl font-bold">{{ $prompt['title'] }}</h1>

      <hr class="mt-4 mb-2" />

      <div class="space-y-2">
        <p class="text-lg font-bold">Post Title</p>
        <input wire:model='title' type="text" class="p-1 outline-none border-2 focus:border-black" />
      </div>
      <div class="mt-2 space-y-2">
        <p class="text-lg font-bold">Post Body</p>
        <textarea wire:model='body' rows="4" class="p-1 outline-none border-2 focus:border-black"></textarea>
      </div>

      <button type="button" class="py-2 px-4 bg-black text-white/70 hover:text-white rounded-md mt-2" onclick="clickHandler(`{{ $prompt['title'] }}`,`{{ $prompt['post']['idPost'] }}`)">{{ $prompt['submitText'] }}</button>
      <button type="button" class="py-2 px-4 bg-red-600 text-white/70 hover:text-white rounded-md mt-2" wire:click="closePrompt">Cancel</button>

    </div>
  </div>
  @endif

  <div class="flex justify-between items-center">
    <h1 class="text-2xl font-bold">Post Data</h1>
    <button class="hover:text-white/70 rounded-md text-white py-2 px-4 bg-black" onclick="openPrompt({
      title: 'Create Post',
      submitText: 'Create',
      id: null
    })">Create New Post</button>
  </div>

  <hr class="mt-4 mb-2" />

  <ul class="space-y-4">

    @if(count($posts))
    @foreach($posts as $post)
    <li class="flex justify-between items-start">
      <div>
        <a class="font-bold" href="/post/{{ $post->slug }}">{{ $post->title }}</a>
        <p class="text-black/70">{{ $post->body }}</p>
      </div>
      <div class="space-x-2">
        <button class="text-green-600" onclick="openPrompt({
          title: 'Edit Post',
          submitText: 'Edit',
          id: `{{ $post->id }}`
        })">Edit</button>
        <button onclick="deletePost('{{ $post->id }}')" class="text-red-600">Delete</button>
      </div>
    </li>
    @endforeach
    @else
    <li>
      <p class="text-black/70">No Post</p>
    </li>
    @endif

  </ul>

  <hr class="mt-4 mb-2" />
  {{ $posts->onEachSide(3)->links('vendor.livewire.tailwind') }}

  <script>
    function clickHandler(type, id) {
      if(type === 'Create Post') Livewire.emit('createPost')
      if(type === 'Edit Post') Livewire.emit('editPost', parseInt(id))
    }

    function deletePost(id) {
      Livewire.emit('deletePost', parseInt(id))
    }

    function openPrompt(data) {
      Livewire.emit('openPrompt', data)
    }
  </script>
</main>
