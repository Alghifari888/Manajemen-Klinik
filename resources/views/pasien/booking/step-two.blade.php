<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Booking Online - Langkah 2: Pilih Dokter di {{ $poli->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('pasien.booking.step-one') }}" class="text-sm text-indigo-600 hover:text-indigo-900 mb-4 inline-block">&larr; Kembali ke Pilih Poli</a>
                   <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($doctors as $doctor)
                            <a href="{{ route('pasien.booking.step-three', $doctor->id) }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $doctor->user->name }}</h5>
                                <p class="font-normal text-gray-700">{{ $doctor->specialization }}</p>
                            </a>
                        @empty
                            <p class="text-gray-600 col-span-full">Saat ini tidak ada dokter yang tersedia di poli ini.</p>
                        @endforelse
                   </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>