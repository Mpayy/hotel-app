<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Room Status') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="overflow-x-auto bg-white rounded-box shadow">
                <table class="table table-zebra w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th>No Kamar</th>
                            <th>Tipe & Harga</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                            <tr class="hover:bg-gray-100">
                                <td class="font-bold text-lg">{{ $room->room_number }}</td>
                                <td>
                                    <div class="flex flex-col">
                                        <span class="font-semibold uppercase text-xs">{{ $room->room_type }}</span>
                                        <span class="text-gray-500">Rp {{ number_format($room->price, 0, ',', '.') }} /
                                            night</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-center">
                                    <x-room-status-badge :status="$room->status" />
                                </td>
                                <td class="py-2 px-4">
                                    @if($room->status == \App\Models\Room::STATUS_DIRTY)
                                        <form action="{{ route('rooms.clean', $room->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="badge badge-warning">
                                                Selesai Dibersihkan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-xs">Tidak ada aksi</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $rooms->links() }}
            </div>
        </div>
    </div>

</x-app-layout>