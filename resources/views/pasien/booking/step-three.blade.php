<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Booking Online - Langkah 3: Pilih Jadwal untuk {{ $doctor->user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('pasien.booking.step-two', $doctor->poli_id) }}" class="text-sm text-indigo-600 hover:text-indigo-900 mb-4 inline-block">&larr; Kembali ke Pilih Dokter</a>

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('pasien.booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                        <div class="space-y-4">
                            @forelse ($available_dates as $item)
                                <div>
                                    <input type="radio" id="schedule_{{ $item['schedule_id'] }}_{{ $item['date'] }}" name="schedule_choice" value="{{ $item['schedule_id'] }}_{{ $item['date'] }}" class="hidden peer">
                                    <label for="schedule_{{ $item['schedule_id'] }}_{{ $item['date'] }}" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">{{ $item['dayName'] }}, {{ \Carbon\Carbon::parse($item['date'])->isoFormat('D MMMM YYYY') }}</div>
                                            <div class="w-full text-sm">Jam: {{ $item['time'] }}</div>
                                        </div>
                                    </label>
                                </div>
                            @empty
                                <p class="text-gray-600">Jadwal tidak tersedia untuk 7 hari ke depan.</p>
                            @endforelse
                        </div>

                        <input type="hidden" id="booking_date" name="booking_date">
                        <input type="hidden" id="schedule_id" name="schedule_id">

                        @if(count($available_dates) > 0)
                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" id="submit-button" class="px-4 py-2 bg-gray-800 text-white rounded-md font-semibold text-xs uppercase disabled:opacity-50" disabled>
                                Buat Janji Temu
                            </button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const radios = document.querySelectorAll('input[name="schedule_choice"]');
            const submitButton = document.getElementById('submit-button');
            const bookingDateInput = document.getElementById('booking_date');
            const scheduleIdInput = document.getElementById('schedule_id');

            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if(this.checked) {
                        const [scheduleId, bookingDate] = this.value.split('_');
                        scheduleIdInput.value = scheduleId;
                        bookingDateInput.value = bookingDate;
                        submitButton.disabled = false;
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>