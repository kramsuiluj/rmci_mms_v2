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
                            <x-containers.notification
                                :href="route('student.modules.index', $notification->data['schedule_id'])"
                            >
                                A new module has been uploaded in
                                <span class="font-medium">
                                    {{ \App\Models\Schedule::find($notification->data['schedule_id']) ? \App\Models\Schedule::find($notification->data['schedule_id'])->subject->name : 'Deleted Subject' }}
                                </span>
                            </x-containers.notification>
                        @endif

                        @if($notification->type === 'App\Notifications\CheckModule')
                            <x-containers.notification
                                :href="route('student.modules.submitted', $notification->data['schedule_id'])"
                            >
                                <span class="font-medium italic">
                                    {{ \App\Models\Module::find($notification->data['module_id'])->getFirstMedia()->file_name ?? 'offline' }}
                                </span>
                                in
                                <span class="font-medium">
                                    {{ \App\Models\Schedule::find($notification->data['schedule_id'])->subject->name }}
                                </span>
                                has been checked.
                            </x-containers.notification>
                        @endif

                            @if($notification->type === 'App\Notifications\TeacherCommented')
                                <x-containers.notification
                                    :href="route('student.modules.show', [$notification->data['schedule']['id'], $notification->data['module']['id']])"
                                >
                                    <span class="font-medium">
                                        {{ $notification->data['schedule']['room']['adviser']['lastname'] }}, {{ $notification->data['schedule']['room']['adviser']['firstname'] . ' ' .  substr($notification->data['schedule']['room']['adviser']['middlename'], 0, 1) . '.'}}
                                    </span>
                                    has commented to your submitted module
                                    {!! \App\Models\Module::find($notification->data['module']['id'])->getFirstMedia() ? "<span class='font-medium italic'>" . \App\Models\Module::find($notification->data['module']['id'])->getFirstMedia()->file_name . "</span>" : "<span class='font-medium italic'>" . \App\Models\Module::find($notification->data['module']['id'])->module . "</span>" !!}
                                    in
                                    <span class="font-medium">
                                        {{ \App\Models\Module::find($notification->data['module']['id'])->schedule->subject->name }}
                                    </span>
                                </x-containers.notification>
                            @endif

                            @if($notification->type === 'App\Notifications\AnswerChecked')
                                <x-containers.notification
                                    :href="route('student.assignments.show', [$notification->data['schedule']['id'], $notification->data['assignment']['id']])"
                                >
                                    Your answer in assignment
                                    <span class="font-medium">
                                        {{ $notification->data['assignment']['title'] }}
                                    </span>
                                    has been checked and graded.
                                </x-containers.notification>
                            @endif

                            @if($notification->type === 'App\Notifications\AssignmentPublished')
                                <x-containers.notification
                                    :href="route('student.assignments.show', [$notification->data['schedule']['id'], $notification->data['assignment']['id']])"
                                >
                                    A new assignment
                                    <span class="font-medium italic">{{ $notification->data['assignment']['title'] }}</span>
                                    has been published in
                                    <span class="font-medium">
                                        {{ \App\Models\Subject::find($notification->data['schedule']['subject_id']) ? \App\Models\Subject::find($notification->data['schedule']['subject_id'])->name : 'Deleted Subject' }}
                                    </span>
                                    by
                                    <span class="font-medium">
                                        {{ \App\Models\User::find($notification->data['teacher']['id'])->fullname() }}
                                    </span>
                                </x-containers.notification>
                            @endif
                @endforeach

            </div>
        </div>
    </x-containers.main>
</x-layout>
