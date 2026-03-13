<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('registration.index') }}" class="text-blue-600 hover:underline flex items-center gap-1">
                    &larr; Kembali ke Daftar Tamu
                </a>
            </div>

            <div class="bg-white p-8 border border-gray-400 shadow-xl text-black">

                <div class="text-center mb-6">
                    <x-application-logo class="w-20 h-20 mx-auto mb-2 object-contain" />
                    <h1
                        class="font-bold text-xl uppercase tracking-wider rounded-full mx-auto mb-2 flex items-center justify-center">
                        PPKD Hotel</h1>
                    <h2 class="italic rounded-full mx-auto mb-2 flex items-center justify-center">Formulir Pendaftaran
                    </h2>
                    <h2 class="italic rounded-full mx-auto mb-2 flex items-center justify-center">Registration</h2>
                </div>

                <table class="w-full border-collapse border border-black text-sm mb-2">
                    <tr>
                        <td class="border border-black p-2 w-1/3 align-top">
                            <label class="block font-semibold">Room No.</label>
                            <div class="mt-1 text-lg font-bold">{{ $registration->room->room_number ?? '-' }}</div>
                        </td>
                        <td class="border border-black p-2 w-1/3 align-top">
                            <label class="block font-semibold">Jumlah Tamu <br><span class="text-xs font-normal">No. of
                                    Person</span></label>
                            <div class="mt-1 text-base">{{ $registration->no_of_person }} Orang</div>
                        </td>
                        <td rowspan="2" class="border border-black p-2 w-1/3 align-bottom text-center">
                            <div class="mt-8 font-bold text-lg uppercase">
                                {{ $registration->user->name ?? 'Resepsionis' }}</div>
                            <div class="border-t border-black mt-2">Receptionist</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 align-top">
                            <label class="block font-semibold">Jumlah Kamar <br><span class="text-xs font-normal">No. of
                                    Room</span></label>
                            <div class="mt-1 text-base">1</div>
                        </td>
                        <td class="border border-black p-2 align-top">
                            <label class="block font-semibold">Jenis Kamar <br><span class="text-xs font-normal">Room
                                    Type</span></label>
                            <div class="mt-1 text-base">{{ $registration->room->room_type ?? '-' }}</div>
                        </td>
                    </tr>
                </table>

                <div class="text-center font-bold text-sm my-4">
                    <p>Check Out Time : 12.00 Noon</p>
                    <p>Waktu Lapor Keluar : Jam 12.00 Siang</p>
                </div>

                <table class="w-full border-collapse border border-black text-sm">
                    <tr>
                        <td colspan="3" class="border border-black p-2 bg-gray-100 italic">
                            Harap tulis dengan huruf cetak — Please print in block letters
                        </td>
                        <td class="border border-black p-2 w-1/4 align-top">
                            <label class="block font-semibold">Waktu Kedatangan <br><span
                                    class="text-xs font-normal">Arrival Time</span></label>
                            <div class="mt-1">{{ date('H:i', strtotime($registration->arrival_time)) }} WIB</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="border border-black p-2 align-top">
                            <label class="block font-semibold">Nama <br><span
                                    class="text-xs font-normal">Name</span></label>
                            <div class="mt-1 font-bold text-lg uppercase">{{ $registration->guest->name ?? '-' }}</div>
                        </td>
                        <td rowspan="2" class="border border-black p-2 align-top">
                            <label class="block font-semibold">Tanggal Kedatangan <br><span
                                    class="text-xs font-normal">Arrival Date</span></label>
                            <div class="mt-1">{{ date('d / m / Y', strtotime($registration->arrival_time)) }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="border border-black p-2 align-top">
                            <label class="block font-semibold">Pekerjaan <br><span
                                    class="text-xs font-normal">Profession</span></label>
                            <div class="mt-1">{{ $registration->guest->profession ?? '-' }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="border border-black p-2 align-top">
                            <label class="block font-semibold">Perusahaan <br><span
                                    class="text-xs font-normal">Company</span></label>
                            <div class="mt-1">{{ $registration->guest->company ?? '-' }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 w-1/3 align-top">
                            <label class="block font-semibold">Kebangsaan <br><span
                                    class="text-xs font-normal">Nationality</span></label>
                            <div class="mt-1">{{ $registration->guest->nationality ?? 'Indonesia' }}</div>
                        </td>
                        <td class="border border-black p-2 w-1/3 align-top">
                            <label class="block font-semibold">No. KTP / Passport No.</label>
                            <div class="mt-1">{{ $registration->guest->id_card_number ?? '-' }}</div>
                        </td>
                        <td colspan="2" class="border border-black p-2 w-1/3 align-top">
                            <label class="block font-semibold">Tanggal Lahir <br><span class="text-xs font-normal">Birth
                                    Date</span></label>
                            <div class="mt-1">
                                {{ $registration->guest->birth_date ? date('d / m / Y', strtotime($registration->guest->birth_date)) : '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="border border-black p-2 align-top h-24">
                            <label class="block font-semibold">Alamat <br><span
                                    class="text-xs font-normal">Address</span></label>
                            <div class="mt-1">{{ $registration->guest->address ?? '-' }}</div>

                            <label class="block font-semibold mt-4">Email</label>
                            <div class="mt-1">{{ $registration->guest->email ?? '-' }}</div>
                        </td>
                        <td class="border border-black p-2 align-top">
                            <label class="block font-semibold">Telephone / Handphone</label>
                            <div class="mt-1">{{ $registration->guest->phone ?? '-' }}</div>
                        </td>
                        <td class="border border-black p-2 align-top">
                            <label class="block font-semibold text-red-700">Tgl Keberangkatan <br><span
                                    class="text-xs font-normal">Departure Date</span></label>
                            <div class="mt-1 text-red-700 font-bold">
                                {{ date('d / m / Y', strtotime($registration->departure_date)) }}</div>
                        </td>
                    </tr>
                </table>

<div class="flex justify-between items-center mb-4">
    <a href="{{ route('registration.index') }}" class="text-blue-600 hover:underline">
        &larr; Kembali
    </a>

    <a href="{{ route('registration.print', $registration->id) }}" target="_blank"
        class="bg-green-600 text-white px-4 py-2 rounded flex items-center gap-2 hover:bg-green-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
        </svg>
        Cetak Formulir
    </a>
</div>
            </div>
        </div>
    </div>
</x-app-layout>
