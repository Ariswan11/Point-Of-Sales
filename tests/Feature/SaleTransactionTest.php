<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleTransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_sale_transaction_and_reduce_product_stock(): void
    {
        $user = User::factory()->create();
        $customer = Customer::create([
            'nama' => 'Customer A',
            'telepon' => '08123456789',
            'email' => 'customer@example.com',
            'alamat' => 'Bandung',
        ]);
        $category = Category::create([
            'nama' => 'Kategori A',
            'deskripsi' => 'Kategori untuk test penjualan',
        ]);
        $product = Product::create([
            'kategori_id' => $category->id,
            'nama' => 'Produk A',
            'kode_produk' => 'PRD-001',
            'barcode' => '123456789012',
            'harga_beli' => 10000,
            'harga_jual' => 15000,
            'stok' => 10,
            'satuan' => 'pcs',
            'status' => 'aktif',
            'deskripsi' => 'Deskripsi produk',
        ]);

        $response = $this->actingAs($user)->post('/sales', [
            'pelanggan_id' => $customer->id,
            'items' => json_encode([
                [
                    'produk_id' => $product->id,
                    'jumlah' => 3,
                ],
            ]),
            'dibayar' => 50000,
            'catatan' => 'Penjualan test',
        ]);

        $response->assertRedirect('/sales/create');
        $this->assertDatabaseHas('penjualans', [
            'pelanggan_id' => $customer->id,
            'user_id' => $user->id,
            'total' => '45000.00',
            'dibayar' => '50000.00',
            'kembalian' => '5000.00',
        ]);
        $this->assertDatabaseHas('detail_penjualans', [
            'produk_id' => $product->id,
            'jumlah' => 3,
            'harga_jual' => '15000.00',
            'subtotal' => '45000.00',
        ]);
        $this->assertSame(7, $product->fresh()->stok);
    }

    public function test_sale_transaction_does_not_change_stock_when_stock_is_insufficient(): void
    {
        $user = User::factory()->create();
        $customer = Customer::create([
            'nama' => 'Customer B',
            'telepon' => '081122334455',
            'email' => 'customerb@example.com',
            'alamat' => 'Jakarta',
        ]);
        $category = Category::create([
            'nama' => 'Kategori B',
            'deskripsi' => 'Kategori kedua untuk test penjualan',
        ]);
        $product = Product::create([
            'kategori_id' => $category->id,
            'nama' => 'Produk B',
            'kode_produk' => 'PRD-002',
            'barcode' => '123456789013',
            'harga_beli' => 9000,
            'harga_jual' => 13000,
            'stok' => 2,
            'satuan' => 'pcs',
            'status' => 'aktif',
            'deskripsi' => 'Deskripsi produk',
        ]);

        $response = $this->actingAs($user)->from('/sales/create')->post('/sales', [
            'pelanggan_id' => $customer->id,
            'items' => json_encode([
                [
                    'produk_id' => $product->id,
                    'jumlah' => 5,
                ],
            ]),
            'dibayar' => 100000,
            'catatan' => 'Invalid stock',
        ]);

        $response->assertSessionHasErrors(['items']);
        $this->assertSame(2, $product->fresh()->stok);
        $this->assertDatabaseMissing('penjualans', ['pelanggan_id' => $customer->id]);
    }
}
