<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Resepsionis/Kasir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
             @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Daftar Antrian Pasien Hari Ini ({{ \Carbon\Carbon::today()->isoFormat('D MMMM Y') }})</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Antrian</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pasien</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokter</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
    @forelse ($bookings as $booking)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap font-bold text-lg">{{ $booking->queue_number }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $booking->patient->user->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $booking->doctor->user->name }}</td>

            <td class="px-6 py-4 whitespace-nowrap">
                @if($booking->status == 'pending')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                @elseif($booking->status == 'confirmed')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Terkonfirmasi</span>
                @elseif($booking->status == 'completed')
                    @if($booking->payment)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 text-teal-800">Lunas</span>
                    @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai Diperiksa</span>
                    @endif
                @endif
            </td>
            
            <td class="px-6 py-4 whitespace-nowrap">
                @if ($booking->status == 'pending')
                    <form action="{{ route('kasir.booking.confirm', $booking->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-xs hover:bg-blue-700">
                            Konfirmasi Kedatangan
                        </button>
                    </form>
                @elseif ($booking->status == 'completed' && !$booking->payment)
                    <a href="{{ route('kasir.payment.create', $booking->id) }}" class="px-4 py-2 bg-green-600 text-white rounded-md text-xs hover:bg-green-700">
                        Proses Pembayaran
                    </a>
                @elseif ($booking->payment)
                    <a href="{{ route('kasir.payment.show', $booking->payment->id) }}" target="_blank" class="px-4 py-2 bg-gray-600 text-white rounded-md text-xs hover:bg-gray-700">
                        Cetak Kwitansi
                    </a>
                @else
                    <span class="text-sm text-gray-500">-</span>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                Tidak ada pasien booking untuk hari ini.
            </td>
        </tr>
    @endforelse
</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>