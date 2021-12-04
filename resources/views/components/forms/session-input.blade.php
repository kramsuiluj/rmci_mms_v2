@props(['type' => 'text', 'placeholder', 'name', 'value' => ''])

<div class="w-4/5 mx-auto mt-5">

    <div class="mb-2">
        <label for="{{ $name }}" class="text-blue-600 font-medium">{{ $placeholder }}</label>
    </div>

    <div class="flex bg-gray-50 px-4 py-2 space-x-2 items-center border rounded-full shadow-md">
        <div>
            {{ $slot }}
        </div>
        <div class="flex-1">
            <input
                type="{{ $type }}"
                class="w-full bg-gray-50 outline-none"
                placeholder="{{ $placeholder }}"
                name="{{ $name }}"
                value="{{ $value }}"
                autocomplete="off"
            >
        </div>
    </div>

    @error($name)
    <p class="text-xs pt-1 text-red-500 font-medium">{{ $message }}</p>
    @enderror
</div>


