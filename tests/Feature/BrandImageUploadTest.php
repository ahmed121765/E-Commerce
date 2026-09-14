<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Brand;
use App\Traits\FileHandler;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BrandImageUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_brand_image_is_saved_when_creating_a_brand(): void
    {
        Storage::fake('brands');

        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($admin, 'admin')->post('/brands', [
            'name' => 'Nike',
            'slug' => 'nike',
            'image' => UploadedFile::fake()->image('brand.jpg', 300, 200),
        ]);

        $response->assertRedirect('/brands');
        $this->assertDatabaseHas('brands', [
            'name' => 'Nike',
            'slug' => 'nike',
        ]);

        $brand = Brand::first();

        $this->assertNotNull($brand->image);
        Storage::disk('brands')->assertExists($brand->image);
    }

    public function test_file_handler_does_not_use_the_client_filename_extension(): void
    {
        Storage::fake('brands');

        $image = UploadedFile::fake()->image('brand.jpg');
        $uploadedFile = new UploadedFile(
            $image->getPathname(),
            'brand.php',
            'image/jpeg',
            UPLOAD_ERR_OK,
            true,
        );

        $request = Request::create('/', 'POST', [], [], [
            'image' => $uploadedFile,
        ]);

        $handler = new class {
            use FileHandler;
        };

        $filename = $handler->uploadFile($request, 'image', null, 'brands');

        $this->assertStringEndsNotWith('.php', $filename);
        Storage::disk('brands')->assertExists($filename);
    }
}
