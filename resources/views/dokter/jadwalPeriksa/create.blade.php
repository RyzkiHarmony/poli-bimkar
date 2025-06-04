<!-- resources/views/dokter/jadwalPeriksa/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Form Tambah Jadwal Periksa') }}
                        </h2>
                    </header>

                    <form action="{{ route('dokter.jadwalPeriksa.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div class="flex flex-col">
                                <label for="hari" class="text-gray-700">Hari</label>
                                <select id="hari" name="hari" class="mt-1 border border-gray-300 p-2 rounded-md"
                                    required>
                                    <option value="" {{ old('') == '' ? 'selected' : '' }}>Pilih Hari</option>
                                    <option value="Senin" {{ old('hari') == 'Senin' ?: '' }}>Senin</option>
                                    <option value="Selasa" {{ old('hari') == 'Selasa' ?: '' }}>Selasa
                                    </option>
                                    <option value="Rabu" {{ old('hari') == 'Rabu' ?: '' }}>Rabu</option>
                                    <option value="Kamis" {{ old('hari') == 'Kamis' ?: '' }}>Kamis</option>
                                    <option value="Jumat" {{ old('hari') == 'Jumat' ?: '' }}>Jumat</option>
                                </select>

                            </div>

                            <div class="flex flex-col">
                                <label for="jam_mulai" class="text-gray-700">Jam Mulai</label>
                                <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}"
                                    class="mt-1 border border-gray-300 p-2 rounded-md" required>

                            </div>

                            <div class="flex flex-col">
                                <label for="jam_selesai" class="text-gray-700">Jam Selesai</label>
                                <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}"
                                    class="mt-1 border border-gray-300 p-2 rounded-md" required>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>