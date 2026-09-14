<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseTransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_purchase_transaction_and_increase_product_stock(): void
    {
        $user = User::factory()->create();
        $supplier = Supplier::create([
            'nama' => 'Supplier A',
            'telepon' => '08123456789',
            'email' => 'supplier@example.com',
            'alamat' => 'Bandung',
        ]);
        $category = Category::create([
            'nama' => 'Kategori A',
            'deskripsi' => 'Kategori untuk test pembelian',
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

        $response = $this->actingAs($user)->post('/purchases', [
            'supplier_id' => $supplier->id,
            'produk_id' => $product->id,
            'jumlah' => 5,
            'harga_beli' => 12000,
            'dibayar' => 60000,
            'catatan' => 'Pembelian awal',
        ]);

        $response->assertRedirect('/purchases/create');
        $this->assertDatabaseHas('pembelians', [
            'supplier_id' => $supplier->id,
            'total' => '60000.00',
            'dibayar' => '60000.00',
        ]);
        $this->assertDatabaseHas('detail_pembelians', [
            'produk_id' => $product->id,
            'jumlah' => 5,
            'harga_beli' => '12000.00',
            'subtotal' => '60000.00',
        ]);
        $this->assertSame(15, $product->fresh()->stok);
    }

    public function test_purchase_transaction_does_not_change_stock_when_validation_fails(): void
    {
        $user = User::factory()->create();
        $supplier = Supplier::create([
            'nama' => 'Supplier B',
            'telepon' => '081122334455',
            'email' => 'supplierb@example.com',
            'alamat' => 'Jakarta',
        ]);
        $category = Category::create([
            'nama' => 'Kategori B',
            'deskripsi' => 'Kategori kedua untuk test pembelian',
        ]);
        $product = Product::create([
            'kategori_id' => $category->id,
            'nama' => 'Produk B',
            'kode_produk' => 'PRD-002',
            'barcode' => '123456789013',
            'harga_beli' => 9000,
            'harga_jual' => 13000,
            'stok' => 8,
            'satuan' => 'pcs',
            'status' => 'aktif',
            'deskripsi' => 'Deskripsi produk',
        ]);

        $response = $this->actingAs($user)->from('/purchases/create')->post('/purchases', [
            'supplier_id' => $supplier->id,
            'produk_id' => $product->id,
            'jumlah' => 0,
            'harga_beli' => 10000,
            'dibayar' => 0,
            'catatan' => 'Invalid request',
        ]);

        $response->assertSessionHasErrors(['jumlah']);
        $this->assertSame(8, $product->fresh()->stok);
        $this->assertDatabaseMissing('pembelians', ['supplier_id' => $supplier->id]);
    }
}
