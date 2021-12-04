<x-layout>
    @include('teachers._header')
    @include('teachers._nav')

    <x-containers.main>
        <x-content-header>Enroll Students by File Upload</x-content-header>

        <div class="w-1/2 mx-auto space-x-5">
            <form action="{{ route('teacher.students.storeByFile', $room->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <section>
                    <label
                        for="students"
                        class="text-smT text-blue-900 font-medium block mt-10 mb-5"
                    >
                        Import Student List
                    </label>

                    <input
                        type="file"
                        name="students"
                        id="students"
                        class="appearance-none border w-full border-gray-300 rounded-md p-2 bg-gray-50 shadow-md"
                    >

                    @error('students')
                        <p class="text-red-500 font-medium text-xs mt-1">{{ $message }}</p>
                    @enderror
                </section>

                <section class="mt-5">
                    <button class="font-secondary bg-blue-900 font-bold text-white w-full py-2 rounded-full hover:bg-blue-800">IMPORT FILE</button>
                </section>
            </form>
        </div>
    </x-containers.main>
</x-layout>
