<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header>EDIT STRAND</x-content-header>

        <div class="w-1/2 mx-auto space-x-5">
            <form action="{{ route('admin.strands.update', $strand->id) }}" method="POST" id="update-strand">
                @csrf
                @method('PATCH')

                <x-forms.text-input
                    name="name"
                    label="Strand Name"
                    form="update-strand"
                    value="{{ $strand->name }}"
                >
                </x-forms.text-input>

                <x-forms.text-area
                    name="description"
                    label="Strand Description"
                    form="update-strand"
                    value="{{ $strand->description }}"
                >
                </x-forms.text-area>

                <x-forms.button name="UPDATE"></x-forms.button>
            </form>
        </div>
    </x-containers.main>

</x-layout>
