<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private $category;

    protected function setUp(): void
    {
        parent::setUp();

        Category::factory()->count(5)->create();
        $this->category = Category::factory()->create(['name' => 'testing category']);
    }

    /**
     * @test
     */
    public function it_can_get_list_categories()
    {
        $response = $this->get('/api/categories');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'categories' => [['id', 'name']]
                ]
            )
            ->assertJsonFragment(['name' => 'testing category']);
    }

    /**
     * @test
     */
    public function it_can_get_on_category()
    {
        $response = $this->get('/api/categories/' . $this->category->id);

        $response
            ->assertStatus(200)
            ->assertJson(['category' => ['id' => $this->category->id, 'name' => $this->category->name]]);
    }

    /**
     * @test
     */
    public function it_can_create_a_category()
    {
        $response = $this->post('/api/categories', ['name' => 'new category']);

        $response
            ->assertStatus(201)
            ->assertJsonPath('category.name', 'new category');
    }

    /**
     * @test
     */
    public function it_can_update_a_category()
    {
        $response = $this->put('/api/categories/' . $this->category->id, ['name' => 'updated category']);

        $response
            ->assertStatus(200)
            ->assertJsonPath('category.name', 'updated category');
    }

    /**
     * @test
     */
    public function it_can_delete_a_category()
    {
        $response = $this->delete('/api/categories/' . $this->category->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('categories', ['id' => $this->category->id]);
    }
}
