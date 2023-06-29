<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Models\Post;

class Index extends Component
{
  use WithPagination;

  protected $listeners = ['createPost', 'editPost', 'deletePost', 'openPrompt'];

  public $isPromptOpen = false;

  public $promptTitle;
  public $promptSubmitText;

  public $idPost;
  public $title;
  public $body;

  public function createPost()
  {
    $isCreated = Post::create([
      'title' => $this->title,
      'slug' => Str::slug($this->title),
      'body' => $this->body
    ]);

    if ($isCreated) {
      $this->closePrompt();
      return session()->flash('create-success', 'Berhasil membuat data post baru');
    }

    $this->closePrompt();
    return session()->flash('create-error', 'Gagal membuat data post baru');
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
      $this->closePrompt();
      return session()->flash('edit-success', 'Berhasil mengedit data post');
    }

    $this->closePrompt();
    return session()->flash('edit-error', 'Gagal mengedit data post');
  }

  public function deletePost($id)
  {
    $deletedPost = DB::table('posts')
      ->delete($id);

    if ($deletedPost) {
      session()->flash('delete-success', 'Berhasil menghapus data post');
      return;
    }

    session()->flash('delete-error', 'Gagal menghapus data post');
    return;
  }

  public function openPrompt($data)
  {
    $this->promptTitle = $data['title'];
    $this->promptSubmitText = $data['submitText'];

    $post = Post::find($data['id']);

    $this->idPost = $post->id ?? '';
    $this->title = $post->title ?? fake()->sentence();
    $this->body = $post->body ?? fake()->realText();

    $this->isPromptOpen = true;
  }

  public function closePrompt()
  {
    $this->promptTitle = '';
    $this->promptSubmitText = '';

    $this->idPost = '';
    $this->title = '';
    $this->body = '';

    $this->isPromptOpen = false;
  }

  public function render()
  {
    $posts = DB::table('posts')
      ->select()->paginate(5);

    foreach ($posts as $post) {
      $post->body = Str::words($post->body, 5, '...');
    }

    return view('livewire.post.index', [
      'posts' => $posts,
      'prompt' => [
        'title' => $this->promptTitle,
        'submitText' => $this->promptSubmitText,
        'post' => [
          'idPost' => $this->idPost,
          'title' => $this->title,
          'body' => $this->body,
        ],
      ]
    ])
      ->extends('layout.main')
      ->section('content');
  }
}
