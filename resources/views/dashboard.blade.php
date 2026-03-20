<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard PPKD Hotel
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">WELCOME, {{ Auth::user()->name }}!</h3>
                    <p class="text-sm text-gray-500 mt-1">The following is a summary of today's PPKD Hotel operations.
                    </p>
                </div>
                <div>
                    <a href="{{ route('registration.create') ?? '#' }}"
                        class="bg-gray-900 hover:bg-gray-800 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                        + Tamu Baru
                    </a>
                </div>
            </div>

            <div class="stats bg-white w-full">
                <div class="stat">
                    <div class="stat-title text-neutral">Total Kamar</div>
                    <div class="stat-value text-neutral">{{ $totalRooms }}</div>
                </div>

                <div class="stat">
                    <div class="stat-title text-neutral">Kamar Tersedia</div>
                    <div class="stat-value text-neutral">{{ $availableRooms }}</div>
                </div>

                <div class="stat">
                    <div class="stat-title text-neutral">Kamar Terisi</div>
                    <div class="stat-value text-neutral">{{ $occupiedRooms }}</div>
                </div>

                <div class="stat">
                    <div class="stat-title text-neutral">Kamar Kotor</div>
                    <div class="stat-value text-neutral">{{ $dirtyRooms }}</div>
                </div>

                <div class="stat">
                    <div class="stat-title text-neutral">Belum Dibayar (Unpaid)</div>
                    <div class="stat-value text-neutral">{{ $unpaidRegistrations }}</div>
                </div>

                <div class="stat">
                    <div class="stat-title text-neutral">Total Pendapatan</div>
                    <div class="stat-value text-neutral">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="bg-white overflow-x-auto w-full">
                <div class="p-6 text-gray-900">
                    <h3 class="font-bold text-lg mb-4 text-gray-800">Registrasi Terbaru</h3>

                    @include('registration.partials.latest-table')

                    <div class="bg-white mt-4 text-right">
                        <a href="{{ route('registration.index') }}" class="btn btn-neutral btn-outline text-white">
                            Lihat Semua Data &rarr;
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>