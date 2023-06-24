<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    // Locale ID gk ada buat sentence, paragraph, text :(
    $title = fake('id_ID')->sentence();
    $slug = Str::slug($title);

    return [
      'title' => $title,
      'slug' => $slug,
      'body' => fake('id_ID')->realText()
    ];
  }
}
