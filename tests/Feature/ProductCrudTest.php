<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_products_page(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['nama' => 'Makanan']);
        Product::create([
            'kategori_id' => $category->id,
            'nama' => 'Nasi Goreng',
            'kode_produk' => 'P001',
            'harga_beli' => 12000,
            'harga_jual' => 15000,
            'stok' => 10,
            'satuan' => 'porsi',
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($user)->get('/products');

        $response->assertOk();
        $response->assertSee('Nasi Goreng');
    }

    public function test_user_can_create_product(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['nama' => 'Minuman']);

        $response = $this->actingAs($user)->post('/products', [
            'kategori_id' => $category->id,
            'nama' => 'Es Teh',
            'kode_produk' => 'P002',
            'harga_beli' => 2500,
            'harga_jual' => 5000,
            'stok' => 20,
            'satuan' => 'botol',
            'status' => 'aktif',
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('produks', [
            'kode_produk' => 'P002',
            'nama' => 'Es Teh',
            'kategori_id' => $category->id,
        ]);
    }

    public function test_user_can_update_product(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['nama' => 'Makanan']);
        $product = Product::create([
            'kategori_id' => $category->id,
            'nama' => 'Nasi Goreng',
            'kode_produk' => 'P003',
            'harga_beli' => 12000,
            'harga_jual' => 15000,
            'stok' => 10,
            'satuan' => 'porsi',
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($user)->put("/products/{$product->id}", [
            'kategori_id' => $category->id,
            'nama' => 'Nasi Goreng Spesial',
            'kode_produk' => 'P003',
            'harga_beli' => 13000,
            'harga_jual' => 17000,
            'stok' => 12,
            'satuan' => 'porsi',
            'status' => 'aktif',
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('produks', [
            'id' => $product->id,
            'nama' => 'Nasi Goreng Spesial',
            'harga_jual' => '17000.00',
        ]);
    }

    public function test_user_can_delete_product(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['nama' => 'Makanan']);
        $product = Product::create([
            'kategori_id' => $category->id,
            'nama' => 'Bakso',
            'kode_produk' => 'P004',
            'harga_beli' => 10000,
            'harga_jual' => 15000,
            'stok' => 8,
            'satuan' => 'porsi',
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($user)->delete("/products/{$product->id}");

        $response->assertRedirect('/products');
        $this->assertDatabaseMissing('produks', ['id' => $product->id]);
    }
}
