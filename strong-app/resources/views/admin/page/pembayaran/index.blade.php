<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('PEMBAYARAN') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 flex items-center justify-between">
                    <div>DATA PEMBAYARAN</div>
                    <div>
                        <a href="#" onclick="return functionAdd()"
                            class="bg-sky-600 p-2 hover:bg-sky-400 text-white rounded-xl">Add</a>
                    </div>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        NO
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        NAMA
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        BULAN TAGIHAN
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        HARGA
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        TANGGAL KIRIM
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        STATUS
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        TANGGAL VERIFIKASI
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        GAMBAR
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pembayaran as $key => $p)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $no++ }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $p->tagihan->pelanggan->user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->tagihan->bulan_tahun }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->tagihan->pelanggan->paket->harga }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->tanggal_kirim }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->status_verifikasi }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->tanggal_verifikasi }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <img src="{{ $p->image }}" alt="">
                                        </td>
                                        <td class="px-6 py-4">
                                            <button type="button" data-id="{{ $p->id }}"
                                                data-modal-target="sourceModalEdit" data-nama="{{ $p->user->name }}"
                                                data-email="{{ $p->user->email }}" data-alamat="{{ $p->alamat }}"
                                                data-telepon="{{ $p->telepon }}" data-paket="{{ $p->paket_id }}"
                                                data-status="{{ $p->status }}"
                                                data-tanggal-langganan="{{ $p->tanggal_langganan }}"
                                                onclick="editSourceModal(this)"
                                                class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                Edit
                                            </button>
                                            <button
                                                onclick="return pembayaranDelete('{{ $p->id }}','{{ $p->tagihan->pelanggan->user->name }}')"
                                                class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $pembayaran->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="fixed inset-0 items-center justify-center z-50 hidden" id="sourceModal">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5 overflow-y-auto max-h-[90vh]">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source">
                        Tambah Pembayaran
                    </h3>
                    <button type="button" onclick="sourceModalClose()" data-modal-target="sourceModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="defaultModal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModal">
                    @csrf
                    <div class="flex flex-col p-4 space-y-6">
                        <div class=" flex items-center justify-center ">
                            <div class="bg-white p-6 rounded-xl shadow-lg">
                                <div class="relative w-64 h-64">
                                    <!-- Image Preview -->
                                    <div id="image-preview" class="w-full h-full bg-gray-200 rounded-xl overflow-hidden flex items-center justify-center">
                                        <span class="text-gray-500">No image selected</span>
                                    </div>
                        
                                    <!-- Camera Button -->
                                    <label for="image-input" class="absolute bottom-2 right-2 bg-white p-2 rounded-full shadow-lg cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </label>
                        
                                    <!-- Hidden Input -->
                                    <input type="file" id="image-input" class="hidden" accept="image/*" name="image">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="tagihan_id" class="block mb-2 text-sm font-medium text-gray-900">Tagihan</label>
                            <select class="js-example-placeholder-single js-states form-control w-full" name="tagihan_id"
                                data-placeholder="Pilih Tagihan">
                                <option value="">Pilih...</option>
                                @foreach ($tagihan as $t)
                                    <option value="{{ $t->id }}">{{ $t->pelanggan->user->name }}, {{ $t->bulan_tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="tanggal_kirim"
                                class="block mb-2 text-sm font-medium text-gray-900">Tanggal Kirim</label>
                            <input type="date" id="tanggal_kirim" name="tanggal_kirim"
                                value="{{ date('Y-m-d') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="status_verifikasi" class="block mb-2 text-sm font-medium text-gray-900">Status Verifikasi</label>
                            <select class="js-example-placeholder-single js-states form-control w-full" name="status_verifikasi"
                                data-placeholder="Pilih Status Verifikasi">
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
                            <select class="js-example-placeholder-single js-states form-control w-full" id="pelanggan_id_edit"
                                name="pelanggan_id" data-placeholder="Pilih Pelanggan">
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
                            <select class="js-example-placeholder-single js-states form-control w-full m-6" id="status_pembayaran_edit"
                                name="status_pembayaran" data-placeholder="Pilih Status Pembayaran">
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

    <script>

        // JavaScript to handle image preview
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');

        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg" alt="Preview">`;
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
            document.getElementById('title_source').innerText = "Add pembayaran";
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
