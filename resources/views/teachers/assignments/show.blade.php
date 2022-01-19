<x-layout>
    @include('teachers._header')
    @include('teachers._nav')

    <x-containers.main>
        <div class="sm:w-4/5 mx-auto">

            <x-back/>

            <div class="w-4/5 mx-auto mt-5">
                <x-content-header>{{ $assignment->title }}</x-content-header>

                <div class="border p-5 border-gray-400 rounded-md">
                    {!! \Illuminate\Support\Str::markdown($assignment->content) !!}
                </div>
            </div>
        </div>
    </x-containers.main>
</x-layout>
