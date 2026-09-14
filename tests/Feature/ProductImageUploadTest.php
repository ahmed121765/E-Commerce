<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductImageUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_gallery_images_are_saved_when_creating_a_product(): void
    {
        Storage::fake('Products');

        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $brand = Brand::create([
            'name' => 'Nike',
            'slug' => 'nike',
        ]);

        $category = new Categorie;
        $category->name = 'Shoes';
        $category->slug = 'shoes';
        $category->save();

        $response = $this->actingAs($admin, 'admin')->post('/Products', [
            'name' => 'Running Shoes',
            'slug' => 'running-shoes',
            'description' => 'A comfortable pair of running shoes.',
            'why_choose_product' => "Soft fabric\nComfortable fit",
            'sample_number_list' => "Machine washable\nLightweight",
            'lining' => '100% Cotton lining.',
            'regular_price' => 100,
            'SKU' => 'RUN-001',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'featured' => false,
            'stock_status' => 'instock',
            'quantity' => 10,
            'image' => UploadedFile::fake()->image('main.jpg'),
            'images' => [
                UploadedFile::fake()->image('gallery-one.jpg'),
                UploadedFile::fake()->image('gallery-two.jpg'),
            ],
        ]);

        $response->assertRedirect('/Products');

        $product = Product::firstOrFail();

        $this->assertCount(2, $product->images);
        foreach ($product->images as $image) {
            Storage::disk('Products')->assertExists($image);
        }

        $this->assertSame("Soft fabric\nComfortable fit", $product->why_choose_product);
        $this->assertSame("Machine washable\nLightweight", $product->sample_number_list);
        $this->assertSame('100% Cotton lining.', $product->lining);
    }
}
