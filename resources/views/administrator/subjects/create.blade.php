<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header>CREATE SUBJECT</x-content-header>

        <div class="sm:w-1/2 w-4/5 mx-auto">
            <form action="{{ route('admin.subjects.store') }}" method="POST" id="create-subject">
                @csrf

                <x-forms.text-input
                    name="name"
                    label="Subject Name"
                    form="create-subject"
                    value="{{ old('name') }}"
                >
                </x-forms.text-input>

                <x-forms.text-area
                    name="description"
                    label="Subject Description"
                    form="create-subject"
                    value="{{ old('description') }}"
                >
                </x-forms.text-area>

                <x-forms.button name="CREATE"></x-forms.button>
            </form>
        </div>
    </x-containers.main>

</x-layout>
