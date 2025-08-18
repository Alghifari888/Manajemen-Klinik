<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('📋 Manajemen Dokter') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Card Utama --}}
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-700">Daftar Dokter</h3>
                    
                    <a href="{{ route('admin.doctors.create') }}" 
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out">
                        ➕ Tambah Dokter
                    </a>
                </div>

                {{-- Alert Sukses --}}
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mx-6 mt-4 rounded-lg" role="alert">
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                {{-- Tabel Dokter --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama Dokter</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Poli</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Spesialisasi</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No. HP</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($doctors as $doctor)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $doctor->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $doctor->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $doctor->poli->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $doctor->specialization ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $doctor->phone_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-3">
                                        <a href="{{ route('admin.doctors.schedules.index', $doctor->id) }}" 
                                            class="text-green-600 hover:text-green-800 font-semibold">Jadwal</a>

                                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}" 
                                            class="text-indigo-600 hover:text-indigo-800 font-semibold">Edit</a>

                                        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokter ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="text-red-600 hover:text-red-800 font-semibold">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500 italic">
                                        Belum ada data dokter.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $doctors->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
