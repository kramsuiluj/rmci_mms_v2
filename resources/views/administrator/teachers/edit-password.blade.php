<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <div class="text-center">
            <h2 class="font-bold text-blue-900 text-lg py-5">CHANGE TEACHER PASSWORD</h2>
        </div>

        <div class="w-11/12 sm:w-1/2 mx-auto ">
            <form action="{{ route('admin.teachers.update-password', $teacher->id) }}" method="POST" id="update-password">
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
