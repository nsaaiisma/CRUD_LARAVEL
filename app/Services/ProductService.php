<?

// app/Services/ProductService.php
namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function getAll()
    {
        return Product::with('products')->latest()->get();
    }

    public function getById($id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['slug']);
        if (isset($data['image_file'])) {
            $data['image_url'] = $this->uploadImage($data['image_file']);
        }
        return Product::create($data);
    }

    public function update(Product $product, array $data)
    {
        $data['slug'] = Str::slug($data['slug']);
        if (isset($data['image_file'])) {
            if ($product->image_url) {
                Storage::delete($product->image_url);
            }
            $data['image_url'] = $this->uploadImage($data['image_file']);
        }
        return $product->update($data);
    }

    public function delete(Product $product)
    {
        if ($product->image_url) {
            Storage::delete($product->image_url);
        }
        return $product->delete();
    }

    private function uploadImage($file)
    {
        return $file->store('products', 'public');
    }
}
