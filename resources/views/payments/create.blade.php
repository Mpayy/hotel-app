<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proses Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <div class="grid grid-cols-2 gap-4 mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200 text-sm">
                    <div>
                        <p class="text-gray-500">Nama Tamu:</p>
                        <p class="font-bold text-lg text-gray-900">{{ $registration->guest->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Nomor Kamar:</p>
                        <p class="font-bold text-lg text-gray-900">{{ $registration->room->room_number }} ({{
                            $registration->room->room_type }})</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Durasi Menginap:</p>
                        <p class="font-semibold">{{ $nights }} Malam</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Harga per Malam:</p>
                        <p class="font-semibold">Rp {{ number_format($registration->room->price, 0, ',', '.') }}</p>
                    </div>
                </div>

                <form action="{{ route('payments.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="registration_id" value="{{ $registration->id }}">

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Total Tagihan (Rp)</label>
                        <input type="number" name="total_bill" id="total_bill" value="{{ $totalBill }}"
                            class="w-full mt-1 bg-gray-100 border-gray-300 rounded-md shadow-sm font-bold text-xl text-blue-700"
                            readonly>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Jumlah Uang Dibayar (Rp)</label>
                            <input type="number" name="amount_paid" id="amount_paid" required
                                class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-xl"
                                placeholder="Masukkan nominal...">
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Kembalian (Rp)</label>
                            <input type="text" id="display_balance" value="0"
                                class="w-full mt-1 bg-gray-50 border-gray-300 rounded-md shadow-sm font-bold text-xl text-green-600"
                                readonly>
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Metode Pembayaran</label>
                        <select name="payment_method" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            <option value="Cash">Cash (Tunai)</option>
                            <option value="Transfer">Bank Transfer</option>
                            <option value="Debit">Kartu Debit/Kredit</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-6 gap-4">
                        <a href="{{ route('registration.index') }}"
                            class="text-gray-600 hover:underline text-sm">Batal</a>
                        <x-primary-button class="bg-green-600 hover:bg-green-700">
                            {{ __('Simpan Pembayaran & Selesaikan') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        const totalBillInput = document.getElementById('total_bill');
        const amountPaidInput = document.getElementById('amount_paid');
        const displayBalanceInput = document.getElementById('display_balance');

        amountPaidInput.addEventListener('input', function() {
            const total = parseInt(totalBillInput.value) || 0;
            const paid = parseInt(amountPaidInput.value) || 0;
            const balance = paid - total;

            // Tampilkan kembalian (jika minus berarti kurang, tampilkan 0 atau minus)
            displayBalanceInput.value = new Intl.NumberFormat('id-ID').format(balance);
            
            // Beri warna merah jika kurang, hijau jika cukup
            if (balance < 0) {
                displayBalanceInput.classList.remove('text-green-600');
                displayBalanceInput.classList.add('text-red-600');
            } else {
                displayBalanceInput.classList.remove('text-red-600');
                displayBalanceInput.classList.add('text-green-600');
            }
        });
    </script>
</x-app-layout>