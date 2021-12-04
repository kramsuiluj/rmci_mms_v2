<x-layout>
    @include('teachers._header')
    @include('teachers._nav')

    <x-containers.main>
        <x-content-header>UPLOADED MODULES</x-content-header>

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
                                                    <div class="text-xs font-primary font-medium text-blue-900">
                                                        {{ $module->created_at ?? 'Not Available' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-primary font-medium text-blue-900">
                                                        <p>{!! $module->status() !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-primary font-medium text-gray-900">
                                                        <div>
                                                            <a href="{{ route('teacher.modules.comment', [$schedule->id, $module->id]) }}" class="flex items-center space-x-1 underline">
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
                                                                    href="{{ empty($module->getFirstMedia()) ? '' : route('teacher.modules.downloadModule', $module->id) }}"
                                                                    class="flex items-center space-x-1 {{ empty($module->getFirstMedia()) ? 'text-gray-500' : '' }}"
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
                                                                        action="{{ route('teacher.modules.check', [$schedule->id, $module->id]) }}"
                                                                        class="space-x-2 mt-2"
                                                                        method="POST"
                                                                    >
                                                                        @csrf
                                                                        @method('PATCH')

                                                                        <button
                                                                            class="text-white py-1 px-3 rounded-full {{ $module->status == 1 ? 'bg-gray-600' : 'bg-blue-600' }}"
                                                                            type="{{ $module->status == 1 ? 'button' : 'submit' }}"
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
