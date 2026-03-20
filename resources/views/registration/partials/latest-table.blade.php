<div class="overflow-x-auto">
    <table class="table">
        <thead class="text-center">
            <tr>
                <th class="text-gray-500 uppercase">Tamu</th>
                <th class="text-gray-500 uppercase">Kamar</th>
                <th class="text-gray-500 uppercase">Check In</th>
                <th class="text-gray-500 uppercase">Check Out</th>
                <th class="text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentRegistrations as $reg)
                <tr class="hover:bg-gray-100">
                    <td>
                        {{ $reg->guest->name ?? 'N/A' }}
                    </td>
                    <td>{{ $reg->room->room_number ?? '-' }}
                        ({{ $reg->room->room_type ?? '-' }})</td>
                    <td>
                        {{ \Carbon\Carbon::parse($reg->arrival_time)->format('d M Y') }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($reg->departure_time)->format('d M Y') }}
                    </td>
                    <td class="text-center">
                        @if($reg->payment_status == 'Paid')
                            <span class="badge badge-success">
                                Lunas
                            </span>
                        @else
                            <span class="badge badge-error">
                                Belum Bayar
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-sm text-gray-500 italic">
                        Belum ada data registrasi terbaru.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
