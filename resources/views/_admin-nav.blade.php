<aside
    class="fixed h-full bg-blue-900 top-0 w-48 sm:border-t-8 sm:border-blue-900 sm:mt-24 sm:ml-24 sm:bg-blue-600 sm:z-50 sm:fixed hidden shadow-md"
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
                <a href="{{ route('admin.home') }}" class="text-white text-sm hover:font-bold">
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
                        <a href="{{ route('admin.rooms.index') }}" class="text-sm">View All Classes</a>
                    </li>

                    <li class="flex items-center space-x-1 text-white hover:font-bold hover:underline mt-1">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z" />
                            </svg>
                        </div>
                        <a href="{{ route('admin.rooms.create') }}" class="text-sm">Create Class</a>
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
                        <a href="{{ route('admin.subjects.index') }}" class="text-sm">View All Subjects</a>
                    </li>

                    <li class="flex items-center space-x-1 text-white hover:font-bold hover:underline mt-1">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z" />
                            </svg>
                        </div>
                        <a href="{{ route('admin.subjects.create') }}" class="text-sm">Create Subject</a>
                    </li>
                </div>
            </div>

            <div class="mt-5">
                <h3 class="text-sm text-white font-semibold">Manage Teachers</h3>

                <div class="pl-2 mt-2">
                    <li class="flex items-center space-x-1 text-white hover:font-bold hover:underline">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </div>
                        <a href="{{ route('admin.teachers.index') }}" class="text-sm">View All Teachers</a>
                    </li>

                    <li class="flex items-center space-x-1 text-white hover:font-bold hover:underline mt-1">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <a href="{{ route('admin.teachers.create') }}" class="text-sm">Create Teacher Account</a>
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
                        <a href="{{ route('admin.students.index') }}" class="text-sm">View All Students</a>
                    </li>
                </div>
            </div>

            <div class="mt-5">
                <h3 class="text-sm text-white font-semibold">Manage Strands</h3>

                <div class="pl-2 mt-2">
                    <li class="flex items-center space-x-1 text-white hover:font-bold hover:underline">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </div>
                        <a href="{{ route('admin.strands.index') }}" class="text-sm">View All Strands</a>
                    </li>

                    <li class="flex items-center space-x-1 text-white hover:font-bold hover:underline mt-1">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <a href="{{ route('admin.strands.create') }}" class="text-sm">Create Strand</a>
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
                <a href="{{ route('admin.home') }}">
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
                <div class="absolute left-24 bg-blue-600 top-20 w-40 shadow-md hidden"
                     x-ref="classes"
                >
                    <ul class="text-sm text-white p-2">
                        <li class="hover:font-bold">
                            <a href="{{ route('admin.rooms.index') }}">View All Classes</a>
                        </li>
                        <li class="mt-2 hover:font-bold">
                            <a href="{{ route('admin.rooms.create') }}">Create Class</a>
                        </li>
                    </ul>
                </div>
            </li>
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
                <div class="absolute left-24 bg-blue-600 top-36 w-40 hidden"
                     x-ref="subjects"
                >
                    <ul class="text-sm text-white p-2">
                        <li class="hover:font-bold">
                            <a href="{{ route('admin.subjects.index') }}">View All Subjects</a>
                        </li>
                        <li class="mt-2 hover:font-bold">
                            <a href="{{ route('admin.subjects.create') }}">Create Subject</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="cursor-pointer"
                x-on:mouseover="$refs.teachers.classList.remove('hidden'), $refs.teacherLabel.classList.add('bg-blue-600')"
                x-on:mouseover.away="$refs.teachers.classList.add('hidden'), $refs.teacherLabel.classList.remove('bg-blue-600')"
            >
                <a href="">
                    <div class="text-white text-center mt-6 text-sm rounded-l-full" x-ref="teacherLabel">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>
                            Teachers
                        </span>
                    </div>
                </a>
                <div class="absolute left-24 bg-blue-600 top-52 w-40 hidden"
                     x-ref="teachers"
                >
                    <ul class="text-sm text-white p-2">
                        <li class="hover:font-bold">
                            <a href="{{ route('admin.teachers.index') }}">View All Teachers</a>
                        </li>
                        <li class="mt-2 hover:font-bold">
                            <a href="{{ route('admin.teachers.create') }}">Create Teacher Account</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="cursor-pointer"
                x-on:mouseover="$refs.students.classList.remove('hidden'), $refs.studentLabel.classList.add('bg-blue-600')"
                x-on:mouseover.away="$refs.students.classList.add('hidden'), $refs.studentLabel.classList.remove('bg-blue-600')"
            >
                <a href="">
                    <div class="text-white text-center mt-6 text-sm rounded-l-full" x-ref="studentLabel">
                        <x-icons.academic-cap class="h-5 w-5 mx-auto"/>
                        <span>
                            Students
                        </span>
                    </div>
                </a>
                <div class="absolute left-24 bg-blue-600 w-40 hidden"
                     style="top: 18rem"
                     x-ref="students"
                >
                    <ul class="text-sm text-white p-2">
                        <li class="hover:font-bold">
                            <a href="{{ route('admin.students.index') }}">View All Students</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li
                class="cursor-pointer"
                x-on:mouseover="$refs.strands.classList.remove('hidden'), $refs.strandLabel.classList.add('bg-blue-600')"
                x-on:mouseover.away="$refs.strands.classList.add('hidden'), $refs.strandLabel.classList.remove('bg-blue-600')"
            >
                <a href="">
                    <div class="text-white text-center mt-6 text-sm rounded-l-full" x-ref="strandLabel">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                        </svg>
                        <span>
                            Strands
                        </span>
                    </div>
                </a>
                <div class="absolute left-24 bg-blue-600 w-40 hidden"
                     style="top: 22rem"
                     x-ref="strands"
                >
                    <ul class="text-sm text-white p-2">
                        <li class="hover:font-bold">
                            <a href="{{ route('admin.strands.index') }}">View All Strands</a>
                        </li>
                        <li class="mt-2 hover:font-bold">
                            <a href="{{ route('admin.strands.create') }}">Create Strand</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</aside>
