<x-layout>
    @include('teachers._header')
    @include('teachers._nav')

    <x-containers.main>
        <div class="w-4/5 mx-auto">

            <x-back/>

            <div class="w-4/5 mx-auto mt-5">
                <div>
                    <x-content-header>{{ $assignment->title }}</x-content-header>

                    <div class="border p-5 border-gray-400 rounded-md">
                        {!! \Illuminate\Support\Str::markdown($assignment->content) !!}
                    </div>
                </div>

                <div class="mt-10">
                    <div class="flex items-center justify-between">
                        <x-content-header>Answer</x-content-header>
                    </div>

                    <div class="border p-5 border-gray-400 rounded-md">
                        {!! \Illuminate\Support\Str::markdown($answer->content) !!}
                    </div>
                </div>

                @if($answer->grades == NULL)
                    <div>
                        <form action="{{ route('teacher.answers.update', [$schedule->id, $assignment->id, $answer->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="mt-3 flex items-center space-x-4 mb-10">
                                <input
                                    type="text"
                                    name="grades"
                                    class="block bg-gray-50 w-full shadow p-2 rounded-md border border-gray-300"
                                    placeholder="Enter Grade"
                                >

                                <button class="whitespace-nowrap bg-blue-900 text-white py-2 px-5 rounded-full font-bold">Set Grade</button>
                            </div>
                        </form>
                    </div>
                @else
                    <p class="font-bold text-blue-900 mt-3">
                        GRADES:
                        <span class="text-sm font-medium bg-blue-600 text-white py-1 px-5 rounded-full">
                            {{ $answer->grades }}
                        </span>
                    </p>
                @endif
            </div>
        </div>
    </x-containers.main>
</x-layout>
