@props(['name', 'type' => 'submit'])

<section class="w-4/5 mx-auto mt-5">
    <button
        {{ $attributes(['class' => 'font-secondary bg-blue-900 font-bold text-white w-full py-2 rounded-full']) }}
        type="{{ $type }}"
    >
        {{ $name }}
    </button>
</section>
