<x-layout>

    @include('students/_header')

    <x-containers.main>
        <div class="">
            <h2 class="font-bold text-blue-900 text-lg py-5 text-center">CHANGE STUDENT PASSWORD</h2>
            <div class="bg-blue-500 text-white sm:w-1/2 text-xs sm:text-sm items-center mx-auto rounded-full mb-4 font-medium flex p-2 space-x-2 mb-2">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span>You must change your password to activate your account.</span>
            </p>
        </div>

        <div class="w-11/12 sm:w-1/2 mx-auto ">
            <form action="{{ route('student.update', auth()->user()->id) }}" method="POST" id="update-password">
                @csrf
                @method('PATCH')

                <x-forms.text-input
                    name="current_password"
                    label="Current Password"
                    type="password"
                    form="update-password"
                >
                </x-forms.text-input>

                <x-forms.text-input
                    name="password"
                    label="New Password"
                    type="password"
                    form="update-password"
                >
                </x-forms.text-input>

                <x-forms.text-input
                    name="confirm_password"
                    label="Confirm Password"
                    type="password"
                    form="update-password"
                >
                </x-forms.text-input>

                <x-forms.button name="CHANGE PASSWORD"></x-forms.button>

            </form>
        </div>

    </x-containers.main>

</x-layout>
