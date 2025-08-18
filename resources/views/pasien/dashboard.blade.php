<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2 text-gray-600">
                        Di bawah ini adalah riwayat dan status booking antrian Anda.
                    </p>
                </div>
            </div>

            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Riwayat Booking Anda</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Booking</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokter</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Poli</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Antrian</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($bookings as $booking)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($booking->booking_date)->isoFormat('dddd, D MMMM Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->doctor->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->doctor->poli->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap font-bold text-lg">{{ $booking->queue_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($booking->status == 'pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @elseif($booking->status == 'confirmed')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    Terkonfirmasi
                                                </span>
                                            @elseif($booking->status == 'completed')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Dibatalkan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if ($booking->status == 'completed' && $booking->medicalRecord)
                                                <a href="{{ route('pasien.riwayat.show', $booking->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    Lihat Detail
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                            Anda belum memiliki riwayat booking.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>