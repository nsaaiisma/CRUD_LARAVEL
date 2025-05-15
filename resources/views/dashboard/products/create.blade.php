<x-layouts.app :title="__('Create Product')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Add New Product</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Product</flux:heading>
            <flux:separator variant="subtle" />
    </div>

    
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

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <flux:input name="name" label="Product Name" value="{{ old('name') }}" required />
        <flux:input name="sku" label="SKU" value="{{ old('sku') }}" required />
        <flux:input name="price" label="Price" type="number" step="0.01" value="{{ old('price') }}" required />
        <flux:input name="stock" label="Stock" type="number" value="{{ old('stock') }}" required />
        <flux:textarea name="description" label="Description">{{ old('description') }}</flux:textarea>

        {{-- Dropdown kategori --}}
        <div>
            <label for="product_category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select name="product_category_id" id="product_category_id" class="mt-1 block w-full border-gray-300 rounded">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <flux:input name="image_url" label="Image" type="file" />
        <div class="flex items-center space-x-2">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" id="is_active" name="is_active" value="1" class="rounded border-gray-300" checked>
            <label for="is_active">Active</label>
        </div>

        <flux:button type="submit" variant="primary">Save Product</flux:button>
    </form>
</x-layouts.app>
