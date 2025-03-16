<div class="space-y-4">
    <div>
        <x-input-label for="name" value="Nama Lengkap" />
        <x-text-input 
            id="name" 
            name="name" 
            type="text"
            class="mt-1 w-full"
            placeholder="Nama pelanggan"
            required
        />
    </div>

    <div>
        <x-input-label for="email" value="Email" />
        <x-text-input 
            id="email" 
            name="email" 
            type="email"
            class="mt-1 w-full"
            placeholder="email@contoh.com"
            required
        />
    </div>

    <div>
        <x-input-label for="password" value="Password" />
        <x-text-input 
            id="password" 
            name="password" 
            type="password"
            class="mt-1 w-full"
            required
        />
    </div>

    <div>
        <x-input-label for="paket_id" value="Paket Langganan" />
        <select name="paket_id" class="mt-1 w-full rounded-lg border-gray-200 shadow-sm focus:border-red-500 focus:ring-red-500">
            <option value="">Pilih Paket</option>
            @foreach ($paket as $p)
                <option value="{{ $p->id }}">{{ $p->nama_paket }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <x-input-label for="alamat" value="Alamat" />
        <textarea 
            id="alamat" 
            name="alamat" 
            rows="2"
            class="mt-1 w-full rounded-lg border-gray-200 shadow-sm focus:border-red-500 focus:ring-red-500"
            required
        ></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-input-label for="telepon" value="Nomor Telepon" />
            <x-text-input 
                id="telepon" 
                name="telepon" 
                type="tel"
                class="mt-1 w-full"
                required
            />
        </div>

        <div>
            <x-input-label for="status" value="Status" />
            <select name="status" class="mt-1 w-full rounded-lg border-gray-200 shadow-sm focus:border-red-500 focus:ring-red-500">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-gradient-to-r from-red-600 to-orange-500 text-white px-6 py-2 rounded-lg hover:shadow-lg transition-all">
            Simpan Data
        </button>
    </div>
</div>