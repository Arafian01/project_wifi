<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('CHAT NOTIFIKASI') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Form Tambah Pesan -->
            <div class="mb-4">
                <form action="{{ route('notifikasi.store') }}" method="POST"
                    class="bg-white p-4 rounded-lg shadow-md flex gap-2">
                    @csrf
                    <input type="text" name="judul" placeholder="Judul" class="flex-1 p-2 border rounded-lg"
                        required>
                    <input type="text" name="pesan" placeholder="Pesan" class="flex-1 p-2 border rounded-lg"
                        required>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                        Kirim
                    </button>
                </form>
            </div>

            <!-- Daftar Pesan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($notifikasis as $notifikasi)
                    <div class="bg-white p-4 rounded-lg shadow-md relative group">
                        <!-- Judul dan Pesan -->
                        <strong class="block text-lg font-medium text-gray-800">{{ $notifikasi->judul }}</strong>
                        <p class="text-gray-600 mt-1">{{ $notifikasi->pesan }}</p>

                        <div class="flex justify-between">
                            <!-- Tanggal Kirim -->
                            <small
                                class="block text-gray-500 mt-2">{{ $notifikasi->created_at->format('d M Y H:i') }}</small>

                            <!-- Status Baca -->
                            <div class="mt-1">
                                @php
                                    // Cek apakah id_user login dan id_pesan ada di tabel status_baca
                                    $isRead = \App\Models\status_baca::where('user_id', auth()->id())
                                        ->where('notifikasi_id', $notifikasi->id)
                                        ->exists();
                                @endphp
                                @if ($isRead)
                                    <span class="text-green-500">✔️ Dibaca</span>
                                @else
                                    <span class="text-red-500">❌ Belum Dibaca</span>
                                @endif
                            </div>
                        </div>

                        <!-- Hover Actions -->
                        <div
                            class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex gap-2">
                                <form action="{{ route('notifikasi.index', $notifikasi->id) }}" method="GET"
                                    class="inline">
                                    <button type="submit" class="text-blue-500 hover:text-blue-700">
                                        ✏️
                                    </button>
                                </form>
                                <form action="{{ route('notifikasi.destroy', $notifikasi->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
