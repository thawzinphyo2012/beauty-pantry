<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_shop_and_product_pages_render(): void
    {
        $product = $this->product();

        $this->get('/')->assertOk()->assertSee('quiet');
        $this->get('/shop')->assertOk()->assertSee($product->name);
        $this->get(route('product.show', $product))->assertOk()->assertSee('Add to bag');
    }

    public function test_guest_can_checkout_and_stock_decrements(): void
    {
        $product = $this->product(['stock' => 5, 'price' => 20000]);

        $this->post(route('cart.store'), [
            'product_id' => $product->id,
            'quantity' => 2,
        ])->assertRedirect();

        $this->post(route('checkout.store'), [
            'customer_name' => 'Aye Aye',
            'email' => 'aye@example.com',
            'phone' => '091234567',
            'city' => 'Yangon',
            'address' => 'Bahan',
        ])->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'email' => 'aye@example.com',
            'subtotal' => 40000,
            'shipping' => 5000,
            'total' => 45000,
        ]);

        $this->assertSame(3, $product->fresh()->stock);
    }

    public function test_customers_cannot_open_the_admin_desk(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $this->actingAs($user)->get('/admin')->assertForbidden();
    }

    public function test_admin_can_open_the_desk(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get('/admin')->assertOk()->assertSee('Atelier overview');
    }

    private function product(array $overrides = []): Product
    {
        $category = Category::create([
            'name' => 'Skincare',
            'slug' => 'skincare',
            'sort' => 1,
        ]);

        return Product::create(array_merge([
            'category_id' => $category->id,
            'name' => 'Dew Veil Serum',
            'slug' => 'dew-veil-serum',
            'subtitle' => 'A veil',
            'description' => 'Light serum.',
            'price' => 68000,
            'stock' => 10,
            'is_featured' => true,
            'is_bestseller' => true,
        ], $overrides));
    }
}
