<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation - {{ $registration->guest->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS Khusus Print */
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background-color: white;
                -webkit-print-color-adjust: exact;
                /* Menjaga warna saat diprint */
            }

            .print-container {
                box-shadow: none !important;
                border: none !important;
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            /* Memaksa halaman baru jika konten terlalu panjang (opsional) */
            .page-break {
                page-break-after: always;
            }
        }

        /* Definisikan Font standar agar mirip dokumen resmi */
        body {
            font-family: 'Arial', sans-serif;
        }

        /* Trik untuk titik dua yang sejajar */
        .colon-separator::after {
            content: ":";
            position: absolute;
            right: 0;
        }
    </style>
</head>

<body class="bg-gray-100 py-10">

    <div class="max-w-4xl mx-auto no-print mb-6 flex justify-between items-center bg-white p-4 rounded shadow">
        <h1 class="text-xl font-bold text-gray-800">Preview Cetak Konfirmasi</h1>
        <div class="flex gap-2">
            <a href="{{ route('registration.show', $registration->id) }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                &larr; Kembali
            </a>
            <button onclick="window.print()"
                class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak / Simpan PDF
            </button>
        </div>
    </div>

    <div class="max-w-4xl mx-auto bg-white p-12 print-container shadow-2xl text-black" style="min-height: 297mm;">

        <div class="text-center mb-10 border-b-2 border-gray-300 pb-6">
            <x-application-logo class="w-20 h-20 mx-auto mb-2 object-contain" />
            <h1 class="font-bold text-2xl uppercase tracking-wider text-gray-900">PPKD Hotel</h1>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800">Reservation Confirmation</h2>
            <div class="w-full h-px bg-black mt-1"></div>
        </div>

        <div class="flex flex-col md:flex-row gap-8 mb-10 text-sm">
            <div class="flex-1 space-y-2">
                <div class="flex">
                    <span class="font-medium w-32 relative colon-separator">To.</span>
                    <span class="flex-1 pl-2 font-semibold text-base">{{ $registration->guest->name }}</span>
                </div>
                <div class="flex">
                    <span class="font-medium w-32 relative colon-separator">Company / Agent</span>
                    <span class="flex-1 pl-2">{{ $registration->guest->company ?? '-' }}</span>
                </div>
                <div class="flex">
                    <span class="font-medium w-32 relative colon-separator">Booking No.</span>
                    <span class="flex-1 pl-2 font-mono text-gray-600">REQ-{{ str_pad(
                        $registration->id,
                        5,
                        '0',
                        STR_PAD_LEFT
                    ) }}</span>
                </div>
                <div class="flex">
                    <span class="font-medium w-32 relative colon-separator">Book By</span>
                    <span class="flex-1 pl-2">{{ $registration->receptionist_name ?? $registration->user->name }}
                        (Hotel)</span>
                </div>
                <div class="flex">
                    <span class="font-medium w-32 relative colon-separator">Phone</span>
                    <span class="flex-1 pl-2">{{ $registration->guest->phone }}</span>
                </div>
                <div class="flex">
                    <span class="font-medium w-32 relative colon-separator">Email</span>
                    <span class="flex-1 pl-2 underline text-blue-700">{{ $registration->guest->email ?? '-' }}</span>
                </div>
            </div>

            <div class="w-full md:w-1/3 space-y-2 pt-6 md:pt-0 border-t md:border-t-0 border-gray-200">
                <div class="flex justify-between">
                    <span class="font-medium">Telp</span>
                    <span>: (021) 1234567</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Fax</span>
                    <span>: (021) 7654321</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Email</span>
                    <span class="underline text-blue-700">: info@ppkdhotel.com</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Date</span>
                    <span>: {{ date('d F Y', strtotime($registration->created_at)) }}</span>
                </div>
            </div>
        </div>

        <div class="w-full h-px bg-black mb-8"></div>

        <div class="space-y-4 mb-12 text-sm max-w-2xl">
            <div class="flex items-center">
                <span class="font-medium w-48 relative colon-separator">First Name</span>
                <span class="flex-1 pl-3 font-semibold text-base uppercase">{{ $registration->guest->name }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-medium w-48 relative colon-separator">Arrival Date</span>
                <span class="flex-1 pl-3 font-semibold">{{ date('d F Y', strtotime($registration->arrival_time))
                    }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-medium w-48 relative colon-separator">Departure Date</span>
                <span class="flex-1 pl-3 font-semibold">{{ date('d F Y', strtotime($registration->departure_date))
                    }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-medium w-48 relative colon-separator">Total Night</span>
                @php
                    $checkIn = \Carbon\Carbon::parse($registration->arrival_time);
                    $checkOut = \Carbon\Carbon::parse($registration->departure_date);
                    $nights = ceil($registration->arrival_time->diffInDays($registration->departure_date, false));
                @endphp
                <span class="flex-1 pl-3">{{ $nights }} Malam (Nights)</span>
            </div>
            <div class="flex items-center">
                <span class="font-medium w-48 relative colon-separator">Room/Unit Type</span>
                <span class="flex-1 pl-3">Kamar {{ $registration->room->room_number }} ({{
    $registration->room->room_type }})</span>
            </div>
            <div class="flex items-center">
                <span class="font-medium w-48 relative colon-separator">Person Pax</span>
                <span class="flex-1 pl-3">{{ $registration->no_of_person }} Orang (Person)</span>
            </div>
            <div class="flex items-center">
                <span class="font-medium w-48 relative colon-separator text-red-700">Room Rate Net</span>
                <span class="flex-1 pl-3 font-bold text-red-700">Rp
                    {{ number_format(($registration->room->price ?? 0) * $nights, 0, ',', '.') }} / Malam</span>
            </div>
        </div>

        <div class="border border-black p-5 text-sm mb-10 leading-relaxed bg-gray-50 rounded">
            <p class="font-medium mb-3">Please guarantee this booking with credit card number with clear copy of the
                card both sides and card holder signature in the column provided the copy of credit card both sides
                should be faxed to hotel fax number.</p>
            <p class="font-semibold text-red-800 mb-2">Please settle your outstanding to or account:</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 pl-4 border-l-4 border-blue-300">
                <div>
                    <span class="font-bold block">Bank Transfer</span>
                    <span class="block">Bank Mandiri (Cab. Jakarta)</span>
                </div>
                <div>
                    <span class="font-bold block">Mandiri Account</span>
                    <span class="block font-mono">123-00-9876543-2</span>
                </div>
                <div class="md:col-span-2">
                    <span class="font-bold block">Mandiri Name Account</span>
                    <span class="block uppercase">PPKD HOTEL JAKARTA PUSAT</span>
                </div>
            </div>
        </div>

        <div class="text-sm space-y-3 mb-12 max-w-lg">
            <p>Reservation guaranteed by the following credit card:</p>
            <div class="flex border-b border-gray-300 py-1">
                <span class="w-48 font-medium">Card Number</span>
                <span>: __________________________________</span>
            </div>
            <div class="flex border-b border-gray-300 py-1">
                <span class="w-48 font-medium">Card Holder name</span>
                <span>: __________________________________</span>
            </div>
            <div class="flex border-b border-gray-300 py-1">
                <span class="w-48 font-medium">Card Type</span>
                <span>: □ Visa □ Master □ Amex</span>
            </div>
            <div class="flex border-b border-gray-300 py-1">
                <span class="w-48 font-medium">Or by Bank Transfer to</span>
                <span>: __________________________________</span>
            </div>
            <div class="flex border-b border-gray-300 py-1">
                <span class="w-48 font-medium text-red-700">Expired date/month/year</span>
                <span>: _________ / _________ / _________</span>
            </div>
            <div class="flex pt-6">
                <span class="w-48 font-medium">Card holder signature</span>
                <span>: __________________________________</span>
            </div>
        </div>

        <div class="border-t border-black pt-6 text-xs text-gray-700 space-y-2 leading-tight bg-gray-100 p-4 rounded-b">
            <h4 class="font-bold text-sm text-black mb-2 decoration-solid underline">Cancellation policy:</h4>
            <ol class="list-decimal pl-5 space-y-1">
                <li>Please note that check in time is 02.00 pm and check out time 12.00 pm.</li>
                <li>All non guaranteed reservations will automatically be released on 6 pm.</li>
                <li>The Hotel will charge 1 night for guaranteed reservations that have not been canceling before the
                    day of arrival. Please carefully note your cancellation number.</li>
            </ol>
        </div>

    </div>

    <script>
        // Otomatis membuka jendela print saat halaman selesai dimuat (Opsional)
        window.onload = function () { window.print(); }
    </script>
</body>

</html>