<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header class="text-red-500">DELETE GRADE</x-content-header>

        <div class="w-1/2 mx-auto">
                <section class="pb-5">
                    <label for="name" class="text-sm text-blue-900 font-medium block pb-5">Select Strand Grade</label>

                    <div x-data="{ open: false }">
                        <button
                            class="w-full bg-gray-50 py-2 text-left pl-5 border border-gray-300 text-blue-900 font-semibold rounded-tl-md rounded-tr-md"
                            @click="open = !open"
                        >
                            SELECT GRADE
                        </button>

                        <div
                            class="w-full border bg-blue-50 rounded-bl-md rounded-br-md"
                            x-show="open"
                            @click.away="open = false"
                            style="display: none"
                        >
                            @forelse($strand->grades as $grade)
                                    <a class="text-blue-900" href="{{ route('admin.grades.show', [$strand->id, $grade->id]) }}">
                                        <div class="px-6 py-3 {{ $loop->odd ? 'border-b-2' : '' }}">
                                            {{ $grade->strand->name . ' - ' . $grade->name }}
                                        </div>
                                    </a>
                            @empty
                                <p>This strand does not have grades.</p>
                            @endforelse
                        </div>
                    </div>
                </section>

                <x-forms.button name="DELETE" class="bg-gray-400" disabled></x-forms.button>
        </div>
    </x-containers.main>

</x-layout>
