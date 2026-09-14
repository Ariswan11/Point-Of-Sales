<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_categories_page(): void
    {
        $user = User::factory()->create();
        Category::factory()->create(['nama' => 'Minuman']);

        $response = $this->actingAs($user)->get('/categories');

        $response->assertOk();
        $response->assertSee('Minuman');
    }

    public function test_user_can_create_category(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/categories', [
            'nama' => 'Makanan',
            'deskripsi' => 'Kategori untuk makanan',
        ]);

        $response->assertRedirect('/categories');
        $this->assertDatabaseHas('kategoris', [
            'nama' => 'Makanan',
            'deskripsi' => 'Kategori untuk makanan',
        ]);
    }

    public function test_user_can_update_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['nama' => 'Minuman']);

        $response = $this->actingAs($user)->put("/categories/{$category->id}", [
            'nama' => 'Minuman Baru',
            'deskripsi' => 'Deskripsi baru',
        ]);

        $response->assertRedirect('/categories');
        $this->assertDatabaseHas('kategoris', [
            'id' => $category->id,
            'nama' => 'Minuman Baru',
            'deskripsi' => 'Deskripsi baru',
        ]);
    }

    public function test_user_can_delete_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['nama' => 'Produk Baru']);

        $response = $this->actingAs($user)->delete("/categories/{$category->id}");

        $response->assertRedirect('/categories');
        $this->assertDatabaseMissing('kategoris', ['id' => $category->id]);
    }

    public function test_category_name_must_be_unique(): void
    {
        $user = User::factory()->create();
        Category::factory()->create(['nama' => 'Minuman']);

        $response = $this->actingAs($user)->from('/categories/create')->post('/categories', [
            'nama' => 'Minuman',
            'deskripsi' => 'Duplikat',
        ]);

        $response->assertSessionHasErrors('nama');
    }
}
