<x-layouts.app :title="__('Edit Product')">
    <flux:heading>Edit Product</flux:heading>
    <flux:subheading>Form untuk mengupdate data produk.</flux:subheading>
    <flux:separator variant="subtle" />

    @if (session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 
w-full">{{ session()->get('successMessage') }}</flux:badge>
    @elseif(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 
w-full">{{ session()->get('errorMessage') }}</flux:badge>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <strong>There were some errors with your input:</strong>
            <ul class="list-disc ml-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @method('patch')
        @csrf

        <flux:input name="name" label="Name" value="{{ old('name', $product->name) }}" placeholder="Product Name"
            required />

        <flux:input name="sku" label="sku" value="{{ old('sku', $product->slug) }}"
            placeholder="product-name-slug" required />

        <flux:textarea name="description" label="Description" placeholder="Product Description" required>
            {!! old('description', $product->description) !!}
        </flux:textarea>

        <flux:input type="number" step="0.01" name="price" label="Price"
            value="{{ old('price', $product->price) }}" placeholder="e.g. 100000" required />

        <flux:input type="number" name="stock" label="Stock" value="{{ old('stock', $product->stock) }}"
            placeholder="e.g. 20" required />

        @if ($product->image_url)
            <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}"
                class="h-10 w-10 object-cover rounded">
        @else
            <div class="h-10 w-10 bg-gray-200 flex items-center justify-center rounded">
                <span class="text-gray-500 text-sm">N/A</span>
            </div>
        @endif

        <flux:input type="file" name="image" label="Image" placeholder="Upload New Image" />

        <div class="mt-4">
            <flux:button type="submit" icon="plus" variant="primary">Simpan</flux:button>
            <flux:link href="{{ route('products.index') }}" variant="ghost" class="ml-3">Kembali</flux:link>
        </div>
    </form>
</x-layouts.app>
