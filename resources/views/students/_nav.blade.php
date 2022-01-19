<aside
    class="absolute fixed h-full bg-blue-900 top-0 w-48 sm:border-t-8 sm:border-blue-900 sm:mt-24 sm:ml-24 sm:bg-blue-600 sm:z-50 sm:fixed shadow-md hidden"
    id="second-nav"
>
    <div class="flex justify-end cursor-pointer border-b-2 border-white py-3 sm:hidden border-t-8 border-blue-600" id="close-menu" onclick="closeMenu()">
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
                <a href="{{ route('student.index') }}" class="text-white text-sm hover:font-bold">
                    <h3>Homepage</h3>
                </a>
            </div>

            <div class="mt-5">
                <h3 class="text-sm text-white font-semibold">Classes</h3>

                <div class="pl-2 mt-2">
                    <li class="flex items-center space-x-1 text-white hover:font-bold hover:underline">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </div>
                        <a href="{{ route('student.rooms.show', strtolower(auth()->user()->profile->room->section->name)) }}" class="text-sm">My Class</a>
                    </li>
                </div>
            </div>
        </ul>
    </nav>
</aside>

{{-- Main Side Navigation --}}

<aside class="bg-blue-900 w-24 h-full mt-24 hidden sm:fixed sm:flex">
    <nav class="font-primary w-full">
        <ul x-data="{ isOpen: false }">
            <li class="cursor-pointer">
                <a href="{{ route('student.index') }}">
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
                                Class
                            </span>
                        </div>
                    </div>
                </a>
                <div class="absolute left-24 bg-blue-600 top-24 w-40 shadow-lg hidden"
                     x-ref="classes"
                >
                    <ul class="text-sm text-white p-2">
                        <li class="hover:font-bold">
                            <a href="{{ route('student.rooms.show', strtolower(auth()->user()->profile->room->section->name)) }}">My Class</a>


                        </li>
                    </ul>
                </div>
            </li>

{{--            Progress Report--}}
            <li class="cursor-pointer"
                x-on:mouseover="$refs.reports.classList.remove('hidden'), $refs.reportLabel.classList.add('bg-blue-600')"
                x-on:mouseover.away="$refs.reports.classList.add('hidden'), $refs.reportLabel.classList.remove('bg-blue-600')"
            >
                <a href="">
                    <div class="text-white text-center mt-6 text-sm">
                        <div class="p-1 rounded-l-full" x-ref="reportLabel">
                            <x-icons.chart-solid class="h-5 w-5 mx-auto"/>
                            <span>
                                Report
                            </span>
                        </div>
                    </div>
                </a>
                <div class="absolute left-24 bg-blue-600 w-40 shadow-lg hidden"
                     style="top: 10.5rem"
                     x-ref="reports"
                >
                    <ul class="text-sm text-white p-2">
                        <li class="hover:font-bold">
                            <a href="{{ route('student.reports.index') }}">Progress Report</a>


                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</aside>
