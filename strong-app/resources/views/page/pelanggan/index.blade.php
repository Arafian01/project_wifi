<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('PELANGGAN') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 flex items-center justify-between">
                    <div>DATA PELANGGAN</div>
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
                                        EMAIL
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        PAKET
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ALAMAT
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        TELEPON
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        TANGGAL LANGANAN
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        STATUS
                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pelanggan as $key => $p)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $no++ }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $p->user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->user->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->paket->nama_paket }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->alamat }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->telepon }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->tanggal_langganan }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->status }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <button type="button" data-id="{{ $p->id }}"
                                                data-modal-target="sourceModalEdit" data-nama="{{ $p->user_id }}"
                                                data-alamat="{{ $p->alamat }}" data-telepon="{{ $p->telepon }}"
                                                data-paket="{{ $p->paket_id }}" data-status="{{ $p->status }}"
                                                data-tanggal-langganan="{{ $p->tanggal_langganan }}"  onclick="editSourceModal(this)"
                                                class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                Edit
                                            </button>
                                            <button
                                                onclick="return konsumenDelete('{{ $p->id }}','{{ $p->nama }}')"
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
                            <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900">User</label>
                            <select class="js-example-placeholder-single js-states form-control w-full" name="user_id" data-placeholder="Pilih User">
                                <option value="">Pilih...</option>
                                @foreach ($user as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="paket_id" class="block mb-2 text-sm font-medium text-gray-900">Paket</label>
                            <select class="js-example-placeholder-single js-states form-control w-full" name="paket_id" data-placeholder="Pilih Paket">
                                <option value="">Pilih...</option>
                                @foreach ($paket as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_paket }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                            <input type="text" id="alamat" name="alamat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="telepon" class="block mb-2 text-sm font-medium text-gray-900">Telepon</label>
                            <input type="text" id="telepon" name="telepon"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="tanggal_langganan" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Langganan</label>
                            <input type="date" id="tanggal_langganan" name="tanggal_langganan" value="{{ date('Y-m-d') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                            <select class="js-example-placeholder-single js-states form-control w-full" name="status" data-placeholder="Pilih Status">
                                <option value="">Pilih...</option>
                                <option value="aktif">AKTIF</option>
                                <option value="nonaktif">NONAKTIF</option>
                            </select>
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
                            <label for="nama_edit" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                            <input type="text" id="nama_edit" name="nama"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="email_edit" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" id="email_edit" name="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="password_edit" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="text" id="password_edit" name="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>
                        <div>
                            <label for="paket_edit" class="block mb-2 text-sm font-medium text-gray-900">Paket</label>
                            <select id="paket_edit" name="paket_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Pilih Paket</option>
                                @foreach ($paket as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_paket }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="alamat_edit" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                            <input type="text" id="alamat_edit" name="alamat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="telepon_edit" class="block mb-2 text-sm font-medium text-gray-900">Telepon</label>
                            <input type="text" id="telepon_edit" name="telepon"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="status_edit" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                            <select id="status_edit" name="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center p-4 border-t border-gray-200 rounded-b">
                        <button type="submit" class="bg-green-500 text-white w-40 h-10 rounded-lg hover:bg-green-600">Simpan</button>
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
            document.getElementById('sourceModalEdit').classList.add('hidden');
            document.getElementById('sourceModal').classList.add('hidden');
        }

        const konsumenDelete = async (id, konsumen) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus Konsumen ${konsumen} ?`);
            if (tanya) {
                await axios.post(`/konsumen/${id}`, {
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
