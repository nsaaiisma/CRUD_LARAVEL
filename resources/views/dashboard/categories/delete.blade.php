@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-20 p-6 bg-white rounded shadow">
        <h2 class="text-xl font-semibold text-red-600 mb-4">Konfirmasi Hapus</h2>

        <p class="mb-6 text-gray-700">
            Apakah kamu yakin ingin menghapus kategori <strong>{{ $category->name }}</strong>?
            Tindakan ini tidak bisa dibatalkan.
        </p>

        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-between">
                <a href="{{ route('categories.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                    Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Hapus
                </button>
            </div>
        </form>
    </div>
@endsection
