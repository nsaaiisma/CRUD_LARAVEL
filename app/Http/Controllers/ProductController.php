<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

{

class ProductController extends Controller
{

    public function index(Request $request )
    {
        $product = Product::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('description', 'like', '%' . $request->q .
                        '%');
            })
            ->paginate(10);

        return view('dashboard.products.index', [
            'products' => $product,
            'q' => $request->q
        ]);
    }

    public function create()
    {
        $categories = \App\Models\ProductCategory::all();
        return view('dashboard.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'sku' => 'required|string|max:50|unique:products,sku',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'product_category_id' => 'nullable|exists:product_categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // nama input harus 'image'
        'is_active' => 'nullable',
    ]);

    $product = new Product();
    $product->name = $validated['name'];
    $product->slug = Str::slug($validated['name']); // membuat slug
    $product->description = $validated['description'] ?? null;
    $product->sku = $validated['sku'];
    $product->price = $validated['price'];
    $product->stock = $validated['stock'];
    $product->product_category_id = $validated['product_category_id'] ?? null;
    $product->is_active = $request->has('is_active'); // default true jika diklik

    // Upload gambar jika ada
    if ($request->hasFile('image_url')) {
        $image = $request->file('image_url');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = $image->storeAs('uploads/products', $imageName, 'public');
        $product->image_url = $imagePath;
    }

    $product->save();

    return redirect()->route('products.index')->with('successMessage', 'Product created successfully!');
    }


    public function edit(String $id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.products.edit', ['product'=>$product]);
    }

    public function update(Request $request, String $id)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'sku' => 'required|string|max:50|unique:products,sku,' . $id,
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'product_category_id' => 'nullable|exists:product_categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'is_active' => 'nullable|boolean',
    ]);

    $product = Product::findOrFail($id);
    $product->name = $validated['name'];
    $product->slug = \Illuminate\Support\Str::slug($validated['name']);
    $product->description = $validated['description'] ?? null;
    $product->sku = $validated['sku'];
    $product->price = $validated['price'];
    $product->stock = $validated['stock'];
    $product->product_category_id = $validated['product_category_id'] ?? null;
    $product->is_active = $request->has('is_active');

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
            Storage::disk('public')->delete($product->image_url);
        }

        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = $image->storeAs('uploads/products', $imageName, 'public');
        $product->image_url = $imagePath;
    }

    $product->save();

    return redirect()->route('products.index')->with('success', 'Product updated.');
}

    public function destroy(String $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index')
                ->with('error', 'Data tidak ditemukan');
        }

        // Hapus file gambar jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Data berhasil dihapus');
    }
}

}