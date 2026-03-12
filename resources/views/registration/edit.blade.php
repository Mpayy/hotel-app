<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pendaftaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('registration.update', $registration->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-bold text-lg mb-4 border-b pb-2">Data Reservasi</h3>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Pilih Kamar</label>
                                <select name="room_id" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">-- Pilih Kamar Kosong --</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}"
                                            {{ $room->id == $registration->room_id ? 'selected' : '' }}>
                                            Kamar {{ $room->room_number }} ({{ $room->room_type }})
                                            {{ $room->status == 'occupied' && $room->id == $registration->room_id ? ' - (Kamar Saat Ini)' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Waktu Kedatangan</label>
                                <input type="datetime-local" name="arrival_time"
                                    value="{{ $registration->arrival_time }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Tanggal Keluar (Check
                                    Out)</label>
                                <input type="date" name="departure_date" value="{{ $registration->departure_date }}"
                                    required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Jumlah Orang</label>
                                <input type="number" name="no_of_person" value="{{ $registration->no_of_person }}"
                                    required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>

                        <div>
                            <h3 class="font-bold text-lg mb-4 border-b pb-2">Identitas Tamu</h3>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $registration->guest->name }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Profession</label>
                                <input type="text" name="profession" value="{{ $registration->guest->profession }}"
                                    required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Company</label>
                                <input type="text" name="company" value="{{ $registration->guest->company }}"
                                    required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Nationality</label>
                                <input type="text" name="nationality"
                                    value="{{ $registration->guest->nationality }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Birth Date</label>
                                <input type="date" name="birth_date" value="{{ $registration->guest->birth_date }}"
                                    required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">No. KTP / Passport</label>
                                <input type="text" name="id_card_number"
                                    value="{{ $registration->guest->id_card_number }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                                <input type="text" name="phone" value="{{ $registration->guest->phone }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                <textarea name="address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $registration->guest->address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded">
                            Update Data
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
