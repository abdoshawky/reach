<?php

namespace Tests\Feature;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Tag;
use Tests\TestCase;

class AdTest extends TestCase
{
    private $ad;

    protected function setUp(): void
    {
        parent::setUp();

        Ad::factory()->count(5)->create();
        $this->ad = Ad::factory()->create(['title' => 'test ad']);
    }

    /**
     * @test
     */
    public function it_can_list_all_ads()
    {
        $response = $this->get('/api/ads');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'ads' => [
                        ['id', 'type', 'title', 'description', 'start_date', 'category', 'tags']
                    ]
                ]
            )
            ->assertJsonPath('ads.5.title', $this->ad->title);
    }

    /**
     * @test
     */
    public function it_can_filter_ads_by_category()
    {
        $category = Category::factory()->create();
        Ad::factory()->count(5)->create(['category_id' => $category->id]);

        $response = $this->get('/api/ads?category_id=' . $category->id);

        $response
            ->assertStatus(200)
            ->assertJsonPath('ads.*.category.id', array_fill(0, 5, $category->id));
    }

    /**
     * @test
     */
    public function it_can_filter_ads_by_tags()
    {
        $tag = Tag::factory()->create();
        $ad = Ad::factory()->create();
        $ad->tags()->sync([$tag->id]);

        $response = $this->get('/api/ads?tags[]=' . $tag->id);

        $response
            ->assertStatus(200)
            ->assertJsonPath('ads.*.tags.*.id', [$tag->id]);
    }
}
