<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header class="text-red-500">DELETE GRADE</x-content-header>

        <div class="sm:w-1/2 w-4/5 mx-auto">
            <section class="pb-5">
                <label for="name" class="text-sm text-blue-900 font-medium block pb-5">Select Strand Grade</label>

                <div x-data="{ open: false }" class="">
                    <button
                        class="w-full bg-gray-50 py-2 text-left pl-5 border border-gray-300 text-blue-900 font-semibold rounded-md"
                        @click="open = !open"
                    >
                        {{ isset($grade) ? $grade->strand->name . ' - ' . $grade->name : 'SELECT GRADE' }}
                    </button>

                    <div
                        class="w-full border bg-blue-50 mt-0.5 rounded-md"
                        x-show="open"
                        @click.away="open = false"
                        style="display: none"
                    >
                        @forelse($strand->grades as $grade)
                            <a class="text-blue-900" href="{{ route('admin.grades.show', [$strand->id, $grade->id]) }}">
                                <div class="px-6 py-3 {{ $loop->odd && $loop->remaining != 0 ? 'border-b-2' : '' }}">
                                    {{ $grade->strand->name . ' - ' . $grade->name }}
                                </div>
                            </a>
                        @empty
                            <p>This strand does not have grades.</p>
                        @endforelse
                    </div>
                </div>
            </section>

            <div x-data="{ open: false }">
                <x-forms.button name="DELETE" class="bg-red-500 hover:bg-red-600" type="button" @click="open = true"></x-forms.button>

                <div class="w-4/5 mx-auto" x-show="open" style="display: none">
                    <form action="{{ route('admin.grades.destroy', [$strand->id, $grade->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="p-5 bg-gray-50 border rounded-md mt-2">
                            <p class="text-blue-900 font-medium text-center">Are you sure you want to delete this grade?</p>

                            <div class="flex space-x-5">
                                <x-forms.button
                                    name="Confirm"
                                    class="text-base hover:bg-blue-600"
                                    type="submit"
                                >
                                </x-forms.button>

                                <x-forms.button
                                    name="Cancel"
                                    type="button"
                                    class="bg-gray-400 hover:bg-gray-600"
                                    @click="open = false"
                                >
                                </x-forms.button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-containers.main>

</x-layout>
