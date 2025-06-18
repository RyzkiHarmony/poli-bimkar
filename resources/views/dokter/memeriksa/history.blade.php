<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Riwayat Pemeriksaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Daftar Pasien yang Sudah Diperiksa') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Riwayat pemeriksaan pasien yang telah Anda tangani.') }}
                            </p>
                        </div>
                        <a href="{{ route('dokter.memeriksa.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Kembali ke Daftar Antrian') }}
                        </a>
                    </header>

                    @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                    @endif

                    <table class="table mt-6 overflow-hidden rounded table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No. Antrian</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col">Keluhan</th>
                                <th scope="col">Tanggal Periksa</th>
                                <th scope="col">Biaya</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($janjiPeriksas as $janjiPeriksa)
                            <tr>
                                <th scope="row" class="align-middle text-start">
                                    {{ $janjiPeriksa->no_antrian }}
                                </th>
                                <td class="align-middle text-start">
                                    {{ $janjiPeriksa->pasien->name }}
                                </td>
                                <td class="align-middle text-start">
                                    {{ $janjiPeriksa->keluhan }}
                                </td>
                                <td class="align-middle text-start">
                                    {{ $janjiPeriksa->periksa->tgl_periksa ? \Carbon\Carbon::parse($janjiPeriksa->periksa->tgl_periksa)->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td class="align-middle text-start">
                                    <span class="text-success fw-bold">
                                        Rp {{ number_format($janjiPeriksa->periksa->biaya_periksa, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="align-middle text-start">
                                    <a href="{{ route('dokter.memeriksa.detail', $janjiPeriksa->id) }}"
                                        class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada riwayat pemeriksaan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>