<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    private $tag;

    protected function setUp(): void
    {
        parent::setUp();

        Tag::factory()->count(5)->create();
        $this->tag = Tag::factory()->create(['name' => 'testing tag']);
    }

    /**
     * @test
     */
    public function it_can_get_list_tags()
    {
        $response = $this->get('/api/tags');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'tags' => [['id', 'name']]
                ]
            )
            ->assertJsonFragment(['name' => 'testing tag']);
    }

    /**
     * @test
     */
    public function it_can_get_on_tag()
    {
        $response = $this->get('/api/tags/' . $this->tag->id);

        $response
            ->assertStatus(200)
            ->assertJson(['tag' => ['id' => $this->tag->id, 'name' => $this->tag->name]]);
    }

    /**
     * @test
     */
    public function it_can_create_a_tag()
    {
        $response = $this->post('/api/tags', ['name' => 'new tag']);

        $response
            ->assertStatus(201)
            ->assertJsonPath('tag.name', 'new tag');
    }

    /**
     * @test
     */
    public function it_can_update_a_tag()
    {
        $response = $this->put('/api/tags/' . $this->tag->id, ['name' => 'updated tag']);

        $response
            ->assertStatus(200)
            ->assertJsonPath('tag.name', 'updated tag');
    }

    /**
     * @test
     */
    public function it_can_delete_a_tag()
    {
        $response = $this->delete('/api/tags/' . $this->tag->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tags', ['id' => $this->tag->id]);
    }
}
