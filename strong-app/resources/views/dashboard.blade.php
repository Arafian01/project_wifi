<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">
                <span class="bg-gradient-to-r from-red-600 to-orange-500 bg-clip-text text-transparent">
                    Halo, {{ Auth::user()->name }}
                </span>
            </h2>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">{{ today()->format('d F Y') }}</span>
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                    <span class="text-red-600 text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Status Langganan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-green-100 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Status Langganan</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-xl font-bold text-gray-800">Paket </span>
                        <span class="px-2 py-1 bg-green-100 text-green-600 rounded-full text-xs">Aktif</span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Berakhir pada</p>
                    <p class="text-lg font-semibold text-gray-800"></p>
                </div>
            </div>
            <div class="mt-4">
                <div class="h-2 bg-gray-200 rounded-full">
                    <div class="h-2 bg-green-500 rounded-full w-3/4"></div>
                </div>
                <div class="flex justify-between text-sm text-gray-500 mt-2">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>

        <!-- Quick Info Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Tagihan Terakhir -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Tagihan Terakhir</p>
                        <p class="text-2xl font-bold text-gray-800">Rp </p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-sm ">
                    </span>
                </div>
            </div>

            <!-- Penggunaan Kuota -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Penggunaan Kuota</p>
                        <p class="text-2xl font-bold text-gray-800"> GB</p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-full">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>0 GB</span>
                        <span>GB</span>
                    </div>
                    <div class="h-2 bg-gray-200 rounded-full mt-1">
                        <div class="h-2 bg-purple-500 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            <!-- Perangkat Terhubung -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Perangkat Terhubung</p>
                        <p class="text-2xl font-bold text-gray-800"></p>
                    </div>
                    <div class="p-3 bg-orange-100 rounded-full">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-sm text-gray-500">Maks perangkat</span>
                </div>
            </div>
        </div>

        

        <!-- Quick Actions -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
            <a href="" class="bg-white/80 backdrop-blur-sm p-4 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-all text-center">
                <div class="p-2 bg-red-100 rounded-full inline-block">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <p class="mt-2 text-sm font-medium text-gray-700">Bayar Tagihan</p>
            </a>

            <a href="" class="bg-white/80 backdrop-blur-sm p-4 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-all text-center">
                <div class="p-2 bg-blue-100 rounded-full inline-block">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <p class="mt-2 text-sm font-medium text-gray-700">Profil Saya</p>
            </a>

            <a href="" class="bg-white/80 backdrop-blur-sm p-4 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-all text-center">
                <div class="p-2 bg-green-100 rounded-full inline-block">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <p class="mt-2 text-sm font-medium text-gray-700">Bantuan</p>
            </a>

            <a href="" class="bg-white/80 backdrop-blur-sm p-4 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-all text-center">
                <div class="p-2 bg-purple-100 rounded-full inline-block">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="mt-2 text-sm font-medium text-gray-700">Perangkat</p>
            </a>
        </div>
    </div>
</x-app-layout>