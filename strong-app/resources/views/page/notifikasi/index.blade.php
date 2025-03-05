<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('CHAT NOTIFIKASI') }}
            </h2>
            <!-- Tombol Tambah Pesan -->
            <a href="#" onclick="return functionAdd()" class="bg-sky-600 p-2 hover:bg-sky-400 text-white rounded-xl">Add</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Daftar Pesan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($notifikasis as $notifikasi)
                    <div class="bg-white p-6 rounded-lg shadow-md relative group">
                        <!-- Judul dan Pesan -->
                        <strong class="block text-lg font-medium text-gray-800">{{ $notifikasi->judul }}</strong>
                        <p class="text-gray-600 mt-1">{{ $notifikasi->pesan }}</p>

                        <div class="flex justify-between items-center">
                            <!-- Tanggal Kirim -->
                            <small class="block text-gray-500 mt-2">{{ $notifikasi->created_at->format('d M Y H:i') }}</small>

                            <!-- Status Baca -->
                            <div class="mt-1">
                                @if ($isRead)
                                    <span class="text-green-500">✔️ Dibaca</span>
                                @else
                                    <span class="text-red-500">❌ Belum Dibaca</span>
                                @endif
                            </div>
                        </div>

                        <!-- Hover Actions -->
                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex gap-2">
                                <!-- Tombol Edit (Modal) -->
                                <button onclick="openEditModal({{ $notifikasi->id }})" class="text-blue-500 hover:text-blue-700">
                                    ✏️
                                </button>
                                <!-- Tombol Hapus -->
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

    <!-- Modal Tambah Pesan -->
    <div id="sourceModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-xl font-semibold mb-4" id="modalTitle">Tambah Pesan</h2>
            <form id="modalForm" action="{{ route('notifikasi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="editId">
                <div class="mb-4">
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="judul" id="judul" placeholder="Judul"
                        class="mt-1 p-2 border rounded-lg w-full" required>
                </div>
                <div class="mb-4">
                    <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan</label>
                    <textarea name="pesan" id="pesan" placeholder="Pesan"
                        class="mt-1 p-2 border rounded-lg w-full"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="sourceModalClose()"
                        class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-300">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="fixed inset-0 items-center justify-center z-50 hidden" id="sourceModal">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5 overflow-y-auto max-h-[90vh]">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source">
                        Tambah Pelanggan
                    </h3>
                    <button type="button" onclick="sourceModalClose()" data-modal-target="sourceModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="defaultModal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModal">
                    @csrf
                    <div class="mb-4">
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="judul" id="judul" placeholder="Judul"
                        class="mt-1 p-2 border rounded-lg w-full" required>
                </div>
                <div class="mb-4">
                    <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan</label>
                    <textarea name="pesan" id="pesan" placeholder="Pesan"
                        class="mt-1 p-2 border rounded-lg w-full"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="sourceModalClose()"
                        class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-300">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
                        Simpan
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script untuk Mengontrol Modal -->
    <script>
        const functionAdd = () => {
            const formModal = document.getElementById('formSourceModal');
            const modal = document.getElementById('sourceModal');

            // Set form action URL
            let url = "{{ route('pelanggan.store') }}";
            document.getElementById('title_source').innerText = "Add pelanggan";
            formModal.setAttribute('action', url);

            // Display the modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Ensure CSRF token is added once
            if (!formModal.querySelector('input[name="_token"]')) {
                let csrfToken = document.createElement('input');
                csrfToken.setAttribute('type', 'hidden');
                csrfToken.setAttribute('name', '_token');
                csrfToken.setAttribute('value', '{{ csrf_token() }}');
                formModal.appendChild(csrfToken);
            }
        }
        
        const editSourceModal = (button) => {
            const formModal = document.getElementById('formSourceModalEdit');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const pelanggan = button.dataset.nama;
            const email = button.dataset.email;
            const alamat = button.dataset.alamat;
            const telepon = button.dataset.telepon;
            const paketValue = button.dataset.paket;
            const statusValue = button.dataset.status;

            let url = "{{ route('pelanggan.update', ':id') }}".replace(':id', id);

            console.log(url);
            document.getElementById('title_source').innerText = `Update pelanggan ${pelanggan}`;

            document.getElementById('nama_edit').value = pelanggan;
            document.getElementById('alamat_edit').value = alamat;
            document.getElementById('email_edit').value = email;
            document.getElementById('telepon_edit').value = telepon;
            console.log(paketValue);

            let event = new Event('change');
            document.getElementById('status_edit').value = statusValue;
            document.getElementById('status_edit').dispatchEvent(event);

            document.getElementById('paket_edit').value = paketValue;
            document.getElementById('paket_edit').dispatchEvent(event);


            formModal.setAttribute('action', url);

            if (!formModal.querySelector('input[name="_token"]')) {
                let csrfToken = document.createElement('input');
                csrfToken.setAttribute('type', 'hidden');
                csrfToken.setAttribute('name', '_token');
                csrfToken.setAttribute('value', '{{ csrf_token() }}');
                formModal.appendChild(csrfToken);
            }

            if (!formModal.querySelector('input[name="_method"]')) {
                let methodInput = document.createElement('input');
                methodInput.setAttribute('type', 'hidden');
                methodInput.setAttribute('name', '_method');
                methodInput.setAttribute('value', 'PATCH');
                formModal.appendChild(methodInput);
            }

            document.getElementById(modalTarget).classList.remove('hidden');
        }

        const sourceModalClose = () => {
            document.getElementById('sourceModal').classList.add('hidden');
        }

        const konsumenDelete = async (id, name) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus Pelanggan ${name} ?`);
            if (tanya) {
                await axios.post(`/pelanggan/${id}`, {
                        '_method': 'DELETE',
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    })
                    .then(function(response) {
                        // Handle success
                        location.reload();
                    })
                    .catch(function(error) {
                        // Handle error
                        alert('Error deleting record');
                        console.log(error);
                    });
            }
        }
    </script>
</x-app-layout>