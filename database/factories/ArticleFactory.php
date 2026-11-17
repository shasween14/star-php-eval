<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = rtrim(fake()->sentence(8), '.');
        $isPublished = fake()->boolean(85);

        return [
            'category_id' => Category::factory(),
            'title' => $title,
            'summary' => fake()->text(200),
            'body' => implode("\n\n", fake()->paragraphs(5)),
            'author' => fake()->name(),
            'status' => $isPublished ? 1 : 0,
            'permalink' => Str::slug($title).'-'.fake()->unique()->numberBetween(1000, 99999),
            'published_at' => $isPublished ? fake()->dateTimeBetween('-3 months', 'now') : null,
        ];
    }

    /**
     * Indicate that the article is published.
     */
    public function published(): static
    {
        return $this->state(fn () => [
            'status' => 1,
            'published_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ]);
    }

    /**
     * Indicate that the article is a draft.
     */
    public function draft(): static
    {
        return $this->state(fn () => [
            'status' => 0,
            'published_at' => null,
        ]);
    }
}
