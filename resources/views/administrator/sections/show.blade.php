<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header class="text-blue-900">EDIT SECTIONS</x-content-header>

        <div class="w-1/2 mx-auto">
            <section class="pb-5">
                <label for="name" class="text-sm text-blue-900 font-medium block pb-5">Select Strand Grade</label>

                <div x-data="{ open: false }">
                    <button
                        class="w-full bg-gray-50 py-2 text-left pl-5 border border-gray-300 text-blue-900 font-semibold rounded-tl-md rounded-tr-md"
                        @click="open = !open"
                    >
                        {{ isset($section) ? $section->gradeAndSection() : 'SELECT GRADE' }}
                    </button>

                    <div
                        class="w-full border bg-blue-50 rounded-bl-md rounded-br-md"
                        x-show="open"
                        @click.away="open = false"
                        style="display: none"
                    >
{{--                        @forelse($strand->grades as $grade)--}}
{{--                            @forelse($grade->sections as $section)--}}
{{--                                <a class="text-blue-900" href="{{ route('admin.sections.show', [$strand->id, $section->id]) }}">--}}
{{--                                    <div class="px-6 py-3 {{ $loop->odd ? 'border-b-2' : '' }}">--}}
{{--                                        {{ $section->gradeAndSection() }}--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            @empty--}}
{{--                                @break--}}
{{--                            @endforelse--}}
{{--                        @empty--}}
{{--                            There are no grades and sections available yet.--}}
{{--                        @endforelse--}}
                        @foreach($strand->grades as $grade)
                            @foreach($grade->sections as $sec)
                                <a
                                    href="{{ route('admin.sections.show', [$strand->id, $sec->id]) }}"
                                    class="text-blue-900"
                                >
                                    <div class="px-6 py-3 {{ $loop->odd ? 'border-b-2' : '' }}">
                                        <p>{{ $sec->gradeAndSection() }}</p>
                                    </div>
                                </a>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </section>

            <div class="flex space-x-5">
                <div class="w-full">
                    <a href="{{ route('admin.sections.edit', [$strand->id, $section->id]) }}">
                        <x-forms.button name="EDIT" class="hover:bg-blue-600"></x-forms.button>
                    </a>
                </div>
                <div class="w-full" x-data="{ open: false }">
                    <x-forms.button name="DELETE" class="bg-red-500 hover:bg-red-600" @click="open = !open"></x-forms.button>

                    <div
                        class="border bg-gray-50 rounded-md w-4/5 mx-auto mt-2"
                        x-show="open"
                        @click.away="open = false"
                        style="display: none"
                    >
                        <div class="p-2">
                            <p class="text-sm">Are you sure you want to delete this section?</p>

                            <form
                                action="{{ route('admin.sections.destroy', [$strand->id, $section->id]) }}"
                                class="flex space-x-2"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')

                                    <x-forms.button
                                        name="Confirm"
                                        class="text-xs"
                                        type="submit"
                                    >
                                    </x-forms.button>

                                    <x-forms.button
                                        name="Cancel"
                                        type="button"
                                        class="text-xs bg-gray-500"
                                        @click="open = false"
                                    >
                                    </x-forms.button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-containers.main>

</x-layout>
