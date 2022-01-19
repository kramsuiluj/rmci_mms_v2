<x-layout>
    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header class="border-b-2 border-blue-500">RMCI: Student List</x-content-header>

        <div class="flex items-center mb-2 mt-5">
            <div class="flex border-2 rounded">
                <form method="GET" class="flex items-center">
                    <input
                        type="text"
                        name="search"
                        class="px-4 py-2 w-4/5"
                        placeholder="Search"
                        value="{{ request('search') }}"
                    >

                    <button class="flex items-center justify-center px-4 border-l">
                        <svg class="w-6 h-6 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24">
                            <path
                                d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                        </svg>
                    </button>

                    @if(request()->has('search'))
                        <a href="{{ route('admin.students.index') }}" class="p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif
                </form>

            </div>
        </div>

        <div class="mt-10">
{{--            @foreach($students as $student)--}}
{{--                <div>--}}
{{--                    {{ $student->firstname }}--}}
{{--                </div>--}}
{{--            @endforeach--}}

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
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                            Grade
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                            Section
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
                                                            {{ $student->lastname }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-blue-900">
                                                            {{ $student->firstname }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-blue-900">
                                                            {{ $student->middlename }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-blue-900">
                                                            {{ $student->id }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-blue-900">
                                                            {{ $student->profile->contact }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-blue-900">
                                                            {{ $student->profile->room->grade->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-primary font-medium text-blue-900">
                                                            {{ $student->profile->room->section->name }}
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

        {{ $students->links() }}
    </x-containers.main>


</x-layout>
