<x-layouts.app :title="__('Categories')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Product Categories</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Product
            Categories</flux:heading>
            <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <form action="{{ route('categories.index') }}" method="get">
                <flux:input icon="magnifying-glass" name="q" value="{{ $q }}"
                    placeholder="Cari kategori..." />
                <flux:button type="submit" variant="primary">Cari</flux:button>
            </form>


        </div>
        <div>
            <flux:button icon="plus">
                <flux:link href="{{ route('categories.create') }}" variant="subtle">Add New Category</flux:link>
            </flux:button>
        </div>
    </div>

    @if (session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 
w-full">{{ session()->get('successMessage') }}</flux:badge>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 
bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase 
tracking-wider">
                        ID
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 
bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase 
tracking-wider">
                        Image
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 
bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase 
tracking-wider">
                        Name
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 
bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase 
tracking-wider">
                        Slug
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 
bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase 
tracking-wider">

                        Description
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 
bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase 
tracking-wider">
                        Created At
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 
bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase 
tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 
bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $key + 1 }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 
bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                @if ($category->image)
                                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                        class="h-10 
w-10 object-cover rounded">
                                @else
                                    <div class="h-10 w-10 bg-gray-200 flex 
items-center justify-center rounded">
                                        <span class="text-gray-500 
text-sm">N/A</span>
                                    </div>
                                @endif
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 
bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $category->name }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 
bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $category->slug }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 
bg-white text-sm">
                            <p class="text-gray-900">
                                {{ $category->description }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 
bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $category->created_at }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 
bg-white text-sm">
                            <flux:dropdown>
                                <flux:button icon:trailing="chevron-down">Actions</flux:button>

                                <flux:menu>
                                    <flux:menu.item icon="pencil"
                                        href="{{ route('categories.edit', $category->id) }}">Edit</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger"
                                        onclick="event.preventDefault(); 
        if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) { 
            document.getElementById('delete-form-{{ $category->id }}').submit(); 
        }">
                                        Delete
                                    </flux:menu.item>

                                    <form id="delete-form-{{ $category->id }}"
                                        action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $categories->appends(['q' => $q])->links() }}
        </div>
    </div>

</x-layouts.app>


{{-- <x-layouts.app :title="__('Dashboard')">
<flux:heading>Products Categories</flux:heading>
<flux:text class="mt-2">Selamat datang di product categories. Happy shopping</flux:text>

<flux:button href="{{ route('categories.create') }}" icon="plus" class="mt-4 mb-4">
    Add New Category
</flux:button>

<table class="min-w-full divide-y divide-gray-200 table-auto">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($categories as $key => $category)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $key + 1 }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <img src="{{ Storage::url($category->image) }}" alt="{{$category->name}}" class="h-10 w-10 rounded-full">
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->slug }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->description }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <flux:dropdown>
                    <flux:button href="{{ route('categories.edit', $category->id) }}" icon="pencil" variant="primary" size="sm">
                        Edit
                    </flux:button>

                    <flux:button href="{{ route('categories.destroy', $category->id) }}" icon="trash" variant="danger" size="sm" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $category->id }}').submit();">
                        Delete
                    </flux:button>

                    <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </flux:dropdown>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</x-layouts.app> --}}
