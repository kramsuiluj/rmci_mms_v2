@props(['name', 'label', 'value' => '', 'type' => 'text', 'form' => ''])

<section class="pb-5">
    <label for="{{ $name }}" class="text-sm text-blue-900 font-medium">{{ $label }}</label>
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        placeholder="{{ $label }}"
        class="block bg-gray-50 w-full shadow p-2 rounded-md border border-gray-300
            @error($name) border border-red-500 bg-red-50 @enderror
        "
        required
        autocomplete="off"
        form="{{ $form }}"
        style="resize: none"
        rows="5"
    >
        {{ $value }}
    </textarea>

    @error($name)
    <p class="text-xs pt-1 text-red-500 font-medium">{{ $message }}</p>
    @enderror
</section>
