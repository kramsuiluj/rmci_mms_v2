<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header>CREATE TEACHER ACCOUNT</x-content-header>

        <div class="w-4/5 mx-auto sm:flex sm:space-x-5">
            <form action="{{ route('admin.teachers.store') }}" method="POST" id="update-teacher">
                @csrf
            </form>

            <div class="flex-1">
                <x-forms.text-input name="firstname" label="First Name" form="update-teacher"></x-forms.text-input>
                <x-forms.text-input name="middlename" label="Middle Name" form="update-teacher"></x-forms.text-input>
                <x-forms.text-input name="lastname" label="Last Name" form="update-teacher"></x-forms.text-input>
                <x-forms.text-input name="username" label="Username" form="update-teacher"></x-forms.text-input>
            </div>

            <div class="flex-1">
                <x-forms.text-input name="contact" label="Mobile Number" form="update-teacher"></x-forms.text-input>
                <section class="pt-3.5 border-b-2">
                    <label class="text-sm text-blue-900 font-medium block pb-2.5">Gender</label>

                    <div class="inline pr-10">
                        <label class="text-sm text-blue-900 font-medium pb-3">Male</label>
                        <input type="radio" name="gender" value="male" class="p-2" form="update-teacher" required>
                    </div>

                    <div class="inline">
                        <label class="text-sm text-blue-900 font-medium pb-3" checked>Female</label>
                        <input type="radio" name="gender" value="female" class="p-2" form="update-teacher" required>
                    </div>
                </section>

                <section class="pt-4">
                    <x-forms.text-input
                        name="password"
                        type="password"
                        label="Password"
                        form="update-teacher">
                    </x-forms.text-input>
                </section>

                <x-forms.text-input
                    name="password_confirmation"
                    type="password"
                    label="Confirm Password"
                    form="update-teacher">
                </x-forms.text-input>
            </div>
        </div>

        <section class="sm:w-72 sm:ml-36 w-64 mx-auto mb-10">
            <button type="submit" form="update-teacher" class="bg-blue-900 w-full py-2 rounded-full text-white font-bold hover:bg-blue-600">CREATE ACCOUNT</button>
        </section>
    </x-containers.main>

</x-layout>
