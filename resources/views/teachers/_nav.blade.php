<aside
    class="absolute fixed h-full bg-blue-900 top-0 w-48 sm:border-t-8 sm:border-blue-900 sm:mt-24 sm:ml-24 sm:bg-blue-600 sm:z-50 sm:fixed shadow-md hidden"
    id="second-nav"
>
    <div class="flex justify-end cursor-pointer border-b-2 border-white py-3 sm:hidden" id="close-menu" onclick="closeMenu()">
        <img src="{{ asset('images/cancel.png') }}" alt="Close Menu Icon" class="w-4 mr-2">
    </div>

    <nav>
        <ul class="pl-3 mt-5">
            <div class="flex space-x-2 sm:hidden">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </div>
                <a href="{{ route('teacher.index') }}" class="text-white text-sm hover:font-bold">
                    <h3>Homepage</h3>
                </a>
            </div>

            <div class="mt-5">
                <h3 class="text-sm text-white font-semibold">Manage Classes</h3>

                <div class="pl-2 mt-2">
                    <li class="flex items-center space-x-1 text-white hover:font-bold hover:underline">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </div>
                        <a href="{{ route('teacher.rooms.show', auth()->user()->room->id) }}" class="text-sm">My Advisory Class</a>
                    </li>
                </div>
            </div>

            <div class="mt-5">
                <h3 class="text-sm text-white font-semibold">Manage Subjects</h3>

                <div class="pl-2 mt-2">
                    <li class="flex items-center space-x-1 text-white hover:font-bold hover:underline">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </div>
                        <a href="{{ route('teacher.schedules.index') }}" class="text-sm">View All Subjects</a>
                    </li>
                </div>
            </div>

            <div class="mt-5">
                <h3 class="text-sm text-white font-semibold">Manage Students</h3>

                <div class="pl-2 mt-2">
                    <li class="flex items-center space-x-1 text-white hover:font-bold hover:underline">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </div>
                        <a href="{{ route('admin.teachers.index') }}" class="text-sm">Enroll Student by File Upload</a>
                    </li>

                    <li class="flex items-center space-x-1 text-white hover:font-bold hover:underline mt-1">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <a href="{{ route('admin.teachers.create') }}" class="text-sm">Enroll Student by Form</a>
                    </li>
                </div>
            </div>

            <div class="mt-5">
                <h3 class="text-sm text-white font-semibold">Manage Modules</h3>

                <div class="pl-2 mt-2">
                    <li class="flex items-center space-x-1 text-white hover:font-bold hover:underline">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </div>
                        <a href="{{ route('teacher.modules.scan') }}" class="text-sm">Receive Module</a>
                    </li>
                </div>
            </div>
        </ul>
    </nav>
</aside>

<aside class="bg-blue-900 w-24 h-full mt-24 hidden sm:fixed sm:flex">
    <nav class="font-primary w-full">
        <ul x-data="{ isOpen: false }">
            <li class="cursor-pointer">
                <a href="{{ route('teacher.index') }}">
                    <div class="text-white text-center mt-6 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        <span>
                            Home
                        </span>
                    </div>
                </a>
            </li>
            @if(auth()->user()->profile->is_adviser == true)
                <li class="cursor-pointer"
                    x-on:mouseover="$refs.classes.classList.remove('hidden'), $refs.classLabel.classList.add('bg-blue-600')"
                    x-on:mouseover.away="$refs.classes.classList.add('hidden'), $refs.classLabel.classList.remove('bg-blue-600')"
                >
                    <a href="">
                        <div class="text-white text-center mt-6 text-sm">
                            <div class="p-1 rounded-l-full" x-ref="classLabel">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.496 2.132a1 1 0 00-.992 0l-7 4A1 1 0 003 8v7a1 1 0 100 2h14a1 1 0 100-2V8a1 1 0 00.496-1.868l-7-4zM6 9a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1zm3 1a1 1 0 012 0v3a1 1 0 11-2 0v-3zm5-1a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span>
                                Classes
                            </span>
                            </div>
                        </div>
                    </a>
                    <div class="absolute left-24 bg-blue-600 top-24 w-40 shadow-lg hidden z-50"
                         x-ref="classes"
                    >
                        <ul class="text-sm text-white p-2">
                            <li class="hover:font-bold">
                                <a href="{{ auth()->user()->profile->is_adviser == true ? route('teacher.rooms.show', auth()->user()->room->id) : '' }}">My Advisory Class</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            <li
                class="cursor-pointer"
                x-on:mouseover="$refs.subjects.classList.remove('hidden'), $refs.subjectLabel.classList.add('bg-blue-600')"
                x-on:mouseover.away="$refs.subjects.classList.add('hidden'), $refs.subjectLabel.classList.remove('bg-blue-600')"
            >
                <a href="">
                    <div class="text-white text-center mt-6 text-sm rounded-l-full" x-ref="subjectLabel">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                        </svg>
                        <span>
                            Subjects
                        </span>
                    </div>
                </a>
                <div class="absolute left-24 bg-blue-600 w-48 hidden {{ auth()->user()->profile->is_adviser == false ? 'top-20' : 'top-40' }}"
                     x-ref="subjects"
                >
                    <ul class="text-sm text-white p-2">
                        <li class="hover:font-bold">
                            <a href="{{ route('teacher.schedules.index') }}">View All Subjects</a>
                        </li>
                    </ul>
                </div>
            </li>
            @if(auth()->user()->profile->is_adviser == true)
                <li
                    class="cursor-pointer"
                    x-on:mouseover="$refs.students.classList.remove('hidden'), $refs.studentLabel.classList.add('bg-blue-600')"
                    x-on:mouseover.away="$refs.students.classList.add('hidden'), $refs.studentLabel.classList.remove('bg-blue-600')"
                >
                    <a href="">
                        <div class="text-white text-center mt-6 text-sm rounded-l-full" x-ref="studentLabel">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                            <span>
                            Students
                        </span>
                        </div>
                    </a>
                    <div class="absolute left-24 bg-blue-600 top-52 w-40 hidden"
                         x-ref="students"
                    >
                        <ul class="text-sm text-white p-2">
                            <li class="hover:font-bold">
                                <a href="{{ auth()->user()->profile->is_adviser == true ? route('teacher.students.createByFile', auth()->user()->room->id) : '' }}">Enroll Student by File Upload</a>
                            </li>
                            <li class="mt-2 hover:font-bold">
                                <a href="{{ route('teacher.students.createByForm', auth()->user()->room->id) }}">Enroll Student by Form</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            <li
                class="cursor-pointer"
                x-on:mouseover="$refs.strands.classList.remove('hidden'), $refs.strandLabel.classList.add('bg-blue-600')"
                x-on:mouseover.away="$refs.strands.classList.add('hidden'), $refs.strandLabel.classList.remove('bg-blue-600')"
            >
                <a href="">
                    <div class="text-white text-center mt-6 text-sm rounded-l-full" x-ref="strandLabel">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                        </svg>
                        <span>
                            Modules
                        </span>
                    </div>
                </a>
                <div class="absolute left-24 bg-blue-600 w-40 hidden {{ auth()->user()->profile->is_adviser == false ? 'top-36' : 'top-72' }}"
                     x-ref="strands"
                >
                    <ul class="text-sm text-white p-2">
                        <li class=" hover:font-bold">
                            <a href="{{ route('teacher.modules.scan') }}">Receive Module</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</aside>
