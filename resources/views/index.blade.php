<x-layout>

    <div>
        <div class="sm:flex sm:h-screen">
            <div class="bg-blue-200 sm:bg-white pb-10 sm:flex-1 sm:order-1 sm:flex sm:flex-col sm:justify-center">
                <div class="py-10 text-center">
                    <h2 class="text-blue-600 font-black text-xl tracking-wider sm:text-2xl">WELCOME</h2>
                    <p class="text-blue-900 sm:text-lg">Sign in to your account.</p>
                </div>

                <form action="{{ route('guest.login') }}" method="POST" class="w-4/5 mx-auto">
                    @csrf

                    <x-forms.session-input
                        placeholder="Username"
                        name="username"
                        type="text"
                        value="{{ old('username') }}"
                    >
                        <x-icons.user class="h-7 w-7 text-gray-400"></x-icons.user>
                    </x-forms.session-input>

                    <x-forms.session-input
                        placeholder="Password"
                        name="password"
                        type="password"
                        value="{{ old('password') }}"
                    >
                        <x-icons.lock class="h-7 w-7 text-gray-400"></x-icons.lock>
                    </x-forms.session-input>

                    <x-forms.button name="SIGN IN" class="hover:bg-blue-700"></x-forms.button>

                </form>
            </div>

            <div class="pt-5 pb-10 sm:flex-1 sm:bg-blue-200 sm:flex sm:items-center">
                <div class="w-5/6 mx-auto">
                    <img
                        src="{{ asset('images/rmci-logo.png') }}"
                        alt="RMCI Logo"
                        class="w-5/6 mx-auto sm:w-3/5"
                    >

                    <div class="text-center">
                        <h1 class="text-xl font-bold text-blue-900 sm:text-2xl">REGINA MONDI COLLEGE, INC.</h1>
                        <p class="font-medium text-blue-600 sm:text-lg">MODULE MANAGEMENT SYSTEM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-layout>
