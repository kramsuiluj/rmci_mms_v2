<x-layout>
    <body class="antialiased">
        <div class="relative flex justify-center items-top min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">

            <div class="flex-col space-y-5">
                <div class="flex justify-center">
                    <a href="/">
                        <div class="flex items-center cursor-pointer">
                            <img src="{{ asset('images/rmci-logo.png') }}" alt="RMCI Logo" class="w-16 sm:w-32">

                            <h3 class="text-blue-900 font-black sm:text-4xl hover:text-blue-600">
                                RMCI
                                <span class="text-blue-600 italic font-semibold -ml-1 hover:text-blue-900">MMS</span>
                            </h3>
                        </div>
                    </a>
                </div>

                <div>
                    <p class="text-gray-500 text-2xl font-medium">PAGE NOT FOUND <span class="font-extralight">|</span> QRCODE IS INVALID</p>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="flex items-center justify-center space-x-1">
                        <span class="font-bold text-gray-700 underline">Go Back to Previous Page</span>
                    </a>
                </div>
            </div>

        </div>
    </body>
</x-layout>
