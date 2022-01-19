<x-layout>
    @include('teachers._header')
    @include('teachers._nav')

    <x-containers.main>
        <x-content-header>UPLOAD MODULE</x-content-header>

        <div class="sm:w-1/2 w-4/5 mx-auto">
            <form action="{{ route('teacher.modules.store', $schedule->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                <input type="hidden" name="status" value="0">
                <input type="hidden" name="is_displayed" value="1">

                <section>
                    <label
                        for="module"
                        class="text-smT text-blue-900 font-medium block mt-10 mb-5"
                    >
                        Upload Module
                    </label>

                    <input
                        type="file"
                        name="module"
                        id="module"
                        class="appearance-none border w-full border-gray-300 rounded-md p-2 bg-gray-50 shadow-md"
                    >

                    @error('module')
                        <p class="text-xs pt-1 text-red-500 font-medium">{{ $message }}</p>
                    @enderror

                    @error('filename')
                        <p class="text-xs pt-1 text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </section>

                <section class="mt-5">
                    <button
                        class="font-secondary bg-blue-900 font-bold text-white w-full py-2 rounded-full hover:bg-blue-800"
                    >
                        UPLOAD
                    </button>
                </section>
            </form>
        </div>
    </x-containers.main>
</x-layout>
