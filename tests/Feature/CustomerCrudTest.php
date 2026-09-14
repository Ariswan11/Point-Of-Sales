<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_customers_page(): void
    {
        $user = User::factory()->create();
        Customer::create([
            'nama' => 'Pelanggan A',
            'telepon' => '08123456789',
            'email' => 'pelanggana@example.com',
            'alamat' => 'Bandung',
        ]);

        $response = $this->actingAs($user)->get('/customers');

        $response->assertOk();
        $response->assertSee('Pelanggan A');
    }

    public function test_user_can_create_customer(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/customers', [
            'nama' => 'Pelanggan B',
            'telepon' => '081122334455',
            'email' => 'pelangganb@example.com',
            'alamat' => 'Jakarta',
        ]);

        $response->assertRedirect('/customers');
        $this->assertDatabaseHas('pelanggans', [
            'nama' => 'Pelanggan B',
            'email' => 'pelangganb@example.com',
        ]);
    }

    public function test_user_can_update_customer(): void
    {
        $user = User::factory()->create();
        $customer = Customer::create([
            'nama' => 'Pelanggan C',
            'telepon' => '0810000000',
            'email' => 'pelangganc@example.com',
            'alamat' => 'Medan',
        ]);

        $response = $this->actingAs($user)->put("/customers/{$customer->id}", [
            'nama' => 'Pelanggan C Update',
            'telepon' => '0811111111',
            'email' => 'pelanggancupdate@example.com',
            'alamat' => 'Surabaya',
        ]);

        $response->assertRedirect('/customers');
        $this->assertDatabaseHas('pelanggans', [
            'id' => $customer->id,
            'nama' => 'Pelanggan C Update',
            'email' => 'pelanggancupdate@example.com',
        ]);
    }

    public function test_user_can_delete_customer(): void
    {
        $user = User::factory()->create();
        $customer = Customer::create([
            'nama' => 'Pelanggan D',
            'telepon' => '0811222333',
            'email' => 'pelanggand@example.com',
            'alamat' => 'Yogyakarta',
        ]);

        $response = $this->actingAs($user)->delete("/customers/{$customer->id}");

        $response->assertRedirect('/customers');
        $this->assertDatabaseMissing('pelanggans', ['id' => $customer->id]);
    }

    public function test_user_can_search_customer(): void
    {
        $user = User::factory()->create();
        Customer::create([
            'nama' => 'Pelanggan Search',
            'telepon' => '0811555666',
            'email' => 'searchcustomer@example.com',
            'alamat' => 'Bekasi',
        ]);

        $response = $this->actingAs($user)->get('/customers?search=Search');

        $response->assertOk();
        $response->assertSee('Pelanggan Search');
    }
}
