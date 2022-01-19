<x-layout>
    @include('students._header')
    @include('students._nav')

    <x-containers.main>
        <div class="sm:w-4/5 mx-auto">

            <x-back/>

            <div class="sm:w-4/5 mx-auto mt-5">
                <div>
                    <x-content-header>{{ $assignment->title }}</x-content-header>

                    <div class="border p-5 border-gray-400 rounded-md">
                        {!! \Illuminate\Support\Str::markdown($assignment->content) !!}
                    </div>
                </div>

                <br>
                <hr>
                <br>

                <div>
                    <div class="flex items-center justify-between">
                        <x-content-header>Answer</x-content-header>
                        @if(isset($answer))
                            @if($answer->count() !== 0 && $answer->grades === NULL)
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('student.answers.edit', [$schedule->id, $assignment->id, $answer->id]) }}" class="rounded-md bg-green-500 text-white py-2 px-3 font-medium flex items-center space-x-2" title="Edit Answer">
                                        <x-icons.edit class="h-5 w-5"/>
                                    </a>
                                    <form action="{{ route('student.answers.destroy', [$schedule->id, $assignment->id, $answer->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-md bg-red-500 text-white py-2 px-3 font-medium flex items-center space-x-2">
                                            <x-icons.remove class="h-5 w-5"/>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endif
                    </div>

                    @if(isset($answer))
                        @if($answer->count() === 0)

                        @else
                            <div class="mb-10">
                                <div class="border p-5 border-gray-400 rounded-md">
                                    {!! \Illuminate\Support\Str::markdown($answer->content) !!}
                                </div>

                                <div class="mt-3 space-y-2">
                                    <p class="font-bold text-blue-900">
                                        STATUS:
                                        @if($answer->status === 0)
                                            <span class="text-sm font-medium bg-blue-600 text-white py-1 px-5 rounded-full">Submitted for Grading</span>
                                        @else
                                            <span class="text-sm font-medium bg-green-600 text-white py-1 px-5 rounded-full">Checked</span>
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
                                    @if($answer->grades !== NULL)
                                        <p class="font-bold text-blue-900">
                                            GRADES:
                                            <span class="text-sm font-medium bg-blue-600 text-white py-1 px-5 rounded-full">{{ $answer->grades }}</span>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif

                    @else
                        <div>
                            <form action="{{ route('student.answers.store', [$schedule->id, $assignment->id]) }}" method="POST" id="createAssignment" class="mb-10">
                                @csrf

                                <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                                <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="status" value="0">

                                <section class="pb-5">
                                    <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                                    <input type="hidden" name="content" id="content">
                                </section>

                                <section>
                                    <button class="bg-blue-900 text-white py-2 px-10 rounded-full font-semibold">SEND ANSWER</button>
                                </section>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-containers.main>
</x-layout>
