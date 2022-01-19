<x-layout>

    @include('_admin-header')
    @include('_admin-nav')

    <x-containers.main>
        <x-content-header>CREATE CLASS</x-content-header>

            <form action="{{ route('admin.rooms.store') }}" method="POST" id="create-room">
                @csrf
                <div class="w-4/5 mx-auto sm:flex sm:space-x-5">

                <input type="hidden" name="strand_id" value="{{ $currentStrand->id ?? null }}" form="create-room">
                <input type="hidden" name="grade_id" value="{{ $currentGrade->id ?? null }}" form="create-room">

            <div class="flex-1">
                <section class="flex flex-col mb-5">
                    <div class="flex items-center">
                        <label
                            class="text-sm sm:text-md font-medium mr-1 text-blue-900 font-secondary pb-1"
                        >
                            Select Strand
                        </label>
                    </div>

                    <div x-data="{ open: false }">
                        <button
                            class="p-2 rounded-md shadow font-secondary cursor-pointer w-full text-left {{ $strands->count() === 0 ? 'bg-gray-300 text-gray-500' : 'bg-gray-50 text-blue-900' }}"
                            {{ $strands->count() === 0 ? 'disabled' : '' }}
                            @click="open = !open"
                            type="button"
                        >
                            <p>{{ isset($currentStrand) ? $currentStrand->name : 'SELECT STRAND' }}</p>

                        </button>

                        @error('strand_id')
                            <p class="text-xs mt-1 text-red-500 font-medium">{{ $message }}</p>
                        @enderror

                        <div
                            class="w-full bg-gray-50 rounded-md border border-gray-300 mt-1"
                            x-show="open"
                            @click.away="open = false"
                            style="display: none"
                        >
                            @forelse($strands as $strand)
                                <a href="{{ request()->fullUrlWithQuery(['strand' => $strand->name]) }}">
                                    <div class="p-2 text-blue-900 font-semibold hover:bg-blue-600 rounded-md hover:text-white">
                                        {{ $strand->name }}
                                    </div>
                                </a>
                            @empty
                                <option>There are no strands available yet.</option>
                            @endforelse
                        </div>
                    </div>
                </section>

                <section class="flex flex-col mb-5">
                    <div class="flex items-center">
                        <label
                            class="text-sm sm:text-md font-medium mr-1 text-blue-900 font-secondary pb-1"
                        >
                            Select Grade
                        </label>
                    </div>

                    <div x-data="{ open: false }">
                        <button
                            class="p-2 rounded-md shadow font-secondary cursor-pointer w-full text-left {{ isset($currentStrand->grades) && $currentStrand->grades->count() === 0 ? 'bg-gray-300 text-gray-500' : 'bg-gray-50 text-blue-900' }}"
                            {{ isset($currentStrand->grades) && $currentStrand->grades->count() === 0 ? 'disabled' : '' }}
                            @click="open = !open"
                            type="button"
                        >
                            <p>{{ isset($currentGrade) ? $currentGrade->name : 'SELECT GRADE' }}</p>

                        </button>

                        @error('grade_id')
                            <p class="text-xs mt-1 text-red-500 font-medium">{{ $message }}</p>
                        @enderror

                        <div
                            class="w-full bg-gray-50 rounded-md border border-gray-300 mt-1"
                            x-show="open"
                            @click.away="open = false"
                            style="display: none"
                        >
                            @if(request('strand'))
                                @forelse(\App\Models\Strand::firstWhere('name', request('strand'))->grades as $grade)
                                    <a href="{{ request()->fullUrlWithQuery(['grade' => $grade->name]) }}">
                                        <div class="p-2 text-blue-900 font-semibold hover:bg-blue-600 rounded-md hover:text-white">
                                            {{ $grade->name }}
                                        </div>
                                    </a>
                                @empty
                                    <option>There are no strands available yet.</option>
                                @endforelse
                            @endif
                        </div>
                    </div>
                </section>

                <section class="flex flex-col mb-5">
                    <div class="flex items-center">
                        <label
                            for="semester"
                            class="text-sm sm:text-md font-medium mr-1 text-blue-900 font-secondary pb-1"
                        >
                            Select Semester
                        </label>
                    </div>

                    <select
                        name="semester"
                        id="semester"
                        form="create-room"
                        class="p-2 rounded-md shadow font-secondary cursor-pointer bg-gray-50 text-blue-900"
                    >
                        <option disabled selected>SELECT SEMESTER</option>
                        <option value="1st">1st Semester</option>
                        <option value="2nd">2nd Semester</option>
                    </select>

                    @error('semester')
                    <p class="text-xs mt-1 text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </section>
            </div>

            <div class="flex-1">
                <section class="flex flex-col mb-5">
                    <div class="flex items-center">
                        <label
                            class="text-sm sm:text-md font-medium mr-1 text-blue-900 font-secondary pb-1"
                        >
                            Select Adviser
                        </label>
                    </div>

                    <select
                        name="adviser_id"
                        class="p-2 rounded-md shadow font-secondary cursor-pointer
                        {{ $advisers->count() === 0 ? 'bg-gray-300 text-gray-500' : 'bg-gray-50 text-blue-900' }}"
                        {{ $advisers->count() === 0 ? 'disabled' : '' }}
                        required
                    >
                        @forelse($advisers as $adviser)
                            <option value="{{ $adviser->user->id }}">{{ $adviser->user->fullname() }}</option>
                        @empty
                            <option>There are no teachers available to be an adviser.</option>
                        @endforelse
                    </select>

                    @error('adviser_id')
                    <p class="text-xs mt-1 text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </section>

                <section class="flex flex-col mb-5">
                    <div class="flex items-center">
                        <label
                            for="section_id"
                            class="text-sm sm:text-md font-medium mr-1 text-blue-900 font-secondary pb-1"
                        >
                            Select Section
                        </label>
                    </div>

                    <select
                        name="section_id"
                        id="section_id"
                        class="p-2 rounded-md shadow font-secondary cursor-pointer
                        {{ request('strand') && request('grade') ? \App\Models\Grade::where('strand_id', \App\Models\Strand::firstWhere('name', request('strand'))->id)->firstWhere('name', request('grade'))->sections && \App\Models\Grade::where('strand_id', \App\Models\Strand::firstWhere('name', request('strand'))->id)->firstWhere('name', request('grade'))->sections->count() === 0 ? 'bg-gray-300 text-gray-500' : 'bg-gray-50 text-blue-900' : '' }}
                            {{ request('grade') ?? 'bg-gray-300 text-gray-500' }}
                            "
                        {{ request('strand') && request('grade') ? \App\Models\Grade::where('strand_id', \App\Models\Strand::firstWhere('name', request('strand'))->id)->where('name', request('grade'))->first()->sections && \App\Models\Grade::where('strand_id', \App\Models\Strand::firstWhere('name', request('strand'))->id)->firstWhere('name', request('grade'))->sections->count() === 0 ? 'disabled' : '' : '' }}
                         {{ request('grade') ?? 'disabled' }}
                        required
                    >
                        @if(request('grade'))
                            @forelse(\App\Models\Grade::where('strand_id', \App\Models\Strand::firstWhere('name', request('strand'))->id)->firstWhere('name', request('grade'))->sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @empty
                                <option disabled selected>There are no sections available yet.</option>
                            @endforelse
                        @else
                            <option disabled selected>There are no sections available yet.</option>
                        @endif
                    </select>

                    @error('section_id')
                    <p class="text-xs mt-1 text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </section>
            </div>
                </div>

            </form>


        <section class="sm:w-72 sm:ml-36 w-64 ml-16">
            <button type="submit" form="create-room" class="bg-blue-900 w-full py-2 rounded-full text-white font-bold hover:bg-blue-600">CREATE CLASS</button>
        </section>
    </x-containers.main>

</x-layout>
