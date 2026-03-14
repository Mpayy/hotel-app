<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('registration.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                    + New Guest Registration
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
                                <th class="border p-2">Payment Status</th>
                                <th class="border p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registrations as $reg)
                                <tr>
                                    <td class="border p-2">
                                        {{ $reg->room->room_number ?? '-' }}({{ $reg->room->room_type ?? '-' }})
                                    </td>
                                    <td class="border p-2">{{ $reg->guest->name ?? '-' }}</td>
                                    <td class="border p-2">{{ $reg->arrival_time }}</td>
                                    <td class="border p-2">{{ $reg->departure_date }}</td>
                                    <td class="border p-2">{{ $reg->user->name ?? '-' }}</td>
                                    <td class="border p-2">
                                        @if($reg->payment_status == 'Paid')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-md">Paid</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-md">Unpaid</span>
                                        @endif
                                    </td>
                                    <td class="border p-4 flex gap-2">
                                        <a href="{{ route('registration.show', $reg->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Detail</a>
                                        <a href="{{ route('registration.edit', $reg->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Edit</a>
                                        <form action="{{ route('registration.destroy', $reg->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            {{-- <button type="submit"
                                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Delete</button> --}}
                                            <x-danger-button>
                                                Delete
                                            </x-danger-button>
                                        </form>
                                        <a href="{{ route('payments.create', $reg->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Paid
                                        </a>
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