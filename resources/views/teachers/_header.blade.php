<header class="bg-white shadow border-t-8 border-blue-900 fixed sm:fixed w-full sm:h-24 sm:px-6">
    <div class="w-11/12 mx-auto sm:w-full">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2 sm:space-x-10">
                <div id="menu-icon" class="cursor-pointer" onclick="menuToggle()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10 text-blue-900 hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>

                <a href="{{ route('teacher.index') }}">
                    <div class="flex items-center cursor-pointer">
                        <img src="{{ asset('images/rmci-logo.png') }}" alt="RMCI Logo" class="w-16 sm:w-20">

                        <h3 class="text-blue-900 font-black sm:text-xl">
                            RMCI
                            <span class="text-blue-600 italic font-semibold -ml-1">MMS</span>
                        </h3>
                    </div>
                </a>
            </div>

            <div class="cursor-pointer text-blue-900" x-data="{ isOpen: false }">
                <div class="hover:text-blue-600 flex items-center" @click="isOpen = !isOpen">
                    <h4 class="text-xs sm:text-sm font-medium flex">
                        {{ auth()->user()->firstname ?? null }}
                        @if (auth()->user()->unreadNotifications->count() !== 0)
                            <x-icons.bell class="h-2.5 w-2.5 text-blue-600"/>
                        @endif
                    </h4>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 " viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <div
                    class="absolute right-8 text-sm bg-gray-50 w-28 -ml-4 sm:-ml-1 mt-1 rounded-l-md rounded-br-md border border-gray-300 shadow"
                    x-show="isOpen"
                    @click.away="isOpen = false"
                    style="display: none"
                    x-transition:enter="transition transform origin-top-right ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-50"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition transform origin-top-right ease-out duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-50"
                >
                    <div class="">
                                                <div
                                                    class="px-2 py-1.5 hover:bg-blue-600 hover:text-white rounded-tl-md {{ request()->getRequestUri() === '/admin' ? 'hidden' : '' }}"
                                                >
                                                    <a href="{{ route('teacher.notifications.index') }}" class="text-xs sm:text-sm">Notification</a>
                                                </div>
                        <form action="{{ route('user.logout') }}" method="POST" class="px-2 py-1.5 hover:bg-blue-600 hover:text-white rounded-bl-md rounded-br-md rounded-tl-md">
                            @csrf
                            @method('DELETE')
                            <button class="text-xs sm:text-sm">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
