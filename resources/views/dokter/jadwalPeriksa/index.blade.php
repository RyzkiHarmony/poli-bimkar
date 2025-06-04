<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Jadwal') }}
                        </h2>
                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.jadwalPeriksa.create') }}" class="btn btn-primary">Tambah
                                Jadwal</a>

                            @if (session('status') === 'JadwalPeriksa-created')
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                {{ __('Created.') }}
                            </p>
                            @endif
                        </div>
                    </header>

                    <table class="table mt-6 overflow-hidden rounded table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Mulai</th>
                                <th scope="col">Selesai</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($JadwalPeriksas as $JadwalPeriksa)
                            <tr>
                                <th scope="row" class="align-middle text-start">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="align-middle text-start">
                                    {{ $JadwalPeriksa->hari }}
                                </td>
                                <td class="align-middle text-start">
                                    {{ \Carbon\Carbon::parse($JadwalPeriksa->jam_mulai)->format('H:i') }}
                                </td>
                                <td class="align-middle text-start">
                                    {{ \Carbon\Carbon::parse($JadwalPeriksa->jam_selesai)->format('H:i') }}
                                </td>
                                <td class="align-middle text-start">
                                    @if ($JadwalPeriksa->status)
                                    <span class="badge badge-pill text-white bg-success">Aktif</span>
                                    @else
                                    <span class="badge badge-pill text-white bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="align-middle text-start">
                                    <form action="{{ route('dokter.jadwalPeriksa.update', $JadwalPeriksa->id)}}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        @if ($JadwalPeriksa->status)
                                        <button type="submit" class="button btn-danger btn-sm">Nonaktifkan</button>
                                        @else
                                        <button type="submit" class="button btn-success btn-sm">Aktifkan</button>
                                        @endif
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>