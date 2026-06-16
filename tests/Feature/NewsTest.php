<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_future_news_is_hidden_from_public_pages(): void
    {
        $future = News::query()->create([
            'title' => 'Будущая новость',
            'slug' => 'future-news',
            'excerpt' => 'Скрытая новость',
            'content' => 'Контент будущей новости',
            'image' => 'https://example.com/image.jpg',
            'published_at' => now()->addDay(),
        ]);

        $published = News::query()->create([
            'title' => 'Опубликованная новость',
            'slug' => 'published-news',
            'excerpt' => 'Видимая новость',
            'content' => 'Контент опубликованной новости',
            'image' => 'https://example.com/image.jpg',
            'published_at' => now()->subDay(),
        ]);

        $this->get(route('news.index'))
            ->assertOk()
            ->assertSee($published->title)
            ->assertDontSee($future->title);

        $this->get(route('news.show', $published->slug))->assertOk();
        $this->get(route('news.show', $future->slug))->assertNotFound();
    }
}
