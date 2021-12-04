<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <div class="my-10 border-b pb-3 border-gray-400">
            <x-content-header class="">Administrator Panel</x-content-header>

            <div class="flex-col space-y-5">
                <div class="flex space-x-5 flex-1">
                    <div class="border border-gray-300 flex-1">
                        <p class="bg-blue-600 py-1 px-2 text-white font-semibold border-l-8 border-blue-900">
                            CLASS ACTIONS
                        </p>

                        <div class="flex">
                            <a href="{{ route('admin.rooms.index') }}" class="hover:bg-blue-100 flex-1 border-r">
                                <div class="p-5 hover:bg-blue-100 text-blue-900">
                                    <p class="text-center">View All Classes</p>
                                    <x-icons.view class="h-6 w-6 mx-auto" />
                                </div>
                            </a>

                            <a href="{{ route('admin.rooms.create') }}" class="hover:bg-blue-100 flex-1">
                                <div class="p-5 hover:bg-blue-100 text-blue-900">
                                    <p class="text-center">Create Class</p>
                                    <x-icons.add class="h-6 w-6 mx-auto" />
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="border border-gray-300 flex-1">
                        <p class="bg-blue-600 py-1 px-2 text-white font-semibold border-l-8 border-blue-900">
                            SUBJECT ACTIONS
                        </p>

                        <div class="flex">
                            <a href="{{ route('admin.subjects.index') }}" class="hover:bg-blue-100 flex-1 border-r">
                                <div class="p-5 hover:bg-blue-100 text-blue-900">
                                    <p class="text-center">View All Subjects</p>
                                    <x-icons.view class="h-6 w-6 mx-auto" />
                                </div>
                            </a>

                            <a href="{{ route('admin.subjects.create') }}" class="hover:bg-blue-100 flex-1">
                                <div class="p-5 hover:bg-blue-100 text-blue-900">
                                    <p class="text-center">Create Subject</p>
                                    <x-icons.add class="h-6 w-6 mx-auto" />
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="flex space-x-5">
                    <div class="border border-gray-300 flex-1">
                        <p class="bg-blue-600 py-1 px-2 text-white font-semibold border-l-8 border-blue-900">
                            TEACHER ACTIONS
                        </p>

                        <div class="flex">
                            <a href="{{ route('admin.teachers.index') }}" class="hover:bg-blue-100 flex-1 border-r">
                                <div class="p-5 hover:bg-blue-100 text-blue-900">
                                    <p class="text-center">View All Teachers</p>
                                    <x-icons.view class="h-6 w-6 mx-auto" />
                                </div>
                            </a>

                            <a href="{{ route('admin.teachers.create') }}" class="hover:bg-blue-100 flex-1">
                                <div class="p-5 hover:bg-blue-100 text-blue-900">
                                    <p class="text-center">Create Teacher</p>
                                    <x-icons.add class="h-6 w-6 mx-auto" />
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="border border-gray-300 flex-1">
                        <p class="bg-blue-600 py-1 px-2 text-white font-semibold border-l-8 border-blue-900">
                            STRAND ACTIONS
                        </p>

                        <div class="flex">
                            <a href="{{ route('admin.strands.index') }}" class="hover:bg-blue-100 flex-1 border-r">
                                <div class="p-5 hover:bg-blue-100 text-blue-900">
                                    <p class="text-center">View All Strands</p>
                                    <x-icons.view class="h-6 w-6 mx-auto" />
                                </div>
                            </a>

                            <a href="{{ route('admin.strands.create') }}" class="hover:bg-blue-100 flex-1">
                                <div class="p-5 hover:bg-blue-100 text-blue-900">
                                    <p class="text-center">Create Strand</p>
                                    <x-icons.add class="h-6 w-6 mx-auto" />
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-containers.main>

</x-layout>
