<x-layout>
    @include('students/_header')
    @include('students/_nav')

    <x-containers.main>
        <x-content-header>PROGRESS REPORT</x-content-header>

        <div x-data="{ open: false }" class="relative">
            <button
                class="rounded-md border border-gray-300 bg-gray-100 text-blue-900 font-semibold px-5 py-1 flex items-center space-x-10 w-max"
                @click="open = !open"
            >
                <span>
                    {{ request('section') ? \App\Models\Schedule::firstWhere('id', request('section'))->subject->name . ' | ' . \App\Models\Schedule::firstWhere('id', request('section'))->room->section->gradeAndSection() : 'SELECT SUBJECT' }}
                </span>
                <x-icons.down-arrow class="w-5 h-5"/>
            </button>

            <div
                class="border border-gray-300 mt-1 rounded-md bg-gray-100 absolute w-full sm:w-96"
                x-show="open"
                @click.away="open = false"
            >
                                @forelse($schedules as $schedule)
                <a href="{{ route('student.reports.index') }}?section={{ $schedule->id }}" class="text-blue-900 text-center">
                    <div class="p-2 hover:text-white hover:bg-blue-600 font-medium ">
                                                    <span>{{ $schedule->subject->name }}</span>
                                                    <span class="font-light">|</span>
                                                    <span class="italic">{{ $schedule->room->section->gradeAndSection() }}</span>
                    </div>
                </a>
                                @empty

                                @endforelse
            </div>
        </div>

        <div class="w-11/12 mx-auto mt-10">
            <h3 class="text-blue-900 font-semibold mb-8">Modules To Be Submitted</h3>

            @if($incompleteModules)
                @if ($incompleteModules->count() === 0)
                    <div class="border-4 border-green-500 inline p-5 rounded-md">
                        <span class="text-green-600 font-semibold">Good Job! You do not have pending modules in this subject.</span>
                    </div>
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
                                                Upload Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Module Actions
                                            </th>
                                        </tr>
                                        </thead>

                                        @foreach($incompleteModules as $module)
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            <tr x-data="{ show: false }">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-medium font-primary text-blue-900">
                                                                <p class="{{ empty($module->getFirstMedia()->file_name) ? 'bg-gray-600 text-white py-1 px-3 rounded-full' : '' }}">{{ $module->getFirstMedia()->file_name ?? 'File Submitted Offline' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-medium font-primary text-blue-900">
                                                                {{ $module->user->fullname() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-medium font-primary text-blue-900">
                                                                {{ $module->schedule->subject->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                {{ $module->created_at ?? 'Not Available' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900 hover:text-blue-800">
                                                                <div class="flex space-x-5">
                                                                    <div class="pr-5">
                                                                        <a
                                                                            href="{{ empty($module->getFirstMedia()) ? '' : route('student.modules.download', [$module->schedule_id, $module->id]) }}"
                                                                            class="flex items-center space-x-1 {{ empty($module->getFirstMedia()) ? 'text-gray-500' : '' }}"
                                                                        >
                                                                            <x-icons.add-file class="h-5 w-5"/>
                                                                            <span>Download Module</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="mt-5 sm:w-1/3">
                    <div class="border border-gray-400 p-2 rounded-lg">
                        <x-icons.warning class="w-6 h-6 mx-auto text-gray-600"/>
                        <p class="text-gray-600 text-center">
                            Please select a subject first.
                        </p>
                    </div>
                </div>
            @endif

{{--    Assignments     --}}

            <h3 class="text-blue-900 font-semibold mb-8 mt-8">Assignments To Be Submitted</h3>

            @if($incompleteAssignments)
                @if ($incompleteAssignments->count() === 0)
                    <div class="border-4 border-green-500 inline p-5 rounded-md">
                        <span class="text-green-600 font-semibold">Good Job! You do not have pending assignments in this subject.</span>
                    </div>
                @else
                    <div class="flex flex-col mb-10">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr class="bg-blue-600 w-full">
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Title
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Published Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Due Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Assignment Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Answer Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Grades
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Assignment Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">

                                        @foreach ($incompleteAssignments as $assignment)

                                            <tr x-data="{ show: false }">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-medium font-primary text-blue-900">
                                                                {{ $assignment->title }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                {{ $assignment->convertDateTime($assignment->created_at) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                {{ $assignment->convertDateTime($assignment->expired_at) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                {!! $assignment->remainingTime() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                @if (\App\Models\Answer::where('assignment_id', $assignment->id)->where('student_id', auth()->user()->id)->first())
                                                                    <p class="text-sm font-medium text-white py-1 px-5 rounded-full {{ \App\Models\Answer::where('assignment_id', $assignment->id)->where('student_id', auth()->user()->id)->first()->status === 0 ? 'bg-blue-600' : 'bg-green-600' }}">
                                                                        {{ \App\Models\Answer::where('assignment_id', $assignment->id)->where('student_id', auth()->user()->id)->first()->status === 0 ? 'Submitted for Grading' : 'Graded' }}
                                                                    </p>
                                                                @else
                                                                    <p class="text-gray-500">No Answer Yet</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                @if (\App\Models\Answer::where('assignment_id', $assignment->id)->where('student_id', auth()->user()->id)->first())
                                                                    <p class="text-sm font-medium py-1 px-5 rounded-full {{ \App\Models\Answer::where('assignment_id', $assignment->id)->where('student_id', auth()->user()->id)->first()->grades === NULL ? 'text-gray-500' : 'font-bold' }}">
                                                                        {{ \App\Models\Answer::where('assignment_id', $assignment->id)->where('student_id', auth()->user()->id)->first()->grades !== NULL ? \App\Models\Answer::where('assignment_id', $assignment->id)->where('student_id', auth()->user()->id)->first()->grades : 'None' }}
                                                                    </p>
                                                                @else
                                                                    <p class="text-gray-500">None</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                <div class="space-y-1.5">
                                                                    <div>
                                                                        <a href="{{ route('student.assignments.show', [$schedule->id, $assignment->id]) }}" class="flex items-center space-x-1 text-green-600">
                                                                            <x-icons.pen class="w-5 h-5"/>
                                                                            <span>Write Answer</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="mt-5 sm:w-1/3">
                    <div class="border border-gray-400 p-2 rounded-lg">
                        <x-icons.warning class="w-6 h-6 mx-auto text-gray-600"/>
                        <p class="text-gray-600 text-center">
                            Please select a subject first.
                        </p>
                    </div>
                </div>
            @endif

        </div>
    </x-containers.main>
</x-layout>
