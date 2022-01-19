<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header>EDIT SCHEDULE</x-content-header>

        <div class="sm:w-1/2 w-4/5 mx-auto space-x-5">
            <form action="{{ route('admin.schedules.update', [$room->id, $schedule->id]) }}" method="POST">
                @csrf
                @method('PATCH')

                <input type="hidden" name="room_id" value="{{ $room->id }}">

                <x-forms.text-input
                    label="Room"
                    value="{{ $room->strand->name . ' | ' .$room->section->gradeAndSection() }}"
                    :disabled="true"
                >
                </x-forms.text-input>

                <section class="flex flex-col mb-5">
                    <div class="flex items-center">
                        <label
                            for="semester"
                            class="text-sm sm:text-md font-medium mr-1 text-blue-900 font-secondary pb-1"
                        >
                            Select Subject
                        </label>
                    </div>

                    <select
                        name="subject_id"
                        id="subject_id"
                        class="p-2 rounded-md shadow font-secondary cursor-pointer bg-gray-50 text-blue-900"
                    >
                        <option disabled>SELECT SUBJECT</option>
                        @forelse($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ $schedule->subject_id === $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @empty
                            <option disabled {{ $subjects->count() === 0 ? 'selected' : '' }}>There are no subjects available yet.</option>
                        @endforelse
                    </select>

                    @error('subject_id')
                    <p class="text-xs mt-1 text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </section>

                <section class="flex flex-col mb-5">
                    <div class="flex items-center">
                        <label
                            for="teacher_id"
                            class="text-sm sm:text-md font-medium mr-1 text-blue-900 font-secondary pb-1"
                        >
                            Select Teacher
                        </label>
                    </div>

                    <select
                        name="teacher_id"
                        id="teacher_id"
                        class="p-2 rounded-md shadow font-secondary cursor-pointer bg-gray-50 text-blue-900"
                    >
                        @forelse($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ $schedule->teacher_id === $teacher->id ? 'selected' : '' }}>{{ $teacher->fullname() }}</option>
                        @empty
                            <option disabled {{ $teachers->count() === 0 ? 'selected' : '' }}>There are no teachers available yet.</option>
                        @endforelse
                    </select>

                    @error('teacher_id')
                    <p class="text-xs mt-1 text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </section>

                <x-forms.button name="UPDATE"></x-forms.button>
            </form>
        </div>
    </x-containers.main>

</x-layout>
