<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header>CREATE STRAND</x-content-header>

        <div class="w-1/2 mx-auto space-x-5">
            <form action="{{ route('admin.strands.store') }}" method="POST" id="create-strand">
                @csrf

                <x-forms.text-input
                    name="name"
                    label="Strand Name"
                    form="create-strand"
                    value="{{ old('name') }}"
                >
                </x-forms.text-input>

                <x-forms.text-area
                    name="description"
                    label="Strand Description"
                    form="create-strand"
                    value="{{ old('description') }}"
                >
                </x-forms.text-area>

                <x-forms.button name="CREATE"></x-forms.button>
            </form>
        </div>
    </x-containers.main>

</x-layout>
