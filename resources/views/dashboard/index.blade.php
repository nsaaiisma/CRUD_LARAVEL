<x-layouts.app :title="__('Dashboard')">

    <flux:heading size="xl">Dashboard</flux:heading>
    <flux:subheading size="lg" class="mb-6">List Produk yang Tersedia</flux:subheading>
    <flux:separator variant="subtle" class="mb-4" />

    @if ($products->count())
        <ul>
            @foreach ($products as $product)
                <li>
                    <strong>{{ $product->name }}</strong> -
                    {{ $product->category->name ?? 'Tidak ada kategori' }} -
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </li>
            @endforeach
        </ul>
    @else
        <p>Tidak ada produk.</p>
    @endif
    
    @if ($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white shadow rounded p-4">
                    @if ($product->image_url)
                        <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}"
                             class="w-full h-40 object-cover rounded mb-4">
                    @else
                        <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded mb-4">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif

                    <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                    <p class="text-sm text-gray-500 mb-2">
                        {{ $product->category->name ?? 'No Category' }}
                    </p>
                    <p class="text-md font-bold text-gray-800 mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-600">Stock: {{ $product->stock }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">Belum ada produk.</p>
    @endif

</x-layouts.app>
