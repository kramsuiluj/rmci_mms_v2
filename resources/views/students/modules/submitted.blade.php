<x-layout>
    @include('students._header')
    @include('students._nav')

    <x-containers.main>
        <x-content-header>
            {{ $schedule->subject->name }}
            <span class="text-blue-600">Submitted Modules</span>
        </x-content-header>

        @if ($modules->count() === 0)
            <div>
                <p class="text-gray-500 flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>There are no modules available yet.</span>
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
                                        File Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                        Uploaded By
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

                                @foreach ($modules as $module)

                                    <tr x-data="{ show: false }">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-medium font-primary text-blue-900">
                                                        <p>{!! $module->getFirstMedia()->file_name ?? $module->module . "<span class='bg-gray-600 text-white py-0.5 px-2 rounded-full inline ml-2'> Offline </span>" !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-primary font-medium text-blue-900">
                                                        {{ $module->user->fullname() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-primary font-medium text-blue-900">
                                                        {{ $module->created_at }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-primary font-medium text-blue-900">
                                                        {!! $module->status() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-primary font-medium text-gray-900">
                                                        <div>
                                                            <a href="{{ route('student.modules.show', [$schedule->id, $module->id]) }}" class="flex items-center space-x-1 underline">
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
                                                        <div class="space-y-1.5">
                                                            <a
                                                                href="{{ $module->getFirstMedia() ? route('student.modules.download', [$schedule->id, $module->id]) : '' }}"
                                                                class="flex items-center space-x-1 hover:text-blue-700"
                                                            >
                                                                <x-icons.add-file class="h-5 w-5"/>
                                                                <span>Download Module</span>
                                                            </a>

                                                            <div x-data="{ open: false }">
                                                                <form action="{{ route('student.modules.destroy', [$schedule->id, $module->id]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="flex items-center space-x-1 text-red-500 hover:text-red-700 font-medium" type="button" @click="open = true">
                                                                        <x-icons.document-remove class="h-5 w-5"/>
                                                                        <span>Remove Module</span>
                                                                    </button>

                                                                    <div class="fixed bg-white border border-gray-300 shadow p-2 rounded-md -mt-14 left-20 sm:left-3/4" x-show="open">
                                                                        <p>Are you sure you want to remove this module?</p>
                                                                        <div class="p-2 flex justify-center space-x-2">
                                                                            <button class="bg-blue-600 text-white font-medium rounded-full py-1.5 px-5">Confirm</button>
                                                                            <button class="bg-gray-600 text-white font-medium rounded-full py-1.5 px-5" type="button" @click="open = false">Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
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
