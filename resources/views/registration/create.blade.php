<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pendaftaran Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('registration.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-bold text-lg mb-4 border-b pb-2">Data Reservasi</h3>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Pilih Kamar</label>
                                <select name="room_id" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">-- Pilih Kamar Kosong --</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}">Kamar {{ $room->room_number }}
                                            ({{ $room->room_type }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Waktu Kedatangan</label>
                                <input type="datetime-local" name="arrival_time" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="arrival_time" :value="__('Arrival Time')" />
                                <x-text-input id="arrival_time" name="arrival_time" type="datetime-local"
                                    :value="old('arrival_time')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('arrival_time')" />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Tanggal Keluar (Check
                                    Out)</label>
                                <input type="date" name="departure_date" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="departure_date" :value="__('Tanggal Keluar (Check Out)')" />
                                <x-text-input id="departure_date" name="departure_date" type="date"
                                    :value="old('departure_date')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('departure_date')" />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Jumlah Orang</label>
                                <input type="number" name="no_of_person" value="1" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="no_of_person" :value="__('Jumlah Orang')" />
                                <x-text-input id="no_of_person" name="no_of_person" type="number"
                                    :value="old('no_of_person')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('no_of_person')" />
                            </div>
                        </div>

                        <div>
                            <h3 class="font-bold text-lg mb-4 border-b pb-2">Identitas Tamu</h3>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="name" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="name" :value="__('Nama Lengkap')" />
                                <x-text-input id="name" name="name" type="text" :value="old('name')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Profession</label>
                                <input type="text" name="profession" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="profession" :value="__('Profession')" />
                                <x-text-input id="profession" name="profession" type="text" :value="old('profession')"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('profession')" />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Company</label>
                                <input type="text" name="company" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="company" :value="__('Company')" />
                                <x-text-input id="company" name="company" type="text" :value="old('company')"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('company')" />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Nationality</label>
                                <input type="text" name="nationality" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="nationality" :value="__('Nationality')" />
                                <x-text-input id="nationality" name="nationality" type="text"
                                    :value="old('nationality')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nationality')" />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Birth Date</label>
                                <input type="date" name="birth_date" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="birth_date" :value="__('Birth Date')" />
                                <x-text-input id="birth_date" name="birth_date" type="date" :value="old('birth_date')"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">No. KTP / Passport</label>
                                <input type="text" name="id_card_number" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="id_card_number" :value="__('No. KTP / Passport')" />
                                <x-text-input id="id_card_number" name="id_card_number" type="text"
                                    :value="old('id_card_number')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('id_card_number')" />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                                <input type="text" name="phone" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                <x-input-label for="phone" :value="__('No. Telepon')" />
                                <x-text-input id="phone" name="phone" type="text" :value="old('phone')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <div class="mb-4">
                                {{-- <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                <textarea name="address" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea> --}}
                                <x-input-label for="address" :value="__('Alamat')" />
                                <x-text-input id="address" name="address" type="text" :value="old('address')"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>

                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        {{-- <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-black font-bold py-2 px-6 rounded">
                            Simpan Pendaftaran
                        </button> --}}
                        <x-primary-button>
                            Save Registration
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>