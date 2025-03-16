<x-app-layout>
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
                        class="md:hidden bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                    ➕ Tambah
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

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <!-- Form Desktop -->
            <div class="hidden md:block md:col-span-2 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Tambah Pelanggan Baru</h3>
                <form action="{{ route('pelanggan.store') }}" method="post" class="space-y-4">
                    @csrf
                    <div>
                        <x-input-label value="Nama Lengkap" />
                        <x-text-input name="name" required placeholder="John Doe" />
                    </div>
                    
                    <div>
                        <x-input-label value="Email" />
                        <x-text-input type="email" name="email" required placeholder="john@example.com" />
                    </div>

                    <div>
                        <x-input-label value="Password" />
                        <x-text-input type="password" name="password" required />
                    </div>

                    <div>
                        <x-input-label value="Paket" />
                        <select name="paket_id" class="w-full rounded-lg border-gray-200 focus:border-red-500 focus:ring-red-500" required>
                            <option value="">Pilih Paket</option>
                            @foreach($paket as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_paket }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label value="Alamat" />
                        <textarea name="alamat" rows="2" class="w-full rounded-lg border-gray-200 focus:border-red-500 focus:ring-red-500" required></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label value="Telepon" />
                            <x-text-input name="telepon" required placeholder="0812-3456-7890" />
                        </div>
                        
                        <div>
                            <x-input-label value="Status" />
                            <select name="status" class="w-full rounded-lg border-gray-200 focus:border-red-500 focus:ring-red-500" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <x-input-label value="Tanggal Langganan" />
                        <x-text-input type="date" name="tanggal_langganan" value="{{ date('Y-m-d') }}" required />
                    </div>

                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition-colors">
                        Simpan Data
                    </button>
                </form>
            </div>

            <!-- Tabel Pelanggan -->
            <div class="md:col-span-3 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Pelanggan</h3>
                    <span class="text-sm text-gray-500">{{ $pelanggan->total() }} Data</span>
                </div>

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

                <div class="mt-4">
                    {{ $pelanggan->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Mobile -->
    <div id="createModal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm">
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="w-full max-w-md bg-white rounded-2xl shadow-xl">
                <div class="p-4 border-b flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Tambah Pelanggan</h3>
                    <button onclick="toggleModal('createModal')" class="text-gray-500 hover:text-gray-700">✕</button>
                </div>
                <form action="{{ route('pelanggan.store') }}" method="post" class="p-4 space-y-4">
                    @csrf
                    
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm">
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="w-full max-w-md bg-white rounded-2xl shadow-xl">
                <div class="p-4 border-b flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Edit Pelanggan</h3>
                    <button onclick="toggleModal('editModal')" class="text-gray-500 hover:text-gray-700">✕</button>
                </div>
                <form method="POST" id="editForm" class="p-4 space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <x-input-label value="Nama Lengkap" />
                        <x-text-input id="edit_name" name="name" required />
                    </div>

                    <div>
                        <x-input-label value="Email" />
                        <x-text-input id="edit_email" type="email" name="email" required />
                    </div>

                    <div>
                        <x-input-label value="Password Baru (Opsional)" />
                        <x-text-input id="edit_password" type="password" name="password" />
                    </div>

                    <div>
                        <x-input-label value="Paket" />
                        <select id="edit_paket_id" name="paket_id" class="w-full rounded-lg border-gray-200 focus:border-red-500 focus:ring-red-500" required>
                            @foreach($paket as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_paket }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label value="Alamat" />
                        <textarea id="edit_alamat" name="alamat" rows="2" class="w-full rounded-lg border-gray-200 focus:border-red-500 focus:ring-red-500" required></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label value="Telepon" />
                            <x-text-input id="edit_telepon" name="telepon" required />
                        </div>
                        
                        <div>
                            <x-input-label value="Status" />
                            <select id="edit_status" name="status" class="w-full rounded-lg border-gray-200 focus:border-red-500 focus:ring-red-500" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <x-input-label value="Tanggal Langganan" />
                        <x-text-input id="edit_tanggal" type="date" name="tanggal_langganan" required />
                    </div>

                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition-colors">
                        Simpan Perubahan
                    </button>
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