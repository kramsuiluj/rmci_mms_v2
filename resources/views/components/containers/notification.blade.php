@props(['href'])

<div class="w-full">
    <div class="border-gray-200 bg-gray-100 mb-2 p-5 border-b-2 flex justify-between">
        <p class="font-primary  text-blue-900 text-sm">
            <a href="{{ $href }}">
                {{ $slot }}
            </a>
        </p>
    </div>
</div>
