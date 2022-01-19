<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header>SET GRADE TO STRAND</x-content-header>

        <div class="sm:w-1/2 w-4/5 mx-auto space-x-5">
            <form action="{{ route('admin.grades.store', $strand->id) }}" method="POST" id="create-grade">
                @csrf

                <section class="pb-5">
                    <label class="text-sm text-blue-900 font-medium">Strand Name</label>
                    <input
                        value="{{ $strand->name }}"
                        class="block bg-gray-50 w-full shadow p-2 rounded-md border border-gray-300 text-gray-500"
                        disabled
                    >
                </section>

                <section class="pb-5">
                    <label for="name" class="text-sm text-blue-900 font-medium block pb-5">Select Grade</label>

                    <select
                        name="name"
                        id="name"
                        class="bg-gray-50 w-full shadow p-2 rounded-md border border-gray-300 text-blue-900
                                @error('name') border-red-500 bg-red-50 @enderror
                        "
                        form="create-grade"
                    >
                        <option value="11" class="appearance-none">Grade - 11</option>
                        <option value="12" class="appearance-none">Grade - 12</option>
                    </select>

                    @error('name')
                    <p class="text-xs pt-1 text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </section>

                <x-forms.button name="SET GRADE"></x-forms.button>
            </form>
        </div>
    </x-containers.main>

</x-layout>
