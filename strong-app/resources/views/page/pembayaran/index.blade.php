<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('PEMBAYRAN') }}
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
                                            {{ $p->user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->tagihan->bulan_tahun }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->paket->harga }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->tanggal_kirim }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->status }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->tanggal_verifikasi }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $p->image }}
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
                                                onclick="return konsumenDelete('{{ $p->id }}','{{ $p->user->name }}')"
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
    
</x-app-layout>
