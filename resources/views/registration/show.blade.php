<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4 mt-4 flex justify-end">
                <a href="{{ route('registration.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    &larr; Back to Guest List
                </a>
            </div>

            <div class="bg-white p-8 border border-gray-400 shadow-xl text-black">

                <div class="text-center mb-6">
                    <x-application-logo class="w-20 h-20 mx-auto mb-2 object-contain" />
                    <h1
                        class="font-bold text-xl uppercase tracking-wider rounded-full mx-auto mb-2 flex items-center justify-center">
                        PPKD Hotel</h1>
                    <h2 class="italic rounded-full mx-auto mb-2 flex items-center justify-center">Registration</h2>
                </div>

                <table class="w-full border-collapse border border-black text-sm mb-2">
                    <tr>
                        <td class="border border-black p-2 w-1/3 align-top">
                            <label class="block font-semibold">Room No.</label>
                            <div class="mt-1 text-lg font-bold">{{ $registration->room->room_number ?? '-' }}</div>
                        </td>
                        <td class="border border-black p-2 w-1/3 align-top">
                            <label class="block font-semibold">No. of
                                Person</label>
                            <div class="mt-1 text-base">{{ $registration->no_of_person }} Person</div>
                        </td>
                        <td rowspan="2" class="border border-black p-2 w-1/3 align-bottom text-center">
                            <label class="block font-semibold">Officer</label>
                            <div class="mt-8 font-bold text-lg uppercase">
                                {{ $registration->user->name ?? '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 align-top">
                            <label class="block font-semibold">No. of
                                Room</label>
                            <div class="mt-1 text-base">1</div>
                        </td>
                        <td class="border border-black p-2 align-top">
                            <label class="block font-semibold">Room
                                Type</label>
                            <div class="mt-1 text-base">{{ $registration->room->room_type ?? '-' }}</div>
                        </td>
                    </tr>
                </table>

                <div class="text-center font-bold text-md mx-4">
                    <h1 class="italic rounded-full mx-auto mb-2 flex items-center justify-center">Check Out Time : 12.00
                        Noon</h1>
                </div>

                <table class="w-full border-collapse border border-black text-sm">
                    <tr>
                        <td colspan="3" class="border border-black p-2 bg-gray-100 italic">
                            Please print in block letters
                        </td>
                        <td class="border border-black p-2 w-1/4 align-top">
                            <label class="block font-semibold">Arrival Time</label>
                            <div class="mt-1">{{ date('H:i', strtotime($registration->arrival_time)) }} WIB</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="border border-black p-2 align-top">
                            <label class="block font-semibold">Name</label>
                            <div class="mt-1 font-bold text-lg uppercase">{{ $registration->guest->name ?? '-' }}</div>
                        </td>
                        <td rowspan="2" class="border border-black p-2 align-top">
                            <label class="block font-semibold">Arrival Date</label>
                            <div class="mt-1">{{ date('d / m / Y', strtotime($registration->arrival_time)) }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="border border-black p-2 align-top">
                            <label class="block font-semibold">Profession</label>
                            <div class="mt-1">{{ $registration->guest->profession ?? '-' }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="border border-black p-2 align-top">
                            <label class="block font-semibold">Company</label>
                            <div class="mt-1">{{ $registration->guest->company ?? '-' }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 w-1/3 align-top">
                            <label class="block font-semibold">Nationality</label>
                            <div class="mt-1">{{ $registration->guest->nationality ?? 'Indonesia' }}</div>
                        </td>
                        <td class="border border-black p-2 w-1/3 align-top">
                            <label class="block font-semibold">No. KTP / Passport No.</label>
                            <div class="mt-1">{{ $registration->guest->id_card_number ?? '-' }}</div>
                        </td>
                        <td colspan="2" class="border border-black p-2 w-1/3 align-top">
                            <label class="block font-semibold">Birth Date</label>
                            <div class="mt-1">
                                {{ $registration->guest->birth_date ? date('d / m / Y', strtotime($registration->guest->birth_date)) : '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="border border-black p-2 align-top h-24">
                            <label class="block font-semibold">Address</label>
                            <div class="mt-1">{{ $registration->guest->address ?? '-' }}</div>

                            <label class="block font-semibold mt-4">Email</label>
                            <div class="mt-1">{{ $registration->guest->email ?? '-' }}</div>
                        </td>
                        <td class="border border-black p-2 align-top">
                            <label class="block font-semibold">Telephone / Handphone</label>
                            <div class="mt-1">{{ $registration->guest->phone ?? '-' }}</div>
                        </td>
                        <td class="border border-black p-2 align-top">
                            <label class="block font-semibold text-red-700">Departure Date</label>
                            <div class="mt-1 text-red-700 font-bold">
                                {{ date('d / m / Y', strtotime($registration->departure_date)) }}
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="mb-4 mt-4 flex justify-end">
                    <a href="{{ route('registration.print', $registration->id) }}" target="_blank"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Print Form
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>