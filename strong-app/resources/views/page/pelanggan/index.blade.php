<x-app-layout>
    <!-- Custom Scrollbar CSS -->
    <style>
        /* Custom Scrollbar */
        .modal-scroll::-webkit-scrollbar {
            width: 8px;
        }
        .modal-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        .modal-scroll::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }
        .modal-scroll::-webkit-scrollbar-thumb:hover {
            background: #999;
        }
    </style>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">
                <span class="bg-gradient-to-r from-red-600 to-orange-500 bg-clip-text text-transparent">
                    Manajemen Pelanggan
                </span>
            </h2>
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-500">{{ today()->format('d F Y') }}</span>
                <button onclick="toggleModal('createModal')" 
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                    ➕ Tambah Pelanggan
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Notifikasi -->
        @if(Session::has('message_insert'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ Session::get("message_insert") }}',
                timer: 3000
            })
        </script>
        @endif

        @if(Session::has('error_message'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ Session::get("error_message") }}'
            })
        </script>
        @endif

        <!-- Tabel Pelanggan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Pelanggan</h3>
                <span class="text-sm text-gray-500">Total: {{ $pelanggan->total() }} Data</span>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('pelanggan.index') }}" class="mb-4">
                <div class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari berdasarkan nama/email/alamat..." 
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-red-500 focus:ring-red-500">
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Cari
                    </button>
                </div>
            </form>

            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">No</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Nama</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Paket</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($pelanggan as $key => $p)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $pelanggan->firstItem() + $key }}</td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-800">{{ $p->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $p->user->email }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded-full text-xs">
                                    {{ $p->paket->nama_paket }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 {{ $p->status == 'aktif' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} rounded-full text-xs">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-2">
                                    <button onclick="openEditModal({{ $p }})"
                                        class="px-3 py-1 bg-orange-100 text-orange-600 rounded-md hover:bg-orange-200 text-sm">
                                        ✏️ Edit
                                    </button>
                                    <button onclick="deletePelanggan('{{ $p->id }}', '{{ $p->user->name }}')"
                                        class="px-3 py-1 bg-red-100 text-red-600 rounded-md hover:bg-red-200 text-sm">
                                        🗑️ Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <!-- Entries Per Page -->
                <form method="GET" action="{{ route('pelanggan.index') }}" class="flex items-center space-x-2">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="page" value="{{ request('page', 1) }}">
                    <label for="entries" class="text-sm">Show:</label>
                    <select name="entries" onchange="this.form.submit()"
                        class="w-20 px-2 py-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <label class="text-sm">entries</label>
                </form>

                <!-- Pagination -->
                <div class="flex items-center space-x-2">
                    {{ $pelanggan->appends([
                        'entries' => request('entries'),
                        'search' => request('search')
                    ])->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="createModal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm">
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl flex flex-col">
                <!-- Header -->
                <div class="p-6 border-b flex justify-between items-center bg-red-50 rounded-t-2xl">
                    <div>
                        <h3 class="text-xl font-bold text-red-600">Tambah Pelanggan Baru</h3>
                        <p class="text-sm text-red-400 mt-1">Isi semua bidang yang diperlukan (*)</p>
                    </div>
                    <button onclick="toggleModal('createModal')" 
                            class="text-red-500 hover:text-red-700 text-2xl p-2 transition-transform hover:rotate-90">
                        ✕
                    </button>
                </div>
                
                <!-- Body dengan Scroll -->
                <form action="{{ route('pelanggan.store') }}" method="post" class="flex-1 flex flex-col">
                    @csrf
                    <div class="flex-1 overflow-y-auto p-6 space-y-4">
                        <!-- Baris 1 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            👤
                                        </div>
                                        <x-text-input name="name" required placeholder="John Doe" 
                                            class="pl-10 w-full"/>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Email <span class="text-red-500">*</span>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            ✉️
                                        </div>
                                        <x-text-input type="email" name="email" required placeholder="john@example.com" 
                                            class="pl-10 w-full"/>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Baris 2 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Password <span class="text-red-500">*</span>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            🔒
                                        </div>
                                        <x-text-input type="password" name="password" required 
                                            class="pl-10 w-full"/>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Paket <span class="text-red-500">*</span>
                                    <select name="paket_id" class="w-full rounded-lg border-gray-200 focus:border-red-500 
                                        focus:ring-red-500 mt-1" required>
                                        <option value="">Pilih Paket</option>
                                        @foreach($paket as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_paket }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                        </div>

                        <!-- Baris 3 -->
                        <div class="grid grid-cols-1 gap-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Alamat <span class="text-red-500">*</span>
                                    <textarea name="alamat" rows="2" 
                                        class="w-full rounded-lg border-gray-200 focus:border-red-500 
                                        focus:ring-red-500 mt-1 p-2" 
                                        placeholder="Jl. Contoh No. 123..." required></textarea>
                            </div>
                        </div>

                        <!-- Baris 4 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Telepon <span class="text-red-500">*</span>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            📞
                                        </div>
                                        <x-text-input name="telepon" required placeholder="0812-3456-7890" 
                                            class="pl-10 w-full"/>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Status <span class="text-red-500">*</span>
                                    <select name="status" class="w-full rounded-lg border-gray-200 
                                        focus:border-red-500 focus:ring-red-500 mt-1" required>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <!-- Baris 5 -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Tanggal Langganan <span class="text-red-500">*</span>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        📅
                                    </div>
                                    <x-text-input type="date" name="tanggal_langganan" value="{{ date('Y-m-d') }}" 
                                        required class="pl-10 w-full"/>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="p-6 border-t bg-gray-50 rounded-b-2xl flex justify-end space-x-3">
                        <button type="button" onclick="toggleModal('createModal')"
                                class="px-6 py-2 text-gray-600 hover:bg-gray-100 rounded-lg 
                                transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 
                                transition-colors duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm">
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl flex flex-col">
                <!-- Header -->
                <div class="p-6 border-b flex justify-between items-center bg-red-50 rounded-t-2xl">
                    <div>
                        <h3 class="text-xl font-bold text-red-600">Edit Pelanggan</h3>
                        <p class="text-sm text-red-400 mt-1">Perbarui data pelanggan</p>
                    </div>
                    <button onclick="toggleModal('editModal')" 
                            class="text-red-500 hover:text-red-700 text-2xl p-2 transition-transform hover:rotate-90">
                        ✕
                    </button>
                </div>
                
                <!-- Body dengan Scroll -->
                <form method="POST" id="editForm" class="flex-1 flex flex-col">
                    @csrf
                    @method('PUT')
                    <div class="flex-1 overflow-y-auto p-6 space-y-4 modal-scroll">
                        <!-- Baris 1 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            👤
                                        </div>
                                        <x-text-input id="edit_name" name="name" required 
                                            class="pl-10 w-full"/>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Email <span class="text-red-500">*</span>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            ✉️
                                        </div>
                                        <x-text-input id="edit_email" type="email" name="email" required 
                                            class="pl-10 w-full"/>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Baris 2 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Password Baru (Opsional)
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            🔒
                                        </div>
                                        <x-text-input id="edit_password" type="password" name="password" 
                                            class="pl-10 w-full"/>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Paket <span class="text-red-500">*</span>
                                    <select id="edit_paket_id" name="paket_id" class="w-full rounded-lg border-gray-200 
                                        focus:border-red-500 focus:ring-red-500 mt-1" required>
                                        @foreach($paket as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_paket }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                        </div>

                        <!-- Baris 3 -->
                        <div class="grid grid-cols-1 gap-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Alamat <span class="text-red-500">*</span>
                                    <textarea id="edit_alamat" name="alamat" rows="2" 
                                        class="w-full rounded-lg border-gray-200 focus:border-red-500 
                                        focus:ring-red-500 mt-1 p-2" required></textarea>
                            </div>
                        </div>

                        <!-- Baris 4 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Telepon <span class="text-red-500">*</span>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            📞
                                        </div>
                                        <x-text-input id="edit_telepon" name="telepon" required 
                                            class="pl-10 w-full"/>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Status <span class="text-red-500">*</span>
                                    <select id="edit_status" name="status" class="w-full rounded-lg border-gray-200 
                                        focus:border-red-500 focus:ring-red-500 mt-1" required>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <!-- Baris 5 -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Tanggal Langganan <span class="text-red-500">*</span>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        📅
                                    </div>
                                    <x-text-input id="edit_tanggal" type="date" name="tanggal_langganan" required 
                                        class="pl-10 w-full"/>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="p-6 border-t bg-gray-50 rounded-b-2xl flex justify-end space-x-3">
                        <button type="button" onclick="toggleModal('editModal')"
                                class="px-6 py-2 text-gray-600 hover:bg-gray-100 rounded-lg 
                                transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 
                                transition-colors duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle Modal
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }

        // Open Edit Modal
        function openEditModal(pelanggan) {
            document.getElementById('edit_name').value = pelanggan.user.name;
            document.getElementById('edit_email').value = pelanggan.user.email;
            document.getElementById('edit_paket_id').value = pelanggan.paket_id;
            document.getElementById('edit_alamat').value = pelanggan.alamat;
            document.getElementById('edit_telepon').value = pelanggan.telepon;
            document.getElementById('edit_status').value = pelanggan.status;
            document.getElementById('edit_tanggal').value = pelanggan.tanggal_langganan;
            
            const form = document.getElementById('editForm');
            form.action = `/pelanggan/${pelanggan.id}`;
            toggleModal('editModal');
        }

        // Delete Confirmation
        async function deletePelanggan(id, name) {
            const confirmed = await Swal.fire({
                title: `Hapus ${name}?`,
                text: "Data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            });

            if (confirmed.isConfirmed) {
                try {
                    await fetch(`/pelanggan/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ _method: 'DELETE' })
                    });
                    
                    Swal.fire('Terhapus!', 'Data pelanggan telah dihapus', 'success');
                    setTimeout(() => location.reload(), 1500);
                } catch (error) {
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus', 'error');
                }
            }
        }
    </script>

</x-app-layout>