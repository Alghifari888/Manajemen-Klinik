<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Kunjungan Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="GET" action="{{ route('admin.reports.patients') }}" class="mb-6 flex items-end space-x-4">
                    </form>

                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Total Kunjungan Pasien ({{ \Carbon\Carbon::create()->month($month)->isoFormat('MMMM') }} {{ $year }})</p>
                    <p class="text-2xl">{{ $totalVisits }} Kunjungan</p>
                </div>

                <h3 class="text-lg font-medium mb-4">Detail Kunjungan</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>