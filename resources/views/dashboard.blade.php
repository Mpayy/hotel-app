{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
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

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500">Total Kamar</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalRooms }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500">Kamar Tersedia</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $availableRooms }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500">Belum Dibayar (Unpaid)</p>
                    <p class="text-3xl font-bold text-red-600 mt-2">{{ $unpaidRegistrations }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900">
                    <h3 class="font-bold text-lg mb-4 text-gray-800">Registrasi Terbaru</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Tamu</th>
                                    <th class="py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Kamar</th>
                                    <th class="py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Check In</th>
                                    <th class="py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($recentRegistrations as $reg)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="py-3 px-4 text-sm text-gray-900 font-medium">
                                            {{ $reg->guest->name ?? 'N/A' }}
                                        </td>
                                        <td class="py-3 px-4 text-sm text-gray-600">{{ $reg->room->room_number ?? '-' }}
                                            ({{ $reg->room->room_type ?? '-' }})</td>
                                        <td class="py-3 px-4 text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($reg->arrival_time)->format('d M Y') }}
                                        </td>
                                        <td class="py-3 px-4">
                                            @if($reg->payment_status == 'Paid')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Lunas
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Belum Bayar
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-sm text-gray-500 italic">
                                            Belum ada data registrasi terbaru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 text-right">
                        <a href="{{ route('registration.index') }}"
                            class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">
                            Lihat Semua Data &rarr;
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>