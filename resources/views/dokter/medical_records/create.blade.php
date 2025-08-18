<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Input Rekam Medis Pasien
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Data Pasien</h3>
                        <div class="mt-2 text-sm text-gray-600">
                            <p><strong>Nama:</strong> {{ $booking->patient->user->name }}</p>
                            <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($booking->patient->date_of_birth)->isoFormat('D MMMM Y') }}</p>
                            <p><strong>No. Antrian:</strong> {{ $booking->queue_number }}</p>
                        </div>
                    </div>
                    
                    <hr class="my-6">
                    
                    <form action="{{ route('dokter.medical-record.store', $booking->id) }}" method="POST">
                        @csrf
                        
                        <div class="mt-4">
                            <label for="complaint" class="block font-medium text-sm text-gray-700">Keluhan Pasien (Anamnesis)</label>
                            <textarea name="complaint" id="complaint" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>{{ old('complaint') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="diagnosis" class="block font-medium text-sm text-gray-700">Diagnosa Dokter</label>
                            <textarea name="diagnosis" id="diagnosis" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>{{ old('diagnosis') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="prescription" class="block font-medium text-sm text-gray-700">Resep / Tindakan</label>
                            <textarea name="prescription" id="prescription" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>{{ old('prescription') }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('dokter.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md font-semibold text-xs uppercase">
                                Simpan dan Selesaikan Pemeriksaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>