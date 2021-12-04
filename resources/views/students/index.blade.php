<x-layout>
    @include('students._header')
    @include('students._nav')

    <x-containers.main>
        <h3 class="text-blue-900 font-semibold">Latest Module Uploaded by Teacher</h3>

        <div class="border-b pb-1 border-gray-300">
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
                                                Upload Date
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
                                                        <div class="text-xs font-primary font-medium text-blue-900">
                                                            {{ $latestModule->created_at ?? 'Not Available' }}
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
                                                                        href="{{ empty($latestModule->getFirstMedia()) ? '' : route('student.modules.download', [$latestModule->schedule_id, $latestModule->id]) }}"
                                                                        class="flex items-center space-x-1 {{ empty($latestModule->getFirstMedia()) ? 'text-gray-500' : '' }}"
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

        <div class="mt-5">
            <h3 class="text-blue-900 font-semibold mb-3">Latest Assignments</h3>

            @if($latestAssignment)
                @if ($latestAssignment->count() === 0)
                    <div>
                        <p class="text-gray-500 flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <span>There are no assignments available yet.</span>
                        </p>
                    </div>
                @else
                    <div class="flex flex-col mb-10 border-b border-gray-300 pb-5">
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


                                        <tr x-data="{ show: false }">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-medium font-primary text-blue-900">
                                                            {{ $latestAssignment->title }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-blue-900">
                                                            {{ $latestAssignment->convertDateTime($latestAssignment->created_at) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-blue-900">
                                                            {{ $latestAssignment->convertDateTime($latestAssignment->expired_at) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-blue-900">
                                                            {!! $latestAssignment->remainingTime() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-blue-900">
                                                            @if (\App\Models\Answer::where('assignment_id', $latestAssignment->id)->where('student_id', auth()->user()->id)->first())
                                                                <p class="text-sm font-medium text-white py-1 px-5 rounded-full {{ \App\Models\Answer::where('assignment_id', $latestAssignment->id)->where('student_id', auth()->user()->id)->first()->status === 0 ? 'bg-blue-600' : 'bg-green-600' }}">
                                                                    {{ \App\Models\Answer::where('assignment_id', $latestAssignment->id)->where('student_id', auth()->user()->id)->first()->status === 0 ? 'Submitted for Grading' : 'Graded' }}
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
                                                            @if (\App\Models\Answer::where('assignment_id', $latestAssignment->id)->where('student_id', auth()->user()->id)->first())
                                                                <p class="text-sm font-medium py-1 px-5 rounded-full {{ \App\Models\Answer::where('assignment_id', $latestAssignment->id)->where('student_id', auth()->user()->id)->first()->grades === NULL ? 'text-gray-500' : 'font-bold' }}">
                                                                    {{ \App\Models\Answer::where('assignment_id', $latestAssignment->id)->where('student_id', auth()->user()->id)->first()->grades !== NULL ? \App\Models\Answer::where('assignment_id', $latestAssignment->id)->where('student_id', auth()->user()->id)->first()->grades : 'None' }}
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
                                                                    <a href="{{ route('student.assignments.show', [$latestAssignment->schedule->id, $latestAssignment->id]) }}" class="flex items-center space-x-1 text-green-600">
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
                            There are no assignments submitted yet.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </x-containers.main>
</x-layout>
