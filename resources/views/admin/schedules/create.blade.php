<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Jadwal Baru untuk Dr. ') }} {{ $doctor->user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="mb-4 rounded-md bg-red-50 p-4 text-sm text-red-700">
                            <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.doctors.schedules.store', $doctor->id) }}" method="POST">
                        @csrf
                        <div>
                            <label for="day_of_week" class="block font-medium text-sm text-gray-700">Hari</label>
                            <select name="day_of_week" id="day_of_week" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>
                                <option value="">Pilih Hari</option>
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                    <option value="{{ $day }}" {{ old('day_of_week') == $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="start_time" class="block font-medium text-sm text-gray-700">Jam Mulai</label>
                            <input type="time" name="start_time" id="start_time" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('start_time') }}" required>
                        </div>

                         <div class="mt-4">
                            <label for="end_time" class="block font-medium text-sm text-gray-700">Jam Selesai</label>
                            <input type="time" name="end_time" id="end_time" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('end_time') }}" required>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.doctors.schedules.index', $doctor->id) }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md font-semibold text-xs uppercase">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>