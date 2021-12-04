<x-layout>
    @include('students._header')
    @include('students._nav')

    <x-containers.main>
        <div>
            <h2 class="font-primary font-medium bg-blue-600 text-white pl-2 py-2 rounded-md">Notifications</h2>

            @if($notifications->count() === 0)
                <p class="font-primary text-md text-gray-500 text-center mt-2">Your notification page is empty.</p>
            @else
                <div class="flex justify-end mt-5">
                    <a href="{{ route('student.notifications.read') }}" class="font-primary bg-gray-300 py-1.5 px-2.5 text-gray-600 font-semibold rounded-sm border border-gray-400 text-sm">Mark read</a>
                </div>
            @endif



            <div class="mt-5">
                @foreach($notifications as $notification)
                        @if($notification->type === 'App\Notifications\ModuleUploaded')
                            <div class="w-full">
                                <div class="border-gray-200 bg-gray-100 mb-2 p-5 border-b-2 flex justify-between">
                                    <p class="font-primary  text-blue-900 text-sm">
                                        <a href="{{ route('student.modules.index', $notification->data['schedule_id']) }}">
                                            A new module has been uploaded in
                                            <span class="font-medium">{{ \App\Models\Schedule::find($notification->data['schedule_id'])->subject->name }}</span>
                                        </a>
                                    </p>
                                </div>

                            </div>
                        @endif

                        @if($notification->type === 'App\Notifications\CheckModule')
                            <div class="w-full">
                                <div class="border-gray-200 bg-gray-100 mb-2 p-5 border-b-2 flex justify-between">
                                    <p class="font-primary  text-blue-900 text-sm">
                                        <a href="{{ route('student.modules.submitted', $notification->data['schedule_id']) }}">
                                            The module you submitted
                                            <span class="font-medium italic">
                                                {{ \App\Models\Module::find($notification->data['module_id'])->getFirstMedia()->file_name ?? 'offline' }}
                                            </span>
                                            in
                                            <span class="font-medium">
                                                {{ \App\Models\Schedule::find($notification->data['schedule_id'])->subject->name }}
                                            </span>
                                            has been checked.
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endif

                            @if($notification->type === 'App\Notifications\TeacherCommented')
                                <div class="w-full">
                                    <div class="border-gray-200 bg-gray-100 mb-2 p-5 border-b-2 flex justify-between">
                                        <p class="font-primary  text-blue-900 text-sm">
                                                                                        <a href="{{ route('student.modules.show', [$notification->data['schedule']['id'], $notification->data['module']['id']]) }}">
                                                <span class="font-medium">{{ \App\Models\User::find($notification->data['comment']['user_id'])->fullname() }}</span>
                                                has commented to your submitted module
                                                <span class="font-medium italic">{{ \App\Models\Module::find($notification->data['module']['id'])->getFirstMedia()->file_name }}</span>
                                                in
                                                <span class="font-medium">{{ \App\Models\Module::find($notification->data['module']['id'])->schedule->subject->name }}</span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @if($notification->type === 'App\Notifications\AnswerChecked')
                                <div class="w-full">
                                    <div class="border-gray-200 bg-gray-100 mb-2 p-5 border-b-2 flex justify-between">
                                        <p class="font-primary  text-blue-900 text-sm">
                                            <a href="{{ route('student.assignments.show', [$notification->data['schedule']['id'], $notification->data['assignment']['id']]) }}">
                                                Your answer in assignment
                                                <span class="font-medium">{{ $notification->data['assignment']['title'] }}</span>
                                                has been checked and graded.
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @if($notification->type === 'App\Notifications\AssignmentPublished')
                                <div class="w-full">
                                    <div class="border-gray-200 bg-gray-100 mb-2 p-5 border-b-2 flex justify-between">
                                        <p class="font-primary  text-blue-900 text-sm">
                                            <a href="{{ route('student.assignments.show', [$notification->data['schedule']['id'], $notification->data['assignment']['id']]) }}">
                                                A new assignment
                                                <span class="font-medium italic">{{ $notification->data['assignment']['title'] }}</span>
                                                has been published in
                                                <span class="font-medium">
                                                    {{ \App\Models\Subject::find($notification->data['schedule']['subject_id'])->name }}
                                                </span>
                                                by
                                                <span class="font-medium">
                                                    {{ \App\Models\User::find($notification->data['teacher']['id'])->fullname() }}
                                                </span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            @endif
                @endforeach

            </div>
        </div>
    </x-containers.main>
</x-layout>
