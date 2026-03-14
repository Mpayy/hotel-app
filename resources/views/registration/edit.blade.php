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
                                        <option value="{{ $room->id }}" {{ $room->id == $registration->room_id ? 'selected' : '' }}>
                                            Kamar {{ $room->room_number }} ({{ $room->room_type }})
                                            {{ $room->status == 'occupied' && $room->id == $registration->room_id ? ' - (Kamar Saat Ini)' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Waktu Kedatangan</label>
                                <input type="datetime-local" name="arrival_time"
                                    value="{{ $registration->arrival_time }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="arrival_time" :value="__('Arrival Time')" />
                                <x-text-input id="arrival_time" type="datetime-local"
                                    name="arrival_time" :value="old('arrival_time', $registration->arrival_time)"
                                    required />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Tanggal Keluar (Check
                                    Out)</label>
                                <input type="date" name="departure_date" value="{{ $registration->departure_date }}"
                                    required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="departure_date" :value="__('Departure Date')" />
                                <x-text-input id="departure_date" type="date"
                                    name="departure_date" :value="old('departure_date', $registration->departure_date)"
                                    required />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Jumlah Orang</label>
                                <input type="number" name="no_of_person" value="{{ $registration->no_of_person }}"
                                    required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="no_of_person" :value="__('Number of Person')" />
                                <x-text-input id="no_of_person" type="number"
                                    name="no_of_person" :value="old('no_of_person', $registration->no_of_person)"
                                    required />
                            </div>
                        </div>

                        <div>
                            <h3 class="font-bold text-lg mb-4 border-b pb-2">Identitas Tamu</h3>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $registration->guest->name }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" type="text" name="name"
                                    :value="old('name', $registration->guest->name)" required />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Profession</label>
                                <input type="text" name="profession" value="{{ $registration->guest->profession }}"
                                    required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="profession" :value="__('Profession')" />
                                <x-text-input id="profession" type="text"
                                    name="profession" :value="old('profession', $registration->guest->profession)"
                                    required />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Company</label>
                                <input type="text" name="company" value="{{ $registration->guest->company }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="company" :value="__('Company')" />
                                <x-text-input id="company" type="text"
                                    name="company" :value="old('company', $registration->guest->company)" required />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Nationality</label>
                                <input type="text" name="nationality" value="{{ $registration->guest->nationality }}"
                                    required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="nationality" :value="__('Nationality')" />
                                <x-text-input id="nationality" type="text"
                                    name="nationality" :value="old('nationality', $registration->guest->nationality)"
                                    required />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Birth Date</label>
                                <input type="date" name="birth_date" value="{{ $registration->guest->birth_date }}"
                                    required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="birth_date" :value="__('Birth Date')" />
                                <x-text-input id="birth_date" type="date"
                                    name="birth_date" :value="old('birth_date', $registration->guest->birth_date)"
                                    required />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">No. KTP / Passport</label>
                                <input type="text" name="id_card_number"
                                    value="{{ $registration->guest->id_card_number }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="id_card_number" :value="__('ID Card Number')" />
                                <x-text-input id="id_card_number" type="text"
                                    name="id_card_number" :value="old('id_card_number', $registration->guest->id_card_number)"
                                    required />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                                <input type="text" name="phone" value="{{ $registration->guest->phone }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="phone" :value="__('Phone Number')" />
                                <x-text-input id="phone" type="text" name="phone"
                                    :value="old('phone', $registration->guest->phone)" required />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                <textarea name="address" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $registration->guest->address }}</textarea> --}}
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input id="address" type="text" name="address"
                                    :value="old('address', $registration->guest->address)" required />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 gap-4">
                        <a href="{{ route('registration.index') }}"
                            class="text-gray-600 hover:underline text-sm">Cancel</a>
                        {{-- <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded">
                            Update Data
                        </button> --}}
                        <x-primary-button>
                            Update Data
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>