<x-layout>
    @include('teachers._header')
    @include('teachers._nav')

    <x-containers.main>
        <x-content-header>MODULE MONITORING</x-content-header>

        <div class="w-11/12 mx-auto">
            <div x-data="{ open: false }" class="relative">
                <button
                    class="rounded-md border border-gray-300 bg-gray-100 text-blue-900 font-semibold px-5 py-1 flex items-center space-x-10 w-max"
                    @click="open = !open"
                >
                    <span>{{ request('schedule') ? \App\Models\Schedule::firstWhere('id', request('schedule'))->subject->name . ' | ' . \App\Models\Schedule::firstWhere('id', request('schedule'))->room->section->gradeAndSection() : 'SELECT SUBJECT' }}</span>
                    <x-icons.down-arrow class="w-5 h-5"/>
                </button>

                <div
                    class="border border-gray-300 mt-1 rounded-md bg-gray-100 absolute w-full sm:w-96"
                    x-show="open"
                    @click.away="open = false"
                >
                    @forelse($schedules as $schedule)
                        <a href="{{ route('teacher.modules.monitor') }}?schedule={{$schedule->id}}" class="text-blue-900 text-center">
                            <div class="p-2 hover:text-white hover:bg-blue-600 font-medium {{ $loop->odd ? 'border-b border-gray-300' : '' }} {{ $loop->first ? 'rounded-tl-md rounded-tr-md' : '' }} {{ $loop->last ? 'rounded-bl-md rounded-br-md' : '' }}">
                                <span>{{ $schedule->subject->name }}</span>
                                <span class="font-light">|</span>
                                <span class="italic">{{ $schedule->room->section->gradeAndSection() }}</span>
                            </div>
                        </a>
                    @empty

                    @endforelse
                </div>
            </div>
        </div>

        <div class="sm:w-1/2 mx-auto mt-5">
            <p class="text-center text-blue-900 font-medium">Student Module Submission Chart</p>
            <canvas id="studentsChart"></canvas>
        </div>
    </x-containers.main>

    <script>
        let studentsChart = document.getElementById('studentsChart').getContext('2d');
        let studentsBarChart = new Chart(studentsChart, {
            type: 'bar',
            data: {
                labels: ['Students with Submission', 'Students without Submission'],
                datasets: [
                    {
                        labels: [],
                        data: [
                            {{ $modules }},
                            {{ ($students - $modules) }}
                        ],
                        backgroundColor: ['#1E3A8A', '#2563EB']
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            precision: 0,
                        }
                    }
                }
            }
        });
    </script>
</x-layout>
