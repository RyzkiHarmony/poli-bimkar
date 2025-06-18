<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detail Pemeriksaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Detail Riwayat Pemeriksaan') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Informasi lengkap mengenai pemeriksaan pasien.') }}
                            </p>
                        </div>
                        <a href="{{ route('dokter.memeriksa.history') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Kembali ke Riwayat') }}
                        </a>
                    </header>

                    <!-- Grid Layout -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                        <!-- Informasi Pasien dan Jadwal -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Informasi Pasien -->
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pasien</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Poliklinik</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ $janjiPeriksa->jadwalPeriksa->dokter->poli->nama_poli }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Keluhan</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $janjiPeriksa->keluhan }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                                            <p class="mt-1 text-sm text-gray-900 font-semibold">
                                                {{ $janjiPeriksa->pasien->name }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Hari
                                                Pemeriksaan</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ $janjiPeriksa->jadwalPeriksa->hari }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Tanggal
                                                Pemeriksaan</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($janjiPeriksa->periksa->tgl_periksa)->format('d/m/Y H:i') }}
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Detail Pemeriksaan -->
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Pemeriksaan</h3>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Catatan
                                                Pemeriksaan</label>
                                            <div class="mt-1 p-3 bg-gray-50 rounded-md border border-gray-300">
                                                <p class="text-sm text-gray-900">{{ $janjiPeriksa->periksa->catatan }}
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Biaya
                                                Pemeriksaan</label>
                                            <p class="mt-1 text-lg font-semibold text-green-600">Rp
                                                {{ number_format($janjiPeriksa->periksa->biaya_periksa, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar Kanan -->
                        <div class="lg:col-span-2 space-y-9">

                            <!-- Obat yang Diberikan -->
                            @if($janjiPeriksa->periksa->detailPeriksas &&
                            $janjiPeriksa->periksa->detailPeriksas->count() > 0)
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Obat yang Diberikan</h3>
                                    <div class="space-y-3">
                                        @foreach($janjiPeriksa->periksa->detailPeriksas as $detail)
                                        <div class="border border-gray-200 rounded-lg p-3">
                                            <h4 class="font-medium text-gray-900">{{ $detail->obat->nama_obat }}</h4>
                                            <p class="text-sm text-gray-600">{{ $detail->obat->kemasan }}</p>
                                            <p class="text-sm font-semibold text-green-600">
                                                Rp {{ number_format($detail->obat->harga, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </section>
    </div>
    </div>
    </div>
</x-app-layout>