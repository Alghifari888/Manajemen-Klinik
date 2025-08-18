<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="mb-4 rounded-md bg-red-50 p-4 text-sm text-red-700">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="user_id" class="block font-medium text-sm text-gray-700">Akun User Dokter</label>
                            <input type="text" id="user_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 bg-gray-100" value="{{ $doctor->user->name }} ({{ $doctor->user->email }})" disabled>
                            <p class="mt-2 text-sm text-gray-500">Akun user tidak dapat diubah.</p>
                        </div>

                        <div class="mt-4">
                            <label for="poli_id" class="block font-medium text-sm text-gray-700">Poli</label>
                            <select name="poli_id" id="poli_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>
                                 <option value="">Pilih Poli</option>
                                 @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}" {{ old('poli_id', $doctor->poli_id) == $poli->id ? 'selected' : '' }}>
                                        {{ $poli->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                         <div class="mt-4">
                            <label for="specialization" class="block font-medium text-sm text-gray-700">Spesialisasi</label>
                            <input type="text" name="specialization" id="specialization" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('specialization', $doctor->specialization) }}" required>
                        </div>

                         <div class="mt-4">
                            <label for="phone_number" class="block font-medium text-sm text-gray-700">Nomor HP</label>
                            <input type="text" name="phone_number" id="phone_number" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('phone_number', $doctor->phone_number) }}" required>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.doctors.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md font-semibold text-xs uppercase">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>