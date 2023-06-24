<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
  public $title;
  public $body;

  public function mount()
  {
    $this->title = fake()->sentence();
    $this->body = fake()->text();
  }

  public function render()
  {

    return view('livewire.post.create', [
      'title' => $this->title,
      'body' => $this->body,
    ])->extends('layout.main')->section('content');
  }

  public function createPost()
  {
    $isCreated = Post::create([
      'title' => $this->title,
      'slug' => Str::slug($this->title),
      'body' => $this->body
    ]);

    if ($isCreated) {
      session()->flash('create-success', 'Berhasil membuat data post baru');
      return redirect()->to('/post');
    }

    session()->flash('create-error', 'Gagal membuat data post baru');
    return redirect()->to('/post');
  }
}
