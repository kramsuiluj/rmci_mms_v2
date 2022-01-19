<x-layout>
    @include('teachers._header')
    @include('teachers._nav')

    <x-containers.main>
        <x-content-header>CREATE ASSIGNMENT</x-content-header>

        <div class="sm:w-4/5 mx-auto mb-10">
            <div class="sm:w-4/5 mx-auto">
                <form action="{{ route('teacher.assignments.store', $schedule->id) }}" method="POST" id="createAssignment">
                    @csrf

                    <x-forms.text-input name="title" label="Assignment Title" value="{{ old('title') }}" form="createAssignment"/>

                    <section class="mb-5">
                        <label for="expired_at" class="text-sm text-blue-900 font-medium block mb-1">Due Date</label>
                        <input type="datetime-local" name="expired_at" id="expired_at" class="block bg-gray-50 shadow p-2 rounded-md border border-gray-300 text-gray-700">
                        @error('expired_at')
                        <p class="text-xs pt-1 text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </section>

                    <section class="pb-5">
                        <label for="content" class="text-sm text-blue-900 font-medium">Content</label>
                        <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                        <input type="hidden" name="content" id="content">
                        @error('content')
                        <p class="text-xs pt-1 text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </section>

                    <section>
                        <button class="bg-blue-900 text-white py-2 px-10 rounded-full font-semibold">PUBLISH ASSIGNMENT</button>
                    </section>
                </form>
            </div>
        </div>
    </x-containers.main>
</x-layout>
