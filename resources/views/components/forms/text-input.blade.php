@props(['name' => '', 'label', 'value' => '', 'type' => 'text', 'form' => '', 'disabled' => false])

<section class="pb-5">
    <label for="{{ $name }}" class="text-sm text-blue-900 font-medium">{{ $label }}</label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        placeholder="{{ $label }}"
        value="{{ $value }}"
        class="block bg-gray-50 w-full shadow p-2 rounded-md border border-gray-300
                @error($name) border border-red-500 bg-red-50 @enderror
            "
        required
        autocomplete="off"
        form="{{ $form }}"
        {{ $attributes(['disabled' => $disabled]) }}
    >

    @error($name)
        <p class="text-xs pt-1 text-red-500 font-medium">{{ $message }}</p>
    @enderror
</section>
