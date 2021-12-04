<x-layout>
    @include('teachers._header')
    @include('teachers._nav')

    <x-containers.main>
        <div class="mb-10">
            <div class="text-blue-900 space-y-3">
                <p class="text-sm font-extrabold">
                    FILE NAME: <span class="font-medium text-base text-blue-600">{{ $module->getFirstMedia()->file_name ?? 'File Submitted Offiline' }}</span>
                </p>
                <p class="text-sm font-extrabold">
                    UPLOADED BY: <span class="font-medium text-base text-blue-600">{{ $module->user->fullname() }}</span>
                </p>
                <p class="text-sm font-extrabold">
                    UPLOAD DATE: <span class="font-medium text-base text-blue-600">{{ $module->created_at }}</span>
                </p>
                <p class="text-sm font-extrabold">
                    STATUS: <span class="font-medium py-0.5 px-5 rounded-full text-white {{ $module->status === 0 ? 'bg-blue-600' : 'bg-green-600' }}">{{ $module->status === 0 ? 'Submitted for Checking' : 'Checked' }}</span>
                </p>
            </div>
        </div>

        <x-content-header>COMMENTS</x-content-header>

        @if($comments->count() !== 0)
            <div class="space-y-5 border-2 border-gray-400 p-5 rounded-md">
                @foreach($comments as $comment)
                    <div class="space-y-1">
                        <h2 class="text-blue-600">
                            @if($comment->user->profile_type === 'App\Models\StudentProfile')
                                <span class="bg-blue-900 text-white text-sm py-0.5 px-5 rounded-full">Student</span>
                            @else
                                <span class="bg-green-900 text-white text-sm py-0.5 px-5 rounded-full">You</span>
                            @endif
                            {{ $comment->user->fullname() }}
                        </h2>

                        <p class="ml-24 border p-2 border-gray-400 bg-gray-50">
                            {{ $comment->body }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">There are no comments yet.</p>
        @endif

        <div class="mt-5">
            <form action="{{ route('teacher.comments.store', [$schedule->id, $module->id]) }}" method="POST">
                @csrf

                <section>
                    <label for="body" class="block">Add Comment</label>

                    <textarea
                        name="body"
                        id="body"
                        cols="30"
                        rows="5"
                        style="resize: none"
                        class="border border-gray-400"
                    >
                        {{ old('body') }}
                    </textarea>
                </section>

                <section class="mt-3">
                    <button class="bg-blue-900 text-white py-2 px-10 rounded-full">Comment</button>
                </section>
            </form>
        </div>
    </x-containers.main>
</x-layout>
