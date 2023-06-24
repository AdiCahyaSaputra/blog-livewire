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

  <div class="flex justify-between items-center">
    <h1 class="text-2xl font-bold">Post Data</h1>
    <a class="hover:text-white/70 rounded-md text-white py-2 px-4 bg-black" href="/post/create">Create New Post</a>
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
        <a class="text-green-600" href="/post/edit/{{ $post->slug }}">Edit</a>
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
  {{ $posts->onEachSide(3)->links() }}

  <script>
    function deletePost(id) {
      Livewire.emit('deletePost', parseInt(id))
    }
  </script>
</main>
