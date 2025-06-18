<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Periksa Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Form Pemeriksaan') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Isi form pemeriksaan untuk pasien.') }}
                        </p>
                    </header>

                    <!-- Informasi Pasien -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pasien</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                                    <p class="mt-1 text-sm text-gray-900 font-semibold">
                                        {{ $janjiPeriksa->pasien->name ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">No. HP</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $janjiPeriksa->pasien->no_hp ?? 'N/A' }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Keluhan</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $janjiPeriksa->keluhan ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Jadwal</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $janjiPeriksa->jadwalPeriksa->hari ?? 'N/A' }},
                                        {{ $janjiPeriksa->jadwalPeriksa->jam_mulai ?? 'N/A' }} -
                                        {{ $janjiPeriksa->jadwalPeriksa->jam_selesai ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Pemeriksaan -->
                    <form method="post" action="{{ route('dokter.memeriksa.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <input type="hidden" name="id_janji_periksa" value="{{ $janjiPeriksa->id }}">

                        <div>
                            <x-input-label for="tgl_periksa" :value="__('Tanggal Periksa')" />
                            <x-text-input id="tgl_periksa" name="tgl_periksa" type="datetime-local"
                                class="mt-1 block w-full" value="{{ old('tgl_periksa', now()->format('Y-m-d\TH:i')) }}"
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('tgl_periksa')" />
                        </div>

                        <div>
                            <x-input-label for="catatan" :value="__('Catatan Pemeriksaan')" />
                            <textarea id="catatan" name="catatan" rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Masukkan catatan hasil pemeriksaan...">{{ old('catatan') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('catatan')" />
                        </div>

                        <div>
                            <x-input-label for="biaya_periksa" :value="__('Biaya Periksa')" />
                            <!-- Hidden input for form submission -->
                            <input type="hidden" id="biaya_periksa" name="biaya_periksa"
                                value="{{ old('biaya_periksa', 150000) }}">
                            <!-- Display element for formatted price -->
                            <div id="biaya_periksa_display"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700 font-medium">
                                Rp 150.000
                            </div>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Biaya dihitung otomatis: Rp 150.000 (biaya dasar) + harga obat yang dipilih.') }}
                            </p>
                            <x-input-error class="mt-2" :messages="$errors->get('biaya_periksa')" />
                        </div>

                        <!-- Pilih Obat -->
                        <div>
                            <x-input-label :value="__('Pilih Obat')" />
                            <div class="mt-3 space-y-2 max-h-60 overflow-y-auto border border-gray-300 rounded-md p-3">
                                @foreach($obats as $obat)
                                <div class="flex items-center">
                                    <input type="checkbox" id="obat_{{ $obat->id }}" name="obat_ids[]"
                                        value="{{ $obat->id }}" data-harga="{{ $obat->harga }}"
                                        class="obat-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                        {{ in_array($obat->id, old('obat_ids', [])) ? 'checked' : '' }}>
                                    <label for="obat_{{ $obat->id }}" class="ml-2 block text-sm text-gray-900">
                                        {{ $obat->nama_obat }} - {{ $obat->kemasan }}
                                        <span class="text-gray-500">(Rp
                                            {{ number_format($obat->harga, 0, ',', '.') }})</span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('obat_ids')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Pemeriksaan') }}</x-primary-button>
                            <a href="{{ route('dokter.memeriksa.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const biayaPeriksaInput = document.getElementById('biaya_periksa');
        const biayaPeriksaDisplay = document.getElementById('biaya_periksa_display');
        const obatCheckboxes = document.querySelectorAll('.obat-checkbox');
        const baseBiaya = 150000; // Biaya periksa dasar

        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function updateBiayaPeriksa() {
            let totalBiaya = baseBiaya;

            obatCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    totalBiaya += parseInt(checkbox.dataset.harga);
                }
            });

            // Set the actual numeric value for form submission
            biayaPeriksaInput.value = totalBiaya;

            // Display formatted value
            biayaPeriksaDisplay.textContent = formatRupiah(totalBiaya);
        }

        // Set initial value
        updateBiayaPeriksa();

        // Add event listeners to all checkboxes
        obatCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', updateBiayaPeriksa);
        });
    });
    </script>
</x-app-layout>