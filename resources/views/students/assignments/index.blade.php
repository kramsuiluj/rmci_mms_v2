<x-layout>
    @include('students._header')
    @include('students._nav')

    <x-containers.main>
        <x-content-header>
            <span>{{ $schedule->subject->name }}</span>
            <span class="text-blue-600 font-medium">ASSIGNMENT LIST</span>
        </x-content-header>

        @if ($assignments->count() === 0)
            <div>
                <p class="text-gray-500 flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>There are no assignments available yet.</span>
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

                                @foreach ($assignments as $assignment)

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
    </x-containers.main>
</x-layout>
