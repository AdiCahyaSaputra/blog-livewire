<?php

namespace Tests\Feature;

use App\Http\Livewire\Post\Index;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\TestCase;

use function PHPUnit\Framework\assertCount;

class PostTest extends TestCase
{
  /**
   * A basic feature test example.
   */
  public function test_posts_page_return_a_successful_response(): void
  {
    $response = $this->get('/post');

    $response->assertStatus(200);
  }

  public function test_page_return_a_not_found(): void
  {
    $response = $this->get('/post/create');

    $response->assertStatus(404);
  }

  public function test_get_all_posts_data()
  {
    $posts = DB::table('posts')
      ->select()->paginate(5);

    $this->assertNotEmpty($posts);
  }

  public function test_view_has_5_posts_data()
  {
    $posts = DB::table('posts')
      ->select()->paginate(5);

    Livewire::test(Index::class)
      ->assertViewHas('posts', $posts['data']);

    $this->assertCount(5, $posts->items());
  }

  public function test_create_post_data()
  {
    Livewire::test(Index::class)
      ->set('title', fake()->sentence())
      ->set('body', fake()->realText())
      ->call('createPost')
      ->assertSee('Berhasil membuat data post baru');
  }
}
