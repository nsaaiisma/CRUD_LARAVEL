<x-layouts.app :title="__('Hapus Produk')">
    <div class="max-w-md mx-auto mt-20 p-6 bg-white rounded shadow">
        <flux:heading class="text-red-600">Konfirmasi Hapus</flux:heading>
        <flux:subheading>
            Apakah kamu yakin ingin menghapus produk <strong>{{ $product->name }}</strong>?<br>
            Tindakan ini tidak bisa dibatalkan.
        </flux:subheading>
        <flux:separator variant="subtle" class="my-4" />

        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-between mt-6">
                <a href="{{ route('products.index') }}">
                    <flux:button variant="secondary">Batal</flux:button>
                </a>

                <flux:button type="submit" variant="danger">
                    Hapus
                </flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>
