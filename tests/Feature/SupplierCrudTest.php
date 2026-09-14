<?php

namespace Tests\Feature;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_suppliers_page(): void
    {
        $user = User::factory()->create();
        Supplier::create([
            'nama' => 'Supplier A',
            'telepon' => '08123456789',
            'email' => 'suppliera@example.com',
            'alamat' => 'Bandung',
        ]);

        $response = $this->actingAs($user)->get('/suppliers');

        $response->assertOk();
        $response->assertSee('Supplier A');
    }

    public function test_user_can_create_supplier(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/suppliers', [
            'nama' => 'Supplier B',
            'telepon' => '081122334455',
            'email' => 'supplierb@example.com',
            'alamat' => 'Jakarta',
        ]);

        $response->assertRedirect('/suppliers');
        $this->assertDatabaseHas('suppliers', [
            'nama' => 'Supplier B',
            'email' => 'supplierb@example.com',
        ]);
    }

    public function test_user_can_update_supplier(): void
    {
        $user = User::factory()->create();
        $supplier = Supplier::create([
            'nama' => 'Supplier C',
            'telepon' => '0810000000',
            'email' => 'supplierc@example.com',
            'alamat' => 'Medan',
        ]);

        $response = $this->actingAs($user)->put("/suppliers/{$supplier->id}", [
            'nama' => 'Supplier C Update',
            'telepon' => '0811111111',
            'email' => 'suppliercupdate@example.com',
            'alamat' => 'Surabaya',
        ]);

        $response->assertRedirect('/suppliers');
        $this->assertDatabaseHas('suppliers', [
            'id' => $supplier->id,
            'nama' => 'Supplier C Update',
            'email' => 'suppliercupdate@example.com',
        ]);
    }

    public function test_user_can_delete_supplier(): void
    {
        $user = User::factory()->create();
        $supplier = Supplier::create([
            'nama' => 'Supplier D',
            'telepon' => '0811222333',
            'email' => 'supplierd@example.com',
            'alamat' => 'Yogyakarta',
        ]);

        $response = $this->actingAs($user)->delete("/suppliers/{$supplier->id}");

        $response->assertRedirect('/suppliers');
        $this->assertDatabaseMissing('suppliers', ['id' => $supplier->id]);
    }

    public function test_user_can_search_supplier(): void
    {
        $user = User::factory()->create();
        Supplier::create([
            'nama' => 'Supplier Search',
            'telepon' => '0811555666',
            'email' => 'searchsupplier@example.com',
            'alamat' => 'Bekasi',
        ]);

        $response = $this->actingAs($user)->get('/suppliers?search=Search');

        $response->assertOk();
        $response->assertSee('Supplier Search');
    }
}
