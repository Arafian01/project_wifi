<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Paket') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <h1 class="mb-4">Notifikasi</h1>

                <ul class="list-group">
                    @foreach ($notifikasis as $notifikasi)
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center 
                {{ in_array($notifikasi->id, $dibaca) ? 'text-muted' : 'fw-bold' }}">
                            <div>
                                <strong>{{ $notifikasi->judul }}</strong>
                                <p>{{ $notifikasi->pesan }}</p>
                            </div>
                            @if (!in_array($notifikasi->id, $dibaca))
                                <form action="{{ route('notifikasi.baca', $notifikasi->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Tandai Dibaca</button>
                                </form>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
