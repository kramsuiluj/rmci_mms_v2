<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header class="text-blue-900">EDIT SECTIONS</x-content-header>

        <div class="sm:w-1/2 w-4/5 mx-auto">
            <section class="pb-5">
                <label for="name" class="text-sm text-blue-900 font-medium block pb-5">Select Strand Grade</label>

                <div x-data="{ open: false }">
                    <button
                        class="w-full bg-gray-50 py-2 text-left pl-5 border border-gray-300 text-blue-900 font-semibold rounded-md"
                        @click="open = !open"
                    >
                        SELECT GRADE
                    </button>

                    <div
                        class="w-full border bg-blue-50 rounded-md mt-0.5"
                        x-show="open"
                        @click.away="open = false"
                        style="display: none"
                    >
                        @if($strand->grades->count() !== 0)
                            @foreach($strand->grades as $grade)
                                @if($grade->sections->count() !== 0)
                                    @foreach($grade->sections as $section)
                                        <a
                                            href="{{ route('admin.sections.show', [$strand->id, $section->id]) }}"
                                            class="text-blue-900"
                                        >
                                            <p class="px-6 py-3 {{ $loop->odd && $loop->remaining != 0 ? 'border-b-2' : '' }}">
                                                {{ $section->gradeAndSection() }}
                                            </p>
                                        </a>
                                    @endforeach
                                @endif
                            @endforeach
                        @else
                            <p class="p-2 text-gray-500">There are no grades available yet.</p>
                        @endif
                    </div>
                </div>
            </section>

            <div class="flex space-x-5">
                <x-forms.button name="EDIT" class="bg-gray-200" disabled></x-forms.button>
                <x-forms.button name="DELETE" class="bg-red-200" disabled></x-forms.button>
            </div>
        </div>
    </x-containers.main>

</x-layout>
