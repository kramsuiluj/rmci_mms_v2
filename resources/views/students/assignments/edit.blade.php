<x-layout>
    @include('students._header')
    @include('students._nav')

    <x-containers.main>
        <div class="w-4/5 mx-auto">

            <x-back/>

            <div class="w-4/5 mx-auto mt-5">
                <div>
                    <x-content-header>{{ $assignment->title }}</x-content-header>

                    <div class="border p-5 border-gray-400 rounded-md">
                        {!! \Illuminate\Support\Str::markdown($assignment->content) !!}
                    </div>

                    <div class="mt-3 space-y-2">
                        <p class="font-bold text-blue-900">
                            STATUS:
                            @if($answer->status === 0)
                                <span class="text-sm font-medium bg-blue-600 text-white py-1 px-5 rounded-full">Submitted for Grading</span>
                            @endif
                        </p>
                        <p class="font-bold text-blue-900">
                            SUBMITTED DATE:
                            <span class="text-sm font-medium bg-gray-600 text-white py-1 px-5 rounded-full">{{ $answer->created_at }}</span>
                        </p>
                        <p class="font-bold text-blue-900">
                            UPDATED DATE:
                            <span class="text-sm font-medium bg-gray-600 text-white py-1 px-5 rounded-full">{{ $answer->updated_at }}</span>
                        </p>
                    </div>
                </div>

                <br>
                <hr>
                <br>

                <div>
                    <div class="flex items-center justify-between">
                        <x-content-header>Answer</x-content-header>
                    </div>

                        <div>
                            <form action="{{ route('student.answers.update', [$schedule->id, $assignment->id, $answer->id]) }}" method="POST" id="createAssignment" class="mb-10">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                                <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="status" value="0">

                                <section class="pb-5">
                                    <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        {{ $answer->content }}
                                    </div>
                                    <input type="hidden" name="content" id="content">
                                </section>

                                <section>
                                    <button class="bg-blue-900 text-white py-2 px-10 rounded-full font-semibold">UPDATE ANSWER</button>
                                </section>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </x-containers.main>
</x-layout>
