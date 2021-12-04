<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header>EDIT SUBJECT</x-content-header>

        <div class="w-1/2 mx-auto space-x-5">
            <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST" id="create-subject">
                @csrf
                @method('PATCH')

                <x-forms.text-input
                    name="name"
                    label="Subject Name"
                    form="create-subject"
                    value="{{ $subject->name }}"
                >
                </x-forms.text-input>

                <x-forms.text-area
                    name="description"
                    label="Subject Description"
                    form="create-subject"
                    value="{{ $subject->description }}"
                >
                </x-forms.text-area>

                <x-forms.button name="UPDATE"></x-forms.button>
            </form>
        </div>
    </x-containers.main>

</x-layout>
