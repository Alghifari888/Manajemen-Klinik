<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Riwayat Kunjungan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Informasi Kunjungan</h3>
                        <div class="mt-2 text-sm text-gray-600 grid grid-cols-2 gap-4">
                            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->isoFormat('dddd, D MMMM Y') }}</p>
                            <p><strong>Dokter:</strong> {{ $booking->doctor->user->name }}</p>
                            <p><strong>Poli:</strong> {{ $booking->doctor->poli->name }}</p>
                            <p><strong>No. Antrian:</strong> {{ $booking->queue_number }}</p>
                        </div>
                    </div>

                    <hr class="my-6">

                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Hasil Pemeriksaan</h3>
                        <div class="mt-4 space-y-4">
                            <div>
                                <h4 class="font-semibold text-gray-800">Keluhan Pasien:</h4>
                                <p class="text-gray-600 mt-1 pl-4 border-l-2">{{ $booking->medicalRecord->complaint }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Diagnosa Dokter:</h4>
                                <p class="text-gray-600 mt-1 pl-4 border-l-2">{{ $booking->medicalRecord->diagnosis }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Resep / Tindakan:</h4>
                                <p class="text-gray-600 mt-1 pl-4 border-l-2">{{ $booking->medicalRecord->prescription }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('pasien.dashboard') }}" class="px-4 py-2 bg-gray-800 text-white rounded-md font-semibold text-xs uppercase">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>