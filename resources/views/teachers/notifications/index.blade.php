<x-layout>
    @include('teachers._header')
    @include('teachers._nav')

    <x-containers.main>
        <div>
            <h2 class="font-primary font-medium bg-blue-600 text-white pl-2 py-2 rounded-md">Notifications</h2>

            @if($notifications->count() === 0)
                <p class="font-primary text-md text-gray-500 text-center mt-2">Your notification page is empty.</p>
            @else
                <div class="flex justify-end mt-5">
                    <a href="{{ route('teacher.notifications.read') }}" class="font-primary bg-gray-300 py-1.5 px-2.5 text-gray-600 font-semibold rounded-sm border border-gray-400 text-sm">Mark read</a>
                </div>
            @endif



            <div class="mt-5">
                @foreach($notifications as $notification)
                    @if($notification->type === 'App\Notifications\SubmitModule')
                        <div class="w-full">
                            <div class="border-gray-200 bg-gray-100 mb-2 p-5 border-b-2 flex justify-between">
                                <p class="font-primary  text-blue-900 text-sm">
                                    <a href="{{ route('teacher.modules.indexByStudent', $notification->data['schedule_id']) }}">
                                        @if(App\Models\User::find($notification->data['user_id']))
                                            <span class="font-medium">{{ \App\Models\User::find($notification->data['user_id'])->fullname() }}</span>
                                        @else
                                            <span class="font-medium">Deleted User</span>
                                        @endif
                                        has submitted a module on your subject

                                         @if(\App\Models\Schedule::find($notification->data['schedule_id']))
                                            <span class="font-medium">{{ \App\Models\Schedule::find($notification->data['schedule_id'])->subject->name }}</span>
                                         @else
                                             <span class="font-medium">Deleted Subject</span>
                                         @endif
                                    </a>
                                </p>
                            </div>

                        </div>
                    @endif

                        @if($notification->type === 'App\Notifications\StudentCommented')
                            <div class="w-full">
                                <div class="border-gray-200 bg-gray-100 mb-2 p-5 border-b-2 flex justify-between">
                                    <p class="font-primary  text-blue-900 text-sm">
                                        <a href="{{ route('teacher.modules.comment', [$notification->data['schedule'], $notification->data['module_id']]) }}">
                                            @if (\App\Models\User::find($notification->data['user_id']))
                                                <span class="font-medium">{{ \App\Models\User::find($notification->data['user_id'])->fullname() }}</span>
                                            @else
                                                <span class="font-medium">Deleted User</span>
                                            @endif
                                            has commented on a module submission


                                            @if(\App\Models\Module::find($notification->data['module_id']))
                                                <span class="font-medium italic">
                                                    {{ \App\Models\Module::find($notification->data['module_id'])->getFirstMedia()->file_name }}
                                                </span>
                                            @else
                                                <span class="font-medium italic">Deleted Module</span>
                                            @endif
                                            in
                                            <span class="font-medium"></span>
                                            @if (\App\Models\Schedule::find($notification->data['schedule']))
                                                    {{ \App\Models\Schedule::find($notification->data['schedule'])->subject->name }}
                                            @else
                                                <span class="font-medium">Deleted Subject</span>
                                            @endif
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if($notification->type === 'App\Notifications\SendAnswer')
                            <div class="w-full">
                                <div class="border-gray-200 bg-gray-100 mb-2 p-5 border-b-2 flex justify-between">
                                    <p class="font-primary  text-blue-900 text-sm">
                                        <a href="{{ route('teacher.answers.index', [$notification->data['schedule']['id'], $notification->data['assignment']['id']]) }}">
                                            @if (App\Models\User::find($notification->data['student']['id']))
                                                <span class="font-medium">
                                                    {{ \App\Models\User::find($notification->data['student']['id'])->fullname() }}
                                                </span>
                                            @else
                                                <span class="font-medium">Deleted User</span>
                                            @endif
                                            has submitted an answer to your assignment
                                            <span class="font-medium">{{ $notification->data['assignment']['title'] }}</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if($notification->type === 'App\Notifications\AnswerUpdated')
                            <div class="w-full">
                                <div class="border-gray-200 bg-gray-100 mb-2 p-5 border-b-2 flex justify-between">
                                    <p class="font-primary  text-blue-900 text-sm">
                                        <a href="{{ route('teacher.answers.index', [$notification->data['schedule']['id'], $notification->data['assignment']['id']]) }}">
                                            @if (\App\Models\User::find($notification->data['student']['id']))
                                            <span class="font-medium">
                                                {{ \App\Models\User::find($notification->data['student']['id'])->fullname() }}
                                            </span>
                                            @else
                                                <span class="font-medium">Deleted User</span>
                                            @endif
                                            has updated the answer to your assignment
                                            <span class="font-medium">{{ $notification->data['assignment']['title'] }}</span>
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
