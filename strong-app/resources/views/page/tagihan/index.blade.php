<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('TAGIHAN') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 flex items-center justify-between">
                    <div>DATA TAGIHAN</div>
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
                                        NAMA PELANGGAN
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        BULAN TAHUN
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        STATUS PEMBAYARAN
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        JATUH TEMPO
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($tagihan as $key => $t)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $tagihan->perPage() * ($tagihan->currentPage() - 1) + $key + 1 }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $t->pelanggan->user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->bulan_tahun }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->status_pembayaran }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->jatuh_tempo }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <button type="button" data-id="{{ $t->id }}"
                                                data-modal-target="sourceModal" data-nama="{{ $t->pelanggan_id }}"
                                                data-bulan_tahun="{{ $t->bulan_tahun }}"
                                                data-status_pembayaran="{{ $t->status_pembayaran }}"
                                                data-jatuh_tempo="{{ $t->jatuh_tempo }}"
                                                onclick="editSourceModal(this)"
                                                class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                Edit
                                            </button>
                                            <button
                                                onclick="return tagihanDelete('{{ $t->id }}','{{ $t->pelanggan->user->name }}')"
                                                class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                    <div class="flex flex-col p-4 space-y-6">
                        <div>
                            <label for="pelanggan_id"
                                class="block mb-2 text-sm font-medium text-gray-900">Pelanggan</label>
                            <select class="js-example-placeholder-single js-states form-control w-full"
                                name="pelanggan_id" data-placeholder="Pilih Pelanggan">
                                <option value="">Pilih...</option>
                                @foreach ($pelanggan as $p)
                                    <option value="{{ $p->id }}">{{ $p->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="bulan_tahun"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bulan Tahun</label>
                            <input name="bulan_tahun" type="month" id="bulan_tahun"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="status_pembayaran"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                Pembayaran</label>
                            <select class="js-example-placeholder-single js-states form-control w-full m-6"
                                name="status_pembayaran" data-placeholder="Pilih Status Pembayaran">
                                <option value="">Pilih...</option>
                                <option value="belum_dibayar">Belum Dibayar</option>
                                <option value="menunggu_verifikasi">Menunggu Verifikasi</option>
                                <option value="lunas">Lunas</option>
                            </select>
                        </div>
                        <div>
                            <label for="jatuh_tempo"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jatuh Tempo</label>
                            <input name="jatuh_tempo" type="date" id="jatuh_tempo"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
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
        const functionAdd = () => {
            const formModal = document.getElementById('formSourceModal');
            const modal = document.getElementById('sourceModal');

            // Set form action URL
            let url = "{{ route('tagihan.store') }}";
            document.getElementById('title_source').innerText = "Add tagihan";
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
            const nama = button.dataset.nama;
            const bulan_tahun = button.dataset.bulan_tahun;
            const status_pembayaran = button.dataset.status_pembayaran;
            const jatuh_tempo = button.dataset.jatuh_tempo;
            console.log(jatuh_tempo);

            let url = "{{ route('tagihan.update', ':id') }}".replace(':id', id);

            let status = document.getElementById(modalTarget);
            document.getElementById('title_source').innerText = `Update tagihan ${nama}`;

            document.getElementById('bulan_tahun_edit').value = bulan_tahun;
            document.getElementById('jatuh_tempo_edit').value = jatuh_tempo;

            let event = new Event('change');
            document.getElementById('status_pembayaran_edit').value = status_pembayaran;
            document.getElementById('status_pembayaran_edit').dispatchEvent(event);

            document.getElementById('pelanggan_id_edit').value = nama;
            document.getElementById('pelanggan_id_edit').dispatchEvent(event);


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
            document.getElementById('sourceModalEdit').classList.add('hidden');
            document.getElementById('sourceModal').classList.add('hidden');
        }

        const tagihanDelete = async (id, name) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus Tagihan Pelanggan ${name} ?`);
            if (tanya) {
                await axios.post(`/tagihan/${id}`, {
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
