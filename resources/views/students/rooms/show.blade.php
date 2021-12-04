<x-layout>
    @include('students._header')
    @include('students._nav')

    <x-containers.main>
        <x-content-header>{{ $room->section->gradeAndSection() }}</x-content-header>
        <div class="-mt-5">
            <p class="text-blue-600 font-semibold">{{ $room->strand->name }}</p>
            <p class="text-blue-900 font-bold">{{ $room->adviser->fullname() }}</p>
        </div>

        @if ($room->schedules->count() === 0)
            <div>
                <p class="text-gray-500 flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>There are no subjects available yet.</span>
                </p>
            </div>
        @else
            <div class="flex flex-col my-10">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr class="bg-blue-600 w-full">
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                        Subject
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                        Subject Teacher
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                        Module Actions
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                        Assignment Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($room->schedules as $schedule)

                                    <tr x-data="{ show: false }">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-medium font-primary text-blue-900">
                                                        {{ $schedule->subject->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-medium font-primary text-blue-900">
                                                        {{ $schedule->teacher->fullname() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-primary font-medium text-blue-900">
                                                        {{ $schedule->subject->description }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-primary font-medium text-blue-900">
                                                        <div class="flex-col space-y-1.5">
                                                            <div>
                                                                <a href="{{ route('student.modules.index', $schedule->id) }}" class="text-green-600 hover:text-green-500 flex items-center space-x-1">
                                                                    <x-icons.search-file class="h-5 w-5"/>
                                                                    <span>View Modules</span>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('student.modules.create', $schedule->id) }}" class="text-blue-600 hover:text-blue-500 flex items-center space-x-1">
                                                                    <x-icons.file-plus class="h-5 w-5"/>
                                                                    <span>Submit Module</span>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('student.modules.submitted', $schedule->id) }}" class="text-blue-600 hover:text-blue-500 flex items-center space-x-1">
                                                                    <x-icons.list class="h-5 w-5"/>
                                                                    <span>View Submitted Modules</span>
                                                                </a>
                                                            </div>
                                                        </div>
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
                                                                <a href="{{ route('student.assignments.index', $schedule->id) }}" class="flex items-center space-x-1 text-green-600">
                                                                    <x-icons.bookmark class="w-5 h-5"/>
                                                                    <span>View Assignments</span>
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
    </x-containers.main>
</x-layout>
