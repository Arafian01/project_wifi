<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Notifikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 ">

    <!-- Navbar -->
    <div class="flex justify-between items-center bg-white shadow-md p-4 rounded-lg px-10">
        <a href="{{ route('dashboard') }}" class="text-blue-500 font-semibold">← Kembali</a>
        <button onclick="openModal('modalTambah')" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            + Tambah Notifikasi
        </button>
    </div>

    <!-- Daftar Notifikasi -->
    <div class="mt-6 max-w-3xl mx-auto p-6">
        @if ($notifikasis->isEmpty())
            <p class="text-gray-500 text-center">Tidak ada notifikasi.</p>
        @else
            @foreach ($notifikasis as $notifikasi)
                <div class="flex justify-between items-center bg-white shadow-md p-4 mb-3 rounded-lg">
                    <div>
                        <h4 class="text-lg font-bold">{{ $notifikasi->judul }}</h4>
                        <p class="text-gray-600">{{ $notifikasi->pesan }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="openEditModal({{ $notifikasi->id }}, '{{ $notifikasi->judul }}', '{{ $notifikasi->pesan }}')" 
                            class="text-yellow-500 hover:text-yellow-700">✏️ Edit</button>
                        <form action="{{ route('notifikasi.destroy', $notifikasi->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">❌ Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Modal Tambah Notifikasi -->
    <div id="modalTambah" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-md w-96">
            <h2 class="text-xl font-bold mb-4">Tambah Notifikasi</h2>
            <form action="{{ route('notifikasi.store') }}" method="POST">
                @csrf
                <input type="text" name="judul" placeholder="Judul" required class="w-full p-2 border rounded mb-3">
                <textarea name="pesan" placeholder="Pesan" required class="w-full p-2 border rounded mb-3"></textarea>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Simpan</button>
            </form>
            <button onclick="closeModal('modalTambah')" class="w-full mt-2 bg-gray-300 text-black py-2 rounded-md">Batal</button>
        </div>
    </div>

    <!-- Modal Edit Notifikasi -->
    <div id="modalEdit" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-md w-96">
            <h2 class="text-xl font-bold mb-4">Edit Notifikasi</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="editJudul" name="judul" required class="w-full p-2 border rounded mb-3">
                <textarea id="editPesan" name="pesan" required class="w-full p-2 border rounded mb-3"></textarea>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Update</button>
            </form>
            <button onclick="closeModal('modalEdit')" class="w-full mt-2 bg-gray-300 text-black py-2 rounded-md">Batal</button>
        </div>
    </div>

    <!-- JavaScript untuk Modal -->
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove("hidden");
        }

        function closeModal(id) {
            document.getElementById(id).classList.add("hidden");
        }

        function openEditModal(id, judul, pesan) {
            document.getElementById("editJudul").value = judul;
            document.getElementById("editPesan").value = pesan;
            document.getElementById("editForm").action = "/notifikasi/" + id;
            openModal('modalEdit');
        }
    </script>

</body>
</html>
