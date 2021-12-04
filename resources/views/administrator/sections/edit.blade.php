<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header>EDIT SECTION</x-content-header>

        <div class="w-1/2 mx-auto space-x-5">
            <form action="{{ route('admin.sections.update', [$strand->id, $section->id]) }}" method="POST" id="update-section">
                @csrf
                @method('PATCH')

                <section class="pb-5">
                    <label for="grade_id" class="text-sm text-blue-900 font-medium block pb-5">Select Strand Grade</label>

                    <select
                        name="grade_id"
                        id="grade_id"
                        class="appearance-none bg-gray-50 w-full shadow p-2 rounded-md border border-gray-300 text-blue-900
                                @error('name') border-red-500 bg-red-50 @enderror
                            "
                        form="update-section"
                    >
                        @forelse($strand->grades as $grade)
                            <option
                                value="{{ $grade->id }}"
                                class="appearance-none"
                                {{ $section->grade_id === $grade->id ? 'selected' : '' }}
                            >
                                {{ $grade->strand->name . ' - ' . $grade->name }}
                            </option>
                        @empty

                        @endforelse
                    </select>

                    @error('grade_id')
                    <p class="text-xs pt-1 text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </section>

                <x-forms.text-input
                    name="name"
                    label="Section Name"
                    form="update-section"
                    value="{{ $section->name }}"
                >
                </x-forms.text-input>

                <x-forms.button name="UPDATE"></x-forms.button>
            </form>
        </div>
    </x-containers.main>

</x-layout>
