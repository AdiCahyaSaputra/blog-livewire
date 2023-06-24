<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class Index extends Component
{
  use WithPagination;

  protected $listeners = ['deletePost'];

  public function deletePost($id)
  {
    $deletedPost = DB::table('posts')
      ->delete($id);

    if ($deletedPost) {
      session()->flash('delete-success', 'Berhasil menghapus data post');
      return;
    }

    session()->flash('delete-error', 'Berhasil menghapus data post');
    return;
  }

  public function render()
  {
    $posts = DB::table('posts')
      ->select()->paginate(5);

    foreach ($posts as $post) {
      $post->body = Str::words($post->body, 5, '...');
    }

    return view('livewire.post.index', ['posts' => $posts])
      ->extends('layout.main')
      ->section('content');
  }
}
