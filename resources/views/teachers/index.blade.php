<x-layout>

    @include('teachers._header')
    @include('teachers._nav')

    <x-containers.main>

        <div class="border-b pb-1 border-gray-300">
            <h3 class="text-blue-900 font-semibold">Latest Module Submitted</h3>

            @if($latestModule)
                @if ($latestModule->count() === 0)

                @else
                    <div class="flex flex-col my-3">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr class="bg-blue-600 w-full">
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                File Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Uploaded By
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Subject
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Grade & Section
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Upload Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Comments
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Module Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">

                                        <tr x-data="{ show: false }">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-medium font-primary text-blue-900">
                                                            <p class="{{ empty($latestModule->getFirstMedia()->file_name) ? 'bg-gray-600 text-white py-1 px-3 rounded-full' : '' }}">{{ $latestModule->getFirstMedia()->file_name ?? 'File Submitted Offline' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-medium font-primary text-blue-900">
                                                            {{ $latestModule->user->fullname() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-medium font-primary text-blue-900">
                                                            {{ $latestModule->schedule->subject->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-medium font-primary text-blue-900">
                                                            {{ $latestModule->schedule->room->section->gradeAndSection() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-blue-900">
                                                            {{ $latestModule->created_at ?? 'Not Available' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-blue-900">
                                                            <p>{!! $latestModule->status() !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-gray-900">
                                                            <div>
                                                                <a href="{{ route('teacher.modules.comment', [$latestModule->schedule_id, $latestModule->id]) }}" class="flex items-center space-x-1 underline">
                                                                    <div>
                                                                        <x-icons.add class="w-5 h-5"/>
                                                                    </div>
                                                                    <span>Add Comment</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-blue-900 hover:text-blue-800">
                                                            <div class="flex space-x-5">
                                                                <div class="border-r-2 pr-5 border-gray-300">
                                                                    <a
                                                                        href="{{ empty($latestModule->getFirstMedia()) ? '' : route('teacher.modules.downloadModule', $latestModule->id) }}"
                                                                        class="flex items-center space-x-1 {{ empty($latestModule->getFirstMedia()) ? 'text-gray-500' : '' }}"
                                                                    >
                                                                        <x-icons.add-file class="h-5 w-5"/>
                                                                        <span>Download Module</span>
                                                                    </a>
                                                                </div>
                                                                <div x-data="{ open: false }">
                                                                    <button
                                                                        class="flex items-center space-x-1 text-green-600 font-medium"
                                                                        @click="open = true"
                                                                        type="button"
                                                                    >
                                                                        <x-icons.check class="h-5 w-5"/>
                                                                        <span>Set as Checked</span>
                                                                    </button>

                                                                    <div
                                                                        class="absolute bg-gray-50 p-3 border border-gray-300 rounded-md -mt-6 right-8"
                                                                        x-show="open"
                                                                    >
                                                                        <p>Do you want to set this as checked?</p>

                                                                        <form
                                                                            action="{{ route('teacher.modules.check', [$latestModule->schedule_id, $latestModule->id]) }}"
                                                                            class="space-x-2 mt-2"
                                                                            method="POST"
                                                                        >
                                                                            @csrf
                                                                            @method('PATCH')

                                                                            <button
                                                                                class="text-white py-1 px-3 rounded-full {{ $latestModule->status == 1 ? 'bg-gray-600' : 'bg-blue-600' }}"
                                                                                type="{{ $latestModule->status == 1 ? 'button' : 'submit' }}"
                                                                            >
                                                                                Confirm
                                                                            </button>

                                                                            <button
                                                                                type="button"
                                                                                class="bg-gray-600 text-white py-1 px-3 rounded-full"
                                                                                @click="open = false"
                                                                            >
                                                                                Cancel
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="mt-5 w-1/3">
                    <div class="border border-gray-400 p-2 rounded-lg">
                        <x-icons.warning class="w-6 h-6 mx-auto text-gray-600"/>
                        <p class="text-gray-600 text-center">
                            There are no modules submitted yet.
                        </p>
                    </div>
                </div>
            @endif
        </div>

        <div class="mt-5 border-b border-gray-300">
            <h3 class="text-blue-900 font-semibold">Latest Answer Submitted</h3>

        @if($latestAnswer)
                @if ($latestAnswer->count() === 0)
                @else
                    <div class="flex flex-col my-3">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr class="bg-blue-600 w-full">
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Submitted By
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Subject
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Grade & Section
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Grade Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Submitted Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Submission Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">

                                            <tr x-data="{ show: false }">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-medium font-primary text-blue-900">
                                                                {{ $latestAnswer->student->fullname() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-medium font-primary text-blue-900">
                                                                {{ $latestAnswer->assignment->schedule->subject->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-medium font-primary text-blue-900">
                                                                {{ $latestAnswer->assignment->schedule->room->section->gradeAndSection() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                <p class="text-sm font-medium text-white py-1 px-5 rounded-full {{ $latestAnswer->status === 0 ? 'bg-blue-600' : 'bg-green-600' }}">
                                                                    {{ $latestAnswer->status === 0 ? 'Submitted for Grading' : 'Graded' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                {{ $latestAnswer->created_at }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                {!! $latestAnswer->submissionStatus() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                <div>
                                                                    <div>
                                                                        <a href="{{ route('teacher.answers.show', [$latestAnswer->assignment->schedule->id, $latestAnswer->assignment->id, $latestAnswer->id]) }}" class="flex items-center space-x-1 text-blue-600">
                                                                            <x-icons.eye class="w-5 h-5"/>
                                                                            <span>View Answer</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="mt-5 w-1/3 pb-1">
                    <div class="border border-gray-400 p-2 rounded-lg">
                        <x-icons.warning class="w-6 h-6 mx-auto text-gray-600"/>
                        <p class="text-gray-600 text-center">
                            There are no answers submitted yet.
                        </p>
                    </div>
                </div>
            @endif
        </div>

        <div class="mt-20 border-b border-gray-400 pb-5">
            <h3 class="text-blue-900 font-semibold text-center mb-3">Total Number of Module Submitted per Subject</h3>

            <div class="w-1/3 mx-auto">
                @if($schedules->count() === 0 || $modules->count() === 0)
                    <div class="border border-gray-400 p-2 rounded-lg">
                        <x-icons.warning class="w-6 h-6 mx-auto text-gray-600"/>
                        <p class="text-gray-600 text-center">
                            There are no schedules or modules submitted on this class.
                        </p>
                    </div>
                @else
                    <canvas id="totalModules"></canvas>
                @endif
            </div>
        </div>

        <div class="my-10 border-b pb-3 border-gray-400">
            <x-content-header class="">Teacher Panel</x-content-header>

            <div class="flex-col space-y-5">
                <div class="flex space-x-5 flex-1">
                    <div class="border border-gray-300 flex-1">
                        <p class="bg-blue-600 py-1 px-2 text-white font-semibold border-l-8 border-blue-900">
                            MODULE MONITORING
                        </p>

                        <a href="{{ route('teacher.modules.monitor') }}" class="hover:bg-blue-100">
                            <div class="p-5 hover:bg-blue-100 text-blue-900">
                                <p class="text-center">View Module Monitoring Information</p>
                                <x-icons.chart class="h-6 w-6 mx-auto" />
                            </div>
                        </a>
                    </div>

                    <div class="border border-gray-300 flex-1">
                        <p class="bg-blue-600 py-1 px-2 text-white font-semibold border-l-8 border-blue-900">
                            CLASS ACTIONS
                        </p>

                        <a href="{{ route('teacher.rooms.show', auth()->user()->room->id) }}" class="hover:bg-blue-100">
                            <div class="p-5 hover:bg-blue-100 text-blue-900">
                                <p class="text-center">My Advisory Class</p>
                                <x-icons.building class="h-6 w-6 mx-auto" />
                            </div>
                        </a>
                    </div>

                    <div class="border border-gray-300 flex-1">
                        <p class="bg-blue-600 py-1 px-2 text-white font-semibold border-l-8 border-blue-900">
                            SUBJECT ACTIONS
                        </p>

                        <a href="{{ route('teacher.schedules.index') }}" class="hover:bg-blue-100">
                            <div class="p-5 hover:bg-blue-100 text-blue-900">
                                <p class="text-center">View All Subjects</p>
                                <x-icons.bookmark-orig class="h-6 w-6 mx-auto" />
                            </div>
                        </a>
                    </div>
                </div>

                <div class="flex space-x-5">
                    <div class="border border-gray-300 flex-1">
                        <p class="bg-blue-600 py-1 px-2 text-white font-semibold border-l-8 border-blue-900">
                            STUDENT ACTIONS
                        </p>

                        <div class="flex">
                            <a href="{{ route('teacher.students.createByFile', auth()->user()->room->id) }}" class="hover:bg-blue-100 flex-1 border-r">
                                <div class="p-5 hover:bg-blue-100 text-blue-900">
                                    <p class="text-center">Enroll Student by File Upload</p>
                                    <x-icons.upload class="h-6 w-6 mx-auto" />
                                </div>
                            </a>

                            <a href="{{ route('teacher.students.createByForm', auth()->user()->room->id) }}" class="hover:bg-blue-100 flex-1">
                                <div class="p-5 hover:bg-blue-100 text-blue-900">
                                    <p class="text-center">Enroll Student by Form</p>
                                    <x-icons.pen class="h-6 w-6 mx-auto" />
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="border border-gray-300 flex-1">
                        <p class="bg-blue-600 py-1 px-2 text-white font-semibold border-l-8 border-blue-900">
                            MODULE ACTIONS
                        </p>

                        <a href="{{ route('teacher.modules.scan') }}" class="hover:bg-blue-100">
                            <div class="p-5 hover:bg-blue-100 text-blue-900">
                                <p class="text-center">Receive Module via QRCODE</p>
                                <x-icons.qrcode class="h-6 w-6 mx-auto" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </x-containers.main>

    <script>
        let schedules = @json($schedules);

        let totalModules = document.getElementById('totalModules').getContext('2d');
        let totalModulesChart = new Chart(totalModules, {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [
                    {
                        labels: [],
                        data: [],
                        backgroundColor: ['#1E3A8A', '#2563EB', '#25bdeb', '#60a1e0']
                    }
                ]
            },
        })


            schedules.forEach(schedule => {
                totalModulesChart.data.labels.push(schedule.subject.name + ' | ' + schedule.room.grade.name + ' - ' + schedule.room.section.name);
                totalModulesChart.data.datasets[0].data.push(schedule.modules.length)
            });


        totalModulesChart.update();

    </script>
</x-layout>
