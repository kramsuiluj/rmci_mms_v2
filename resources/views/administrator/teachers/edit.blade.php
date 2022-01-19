<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header>UPDATE TEACHER ACCOUNT</x-content-header>

        <div class="w-4/5 mx-auto sm:flex sm:space-x-5">
            <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" id="create-teacher">
                @csrf
                @method('PATCH')
            </form>

            <div class="flex-1">
                <x-forms.text-input
                    name="firstname"
                    label="First Name"
                    form="create-teacher"
                    value="{{ $teacher->firstname }}"
                >
                </x-forms.text-input>

                <x-forms.text-input
                    name="middlename"
                    label="Middle Name"
                    form="create-teacher"
                    value="{{ $teacher->middlename }}"
                >
                </x-forms.text-input>

                <x-forms.text-input
                    name="lastname"
                    label="Last Name"
                    form="create-teacher"
                    value="{{ $teacher->lastname }}"
                >
                </x-forms.text-input>

                <x-forms.text-input
                    name="username"
                    label="Username"
                    form="create-teacher"
                    value="{{ $teacher->username }}"
                >
                </x-forms.text-input>
            </div>

            <div class="flex-1">
                <x-forms.text-input
                    name="contact"
                    label="Mobile Number"
                    form="create-teacher"
                    value="{{ $teacher->profile->contact }}"
                >
                </x-forms.text-input>

                <section class="pt-3.5 border-b-2">
                    <label class="text-sm text-blue-900 font-medium block pb-2.5">Gender</label>

                    <div class="inline pr-10">
                        <label class="text-sm text-blue-900 font-medium pb-3">Male</label>
                        <input
                            type="radio"
                            name="gender"
                            value="male"
                            class="p-2"
                            form="create-teacher"
                            required
                            {{ $teacher->gender === 'male' ? 'checked' : '' }}
                        >
                    </div>

                    <div class="inline">
                        <label class="text-sm text-blue-900 font-medium pb-3" checked>Female</label>
                        <input
                            type="radio"
                            name="gender"
                            value="female"
                            class="p-2"
                            form="create-teacher"
                            required
                            {{ $teacher->gender === 'female' ? 'checked' : '' }}
                        >
                    </div>
                </section>
            </div>
        </div>

        <section class="sm:w-72 sm:ml-36 w-64 ml-16 mt-5 sm:mt-0">
            <button type="submit" form="create-teacher" class="bg-blue-900 w-full py-2 rounded-full text-white font-bold hover:bg-blue-600">UPDATE ACCOUNT</button>
        </section>
    </x-containers.main>

</x-layout>
