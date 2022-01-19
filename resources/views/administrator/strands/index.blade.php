<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header>RMCI Strands</x-content-header>

        @if ($strands->count() === 0)
            <div>
                <p class="text-gray-500 flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>There are no strands available yet.</span>
                </p>
            </div>
        @else
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr class="bg-blue-600 w-full">
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                        Strand Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                        Strand Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                        Grades & Sections
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                        Grade Actions
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                        Section Actions
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white font-primary tracking-wider">
                                        Strand Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($strands as $strand)

                                    <tr x-data="{ show: false }">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-medium font-primary text-blue-900">
                                                        {{ $strand->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-primary font-medium text-blue-900">
                                                        {{ $strand->description }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-primary font-medium text-blue-900">
                                                        @if($strand->grades->count() !== 0)
                                                            @foreach($strand->grades as $grade)
                                                                @if($grade->sections->count() !== 0)
                                                                    @foreach($grade->sections as $section)
                                                                        <p>{{ $section->gradeAndSection() }}</p>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <p>There are no grades and sections available yet.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-primary font-medium text-blue-900">
                                                        <div class="flex items-center space-x-1">
                                                            <div class="ml-1.5" title="Add Grade">
                                                                <a href="{{ route('admin.grades.create', $strand->id) }}">
                                                                    <x-icons.add class="h-6 w-6 text-green-600"></x-icons.add>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('admin.grades.index', $strand->id) }}">
                                                                    <x-forms.delete-button title="Delete Grade"></x-forms.delete-button>
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
                                                        <div class="ml-1.5" title="Add Section">
                                                            <div class="flex items-center space-x-3">
                                                                <a href="{{ route('admin.sections.create', $strand->id) }}">
                                                                    <x-icons.add class="h-6 w-6 text-green-600"></x-icons.add>
                                                                </a>
                                                                <a href="{{ route('admin.sections.index', $strand->id) }}">
                                                                    <x-icons.cog class="h-6 w-6 text-blue-600"></x-icons.cog>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center">
                                                <x-forms.edit-button href="{{ route('admin.strands.edit', $strand->id) }}">
                                                </x-forms.edit-button>
                                                <div @click="show = true">
                                                    <x-forms.delete-button></x-forms.delete-button>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium absolute bg-gray-50 right-28 mt-3 rounded-md border-2 border-gray-200 shadow w-62 -mr-16 sm:mr-0"
                                            x-show="show"
                                            style="display: none"
                                        >
                                            <form action="{{ route('admin.strands.destroy', $strand->id) }}" method="POST">
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
    </x-containers.main>

</x-layout>
