<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class Edit extends Component
{
  public $title;
  public $body;

  public $post;

  protected $listeners = ['editPost'];

  public function mount($slug)
  {
    $this->post = Post::where('slug', $slug)->first();

    $this->title = $this->post->title;
    $this->body = $this->post->body;
  }

  public function render()
  {
    return view('livewire.post.edit', ['post' => $this->post])->extends('layout.main')->section('content');
  }

  public function editPost($id)
  {
    $editedPost = DB::table('posts')
      ->where('id', $id)->update([
        'title' => $this->title,
        'slug' => Str::slug($this->title),
        'body' => $this->body
      ]);

    if ($editedPost) {
      session()->flash('edit-success', 'Berhasil mengedit data post');
      return redirect()->to('/post');
    }

    session()->flash('edit-error', 'Gagal mengedit data post');
    return redirect()->to('/post');
  }
}
