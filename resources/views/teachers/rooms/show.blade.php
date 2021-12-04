<x-layout>
    @include('teachers._header')
    @include('teachers._nav')

    <x-containers.main>
        <x-content-header>{{ $room->section->gradeAndSection() }}</x-content-header>
        <div class="-mt-5">
            <p class="text-blue-600 font-semibold">{{ $room->strand->name }}</p>
        </div>

        <div class=" mt-10 flex justify-end" x-data="{ open: false }">
            <div class="sm:w-80">
                <div class="">
                    <button
                        class="sm:w-80 text-blue-900 border border-gray-300 rounded-md bg-gray-50 py-1 px-5 flex items-center justify-between"
                        @click="open = true"
                    >
                        <span class="font-semibold">{{ request('display') ? strtoupper(request('display')) : 'SELECT DISPLAY'  }}</span>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </div>

                <div
                    class="absolute bg-gray-50 border border-gray-300 mt-1 rounded-md w-full sm:w-80"
                     x-show="open"
                    @click.away="open = false"
                >
                    <a href="{{ route('teacher.rooms.show', $room->id) }}?display=students" class="text-blue-900 hover:bg-blue-600 hover:text-white">
                        <div class="text-blue-900 hover:bg-blue-600 hover:text-white p-2 rounded-tl-md rounded-tr-md border-b">

                                STUDENTS
                        </div>
                    </a>

                    <a href="{{ route('teacher.rooms.show', $room->id) }}?display=subjects" class="text-blue-900 hover:bg-blue-600 hover:text-white">
                        <div class="text-blue-900 hover:bg-blue-600 hover:text-white p-2 rounded-bl-md rounded-br-md">

                            SUBJECTS
                        </div>
                    </a>
                </div>
            </div>
        </div>

        @if (!empty($students))
            <div class="mt-2">
                @if ($students->count() === 0)
                    <div>
                        <p class="text-gray-500 flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <span>There are no students available yet.</span>
                        </p>
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
                                                Last Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                First Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Middle Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Username
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Contact Number
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">

                                        @foreach ($students as $student)

                                            <tr x-data="{ show: false }">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-medium font-primary text-blue-900">
                                                                {{ $student->user->lastname }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                {{ $student->user->firstname }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                {{ $student->user->middlename }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                {{ $student->user->id }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-xs font-primary font-medium text-blue-900">
                                                                {{ $student->contact }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium absolute bg-gray-50 right-10 mt-3 rounded-md border-2 border-gray-200 shadow w-62"
                                                    x-show="show"
                                                    style="display: none"
                                                >
                                                    <form action="{{ route('teacher.students.destroy', $student->user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div class="">
                                                            <p class="font-primary text-left text-blue-900">Are you sure?</p>
                                                            <div class="mt-2 flex justify-between">
                                                                <button class="font-primary uppercase text-xs bg-red-500 py-1.5 px-2 rounded-full text-white font-bold mr-2">Confirm</button>
                                                                <span
                                                                    class="font-primary uppercase text-xs bg-blue-500 py-1.5 px-2 rounded-full text-white font-bold cursor-pointer"
                                                                    @click="show = false"
                                                                >
                                                                Cancel</span>
                                                            </div>
                                                        </div>
                                                    </form>
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
            </div>
        @endif

        @if(!empty($schedules))
            <div class="mt-2">
                @if ($schedules->count() === 0)
                    <div>
                        <p class="text-gray-500 flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <span>There are no subjects available yet.</span>
                        </p>
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
                                                Subject
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Subject Teacher
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                                Description
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">

                                        @foreach ($schedules as $schedule)

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
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif

    </x-containers.main>
</x-layout>
