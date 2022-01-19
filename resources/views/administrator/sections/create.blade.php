<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header>CREATE SECTION</x-content-header>

        <div class="sm:w-1/2 w-4/5 mx-auto">
            <form action="{{ route('admin.sections.store', $strand->id) }}" method="POST" id="create-section">
                @csrf

                <section class="pb-5">
                    <label for="name" class="text-sm text-blue-900 font-medium block pb-5">Select Strand Grade</label>

                    <select
                        name="grade_id"
                        id="grade_id"
                        class="appearance-none bg-gray-50 w-full shadow p-2 rounded-md border border-gray-300 text-blue-900
{{--                                @error('name') border-red-500 bg-red-50 @enderror--}}
                            "
                        form="create-section"
                    >
                        @forelse($grades as $grade)
                            <option value="{{ $grade->id }}" class="appearance-none">{{ $grade->strand->name . ' - ' . $grade->name }}</option>
                        @empty

                        @endforelse
                    </select>

{{--                    @error('name')--}}
{{--                    <p class="text-xs pt-1 text-red-500 font-medium">{{ $message }}</p>--}}
{{--                    @enderror--}}
                </section>

                <x-forms.text-input
                    name="name"
                    label="Section Name"
                    form="create-section"
                    value="{{ old('name') }}"
                >
                </x-forms.text-input>

                <x-forms.button name="CREATE"></x-forms.button>
            </form>
        </div>
    </x-containers.main>

</x-layout>
