<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Tamu Hotel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('registration.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                    + Registrasi Tamu Baru
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Room No (Type)</th>
                                <th class="border p-2">Name</th>
                                <th class="border p-2">Time & Date of Arrival</th>
                                <th class="border p-2">Departure Date</th>
                                <th class="border p-2">Officer</th>
                                <th class="border p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registrations as $reg)
                                <tr>
                                    <td class="border p-2">
                                        {{ $reg->room->room_number ?? '-' }}({{ $reg->room->room_type ?? '-' }})</td>
                                    <td class="border p-2">{{ $reg->guest->name ?? '-' }}</td>
                                    <td class="border p-2">{{ $reg->arrival_time }}</td>
                                    <td class="border p-2">{{ $reg->departure_date }}</td>
                                    <td class="border p-2">{{ $reg->user->name ?? '-' }}</td>
                                    <td class="border p-2 flex gap-2">
                                        <a href="{{ route('registration.show', $reg->id) }}"
                                            class="bg-blue-500 text-black px-3 py-1 rounded text-sm hover:bg-blue-600">Detail</a>
                                        <a href="{{ route('registration.edit', $reg->id) }}"
                                            class="bg-yellow-500 text-black px-3 py-1 rounded text-sm">Edit</a>
                                        <form action="{{ route('registration.destroy', $reg->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-black px-3 py-1 rounded text-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
