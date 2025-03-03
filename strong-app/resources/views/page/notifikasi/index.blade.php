<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('NOTIFIKASI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container bg-gray-100 p-4 rounded-lg shadow-md h-[70vh] overflow-y-auto">
                @foreach ($notifikasis as $notifikasi)
                    <div class="flex items-start gap-2 mb-4">
                        <div class="flex flex-col items-center">
                            <form action="{{ route('notifikasi.index', $notifikasi->id) }}" method="GET" class="mb-1">
                                <button type="submit" class="text-blue-500 hover:text-blue-700">✏️</button>
                            </form>
                            <form action="{{ route('notifikasi.destroy', $notifikasi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">🗑️</button>
                            </form>
                        </div>
                        <div class="bg-white p-3 rounded-lg shadow-md max-w-lg w-full">
                            <strong>{{ $notifikasi->judul }}</strong>
                            <p class="text-gray-600">{{ $notifikasi->pesan }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Form Tambah Notifikasi (Fixed Bottom) -->
    <div class="fixed bottom-0 left-0 w-full bg-white p-4 shadow-md border-t">
        <div class="max-w-7xl mx-auto">
            <form action="{{ route('notifikasi.store') }}" method="POST" class="bg-gray-100 p-4 rounded-lg shadow-md flex gap-2">
                @csrf
                <input type="text" name="judul" placeholder="Judul" class="flex-1 p-2 border rounded-lg" required>
                <input type="text" name="pesan" placeholder="Pesan" class="flex-1 p-2 border rounded-lg" required>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Kirim</button>
            </form>
        </div>
    </div>
</x-app-layout>
