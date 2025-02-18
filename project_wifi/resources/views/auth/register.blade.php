<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mt-4">
            <div>
                <x-input-label for="nama" :value="__('Nama')" />
                <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')"
                    required autofocus  />
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>
        </div>

        <!-- Alamat -->
        <div class="mt-4">
            <div>
                <x-input-label for="alamat" :value="__('Alamat')" />
                <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')"
                    required autofocus />
                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            </div>
        </div>

        <!-- No. HP -->
        <div class="mt-4">
            <div>
                <x-input-label for="telepon" :value="__('No. HP')" />
                <x-text-input id="telepon" class="block mt-1 w-full" type="number" name="telepon" :value="old('telepon')"
                    required autofocus  />
                <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mb-5 mt-4">
            <label for="paket" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paket</label>
            <select class="js-example-placeholder-single js-states form-control w-full m-6 p-3" name="id_paket" id="paket"
                data-placeholder="Pilih paket" >
                <option value="">Pilih...</option>
                @foreach ($paket as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->nama_paket }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
