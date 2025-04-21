<x-app-layout>
    <!-- Custom Scrollbar CSS -->
    <style>
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
                    Pembayaran
                </span>
            </h2>
            <div class="hidden sm:flex items-center space-x-2">
                <span class="text-sm text-gray-500">{{ today()->format('F Y') }}</span>
                <button onclick="functionAdd()"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">➕
                    Tambah</button>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        {{-- Notifikasi --}}
        @if (session('message_insert'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    timer: 3000
                });
            </script>
        @endif
        @if (session('error_message'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}'
                });
            </script>
        @endif

        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-100 p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Data Pembayaran</h3>
                <span class="text-sm text-gray-500">Total: {{ $pembayaran->total() }} Data</span>
            </div>

            {{-- Search & Entries --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 space-y-2 sm:space-y-0">
                <form method="GET" action="{{ route('pembayaran.index') }}" class="flex w-full sm:w-auto gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama/bulan..."
                        class="w-full sm:w-64 px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-blue-500" />
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Cari</button>
                </form>
                <form method="GET" action="{{ route('pembayaran.index') }}" class="flex items-center space-x-2">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <label for="entries" class="text-sm">Tampilkan:</label>
                    <select name="entries" onchange="this.form.submit()"
                        class="w-20 px-2 py-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach ([10, 25, 50, 100] as $e)
                            <option value="{{ $e }}" {{ request('entries') == $e ? 'selected' : '' }}>
                                {{ $e }}</option>
                        @endforeach
                    </select>
                    <span class="text-sm">data</span>
                </form>
            </div>

            <div class="py-6 px-4 sm:px-6 lg:px-8">

                {{-- Desktop Table --}}
                <div
                    class="hidden sm:block bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Daftar Pelanggan</h3>
                        <span class="text-sm text-gray-500">Total: {{ $pembayaran->total() }} Data</span>
                    </div>
                    <div class="overflow-x-auto rounded-lg border border-gray-100">
                        <table class="w-full table-auto text-sm">
                            <thead class="bg-gray-50">
                                <tr class="text-gray-700">
                                    <th class="px-4 py-3 text-center">No</th>
                                    <th class="px-4 py-3">Nama</th>
                                    <th class="px-4 py-3 text-center">Bulan</th>
                                    <th class="px-4 py-3 text-center">Harga</th>
                                    <th class="px-4 py-3 text-center">Tgl Kirim</th>
                                    <th class="px-4 py-3 text-center">Status</th>
                                    <th class="px-4 py-3 text-center">Tgl Verifikasi</th>
                                    <th class="px-4 py-3">Bukti</th>
                                    <th class="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($pembayaran as $i => $p)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-3 text-center">{{ $pembayaran->firstItem() + $i }}</td>
                                        <td class="px-4 py-3">{{ $p->tagihan->pelanggan->user->name }}</td>
                                        <td class="px-4 py-3 text-center">{{ $p->tagihan->bulan_tahun }}</td>
                                        <td class="px-4 py-3 text-center">Rp
                                            {{ number_format($p->tagihan->pelanggan->paket->harga, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-center">{{ $p->tanggal_kirim }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span
                                                class="px-2 py-1 {{ $p->status_verifikasi == 'diterima' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }} rounded-full text-xs">{{ ucfirst($p->status_verifikasi) }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-center">{{ $p->tanggal_verifikasi }}</td>
                                        <td class="px-4 py-3">
                                            <img src="{{ asset('pembayaran_images/' . $p->image) }}" alt="Bukti"
                                                class="w-16 h-16 object-cover rounded" />
                                        </td>
                                        <td class="px-4 py-3 text-center space-x-1">
                                            <button onclick="openEditModal({{ $p }})"
                                                class="px-2 py-1 bg-amber-100 text-amber-600 rounded-md text-xs">✏️
                                                Edit</button>
                                            <button
                                                onclick="deletePembayaran('{{ $p->id }}','{{ $p->tagihan->pelanggan->user->name }}')"
                                                class="px-2 py-1 bg-red-100 text-red-600 rounded-md text-xs">🗑️
                                                Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 flex justify-end">
                        {{ $pembayaran->appends(request()->only(['search', 'entries']))->links() }}
                    </div>
                </div>

                {{-- Mobile Cards --}}
                <div class="sm:hidden space-y-4">
                    @foreach ($pembayaran as $p)
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-100 p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $p->tagihan->pelanggan->user->name }}
                                    </h4>
                                    <p class="text-xs text-gray-500">{{ $p->tagihan->bulan_tahun }}</p>
                                </div>
                                <span
                                    class="px-2 py-1 {{ $p->status_verifikasi == 'diterima' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }} rounded-full text-xs">{{ ucfirst($p->status_verifikasi) }}</span>
                            </div>
                            <div class="mt-2 grid grid-cols-2 gap-2 text-xs text-gray-700">
                                <div><span class="font-medium">Harga:</span> Rp
                                    {{ number_format($p->tagihan->pelanggan->paket->harga, 0, ',', '.') }}</div>
                                <div><span class="font-medium">Tgl Kirim:</span> {{ $p->tanggal_kirim }}</div>
                                <div><span class="font-medium">Tgl Verifikasi:</span> {{ $p->tanggal_verifikasi }}
                                </div>
                                <div class="col-span-2">
                                    <img src="{{ asset('pembayaran_images/' . $p->image) }}" alt="Bukti"
                                        class="w-full h-32 object-cover rounded" />
                                </div>
                            </div>
                            <div class="mt-3 flex justify-end space-x-2">
                                <button onclick="openEditModal({{ $p }})"
                                    class="px-3 py-1 bg-amber-100 text-amber-600 rounded-md text-xs">✏️</button>
                                <button
                                    onclick="deletePembayaran('{{ $p->id }}','{{ $p->tagihan->pelanggan->user->name }}')"
                                    class="px-3 py-1 bg-red-100 text-red-600 rounded-md text-xs">🗑️</button>
                            </div>
                        </div>
                    @endforeach
                    <div class="pt-2">
                        {{ $pembayaran->appends(request()->only(['search', 'entries']))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Floating Button (mobile only) -->
    <button onclick="openAddModal()"
        class="fixed bottom-4 right-4 w-14 h-14 bg-red-600 text-white rounded-full shadow-lg flex items-center justify-center hover:bg-red-700 sm:hidden">
        <span class="text-xl">➕</span>
    </button>

    <div class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm" id="sourceModal">
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full max-w-2xl max-h-[calc(100vh-4rem)] bg-white rounded-2xl shadow-xl flex flex-col">

                <!-- Header -->
                <div class="p-6 border-b bg-red-50 rounded-t-2xl flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold text-red-600">Tambah Pembayaran</h3>
                        <p class="text-sm text-red-400 mt-1">Isi semua bidang yang diperlukan (*)</p>
                    </div>
                    <button onclick="sourceModalClose()" class="text-red-500 hover:text-red-700 text-2xl p-2">
                        ✕
                    </button>
                </div>

                <form method="POST" id="formSourceModal" enctype="multipart/form-data"
                    class="flex-1 flex flex-col overflow-hidden">
                    @csrf
                    <div class="flex-1 overflow-y-auto p-6 space-y-4 modal-scroll">

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Upload Bukti Pembayaran <span class="text-red-500">*</span>
                            </label>
                            <div class=" flex items-center justify-center ">
                                <div class="bg-white p-6 rounded-xl shadow-lg">
                                    <div class="relative w-64 h-64">
                                        <!-- Image Preview -->
                                        <div id="image-preview"
                                            class="w-full h-full bg-gray-200 rounded-xl overflow-hidden flex items-center justify-center">
                                            <span class="text-gray-500">No image selected</span>
                                        </div>

                                        <!-- Camera Button -->
                                        <label for="image-input"
                                            class="absolute bottom-2 right-2 bg-white p-2 rounded-full shadow-lg cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </label>

                                        <!-- Hidden Input -->
                                        <input type="file" id="image-input" class="hidden" accept="image/*"
                                            name="image">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="tagihan_id"
                                class="block mb-2 text-sm font-medium text-gray-900">Tagihan</label>
                            <select class="js-example-placeholder-single js-states form-control w-full"
                                name="tagihan_id" data-placeholder="Pilih Tagihan">
                                <option value="">Pilih...</option>
                                @foreach ($tagihan as $t)
                                    <option value="{{ $t->id }}">{{ $t->pelanggan->user->name }},
                                        {{ $t->bulan_tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="tanggal_kirim" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                Kirim</label>
                            <input type="date" id="tanggal_kirim" name="tanggal_kirim"
                                value="{{ date('Y-m-d') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="status_verifikasi" class="block mb-2 text-sm font-medium text-gray-900">Status
                                Verifikasi</label>
                            <select class="js-example-placeholder-single js-states form-control w-full"
                                name="status_verifikasi" data-placeholder="Pilih Status Verifikasi">
                                <option value="">Pilih...</option>
                                <option value="diterima">Diterima</option>
                                <option value="menunggu verifikasi">Menunggu Verifikasi</option>
                                <option value="ditolak">Ditolak</option>

                            </select>
                        </div>
                        {{-- <div>
                                <label for="tanggal_verifikasi"
                                    class="block mb-2 text-sm font-medium text-gray-900">Tanggal Verifikasi</label>
                                <input type="date" id="tanggal_verifikasi" name="tanggal_verifikasi"
                                    value="{{ date('Y-m-d') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required />
                            </div> --}}
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" id="formSourceButton"
                            class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                        <button type="button" onclick="sourceModalClose()"
                            class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 items-center justify-center z-50 hidden" id="sourceModalEdit">
        <div class="fixed inset-0 bg-black opacity-50" onclick="sourceModalClose()"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5 max-h-[80vh] overflow-y-auto">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Edit Pelanggan
                    </h3>
                    <button type="button" onclick="sourceModalClose()"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModalEdit">
                    @csrf
                    <div class="flex flex-col p-4 space-y-6">
                        <div>
                            <label for="pelanggan_id_edit"
                                class="block mb-2 text-sm font-medium text-gray-900">Pelanggan</label>
                            <select class="js-example-placeholder-single js-states form-control w-full"
                                id="pelanggan_id_edit" name="pelanggan_id" data-placeholder="Pilih Pelanggan">
                                <option value="">Pilih...</option>
                                @foreach ($pelanggan as $p)
                                    <option value="{{ $p->id }}">{{ $p->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="bulan_tahun_edit"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bulan
                                Tahun</label>
                            <input name="bulan_tahun" type="month" id="bulan_tahun_edit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="status_pembayaran_edit"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                Pembayaran</label>
                            <select class="js-example-placeholder-single js-states form-control w-full m-6"
                                id="status_pembayaran_edit" name="status_pembayaran"
                                data-placeholder="Pilih Status Pembayaran">
                                <option value="">Pilih...</option>
                                <option value="belum_dibayar">Belum Dibayar</option>
                                <option value="menunggu_verifikasi">Menunggu Verifikasi</option>
                                <option value="lunas">Lunas</option>
                            </select>
                        </div>
                        <div>
                            <label for="jatuh_tempo_edit"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jatuh
                                Tempo</label>
                            <input name="jatuh_tempo" type="date" id="jatuh_tempo_edit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <div class="flex items-center p-4 border-t border-gray-200 rounded-b">
                        <button type="submit"
                            class="bg-green-500 text-white w-40 h-10 rounded-lg hover:bg-green-600">Simpan</button>
                        <button type="button" onclick="sourceModalClose()"
                            class="bg-red-500 text-white w-40 h-10 rounded-lg hover:bg-red-600 ml-2">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- JS Functions --}}
    <script>
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');

        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML =
                        `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg" alt="Preview">`;
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.innerHTML = '<span class="text-gray-500">No image selected</span>';
            }
        });

        const functionAdd = () => {
            const formModal = document.getElementById('formSourceModal');
            const modal = document.getElementById('sourceModal');

            // Set form action URL
            let url = "{{ route('pembayaran.store') }}";
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

        const sourceModalClose = () => {
            document.getElementById('sourceModalEdit').classList.add('hidden');
            document.getElementById('sourceModal').classList.add('hidden');
        }

        const pembayaranDelete = async (id, name) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus pembayaran  ${name} ?`);
            if (tanya) {
                await axios.post(`/pembayaran/${id}`, {
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
