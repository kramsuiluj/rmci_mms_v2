<x-layout>
    @include('teachers._header')
    @include('teachers._nav')

    <x-containers.main>
        <x-content-header>RECEIVE MODULE</x-content-header>

        <div class="w-1/2 mx-auto space-x-5">
            <form action="{{ route('teacher.modules.record', [$schedule->id, $student->id]) }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ $student->id }}">
                <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                <input type="hidden" name="status" value="0">

                <x-forms.text-input
                    label="Submitted By"
                    value="{{ $student->fullname() }}"
                    :disabled="true"
                >
                </x-forms.text-input>

                @foreach($errors->all() as $message)
                    <p class="text-xs text-red-500 font-medium -mt-4">{{ $message }}</p>
                @endforeach



                <x-forms.button name="RECORD" class="hover:bg-blue-800"></x-forms.button>
            </form>
        </div>
    </x-containers.main>
</x-layout>
