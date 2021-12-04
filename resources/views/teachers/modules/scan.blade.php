<x-layout>
    @include('teachers._header')
    @include('teachers._nav')

    <x-containers.main>
        <x-content-header>SCAN MODULE QR CODE</x-content-header>

        <div class="w-1/2 mx-auto space-x-5">
            <video id="preview" class="border-4 w-96 border-blue-900"></video>

            <script type="text/javascript">
                let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
                scanner.addListener('scan', function (content) {
                    alert('Scan Completed!')
                        window.location.replace(content);
                });
                Instascan.Camera.getCameras().then(function (cameras) {
                    if (cameras.length > 0) {
                        scanner.start(cameras[0]);
                    } else {
                        console.error('No cameras found.');
                    }
                }).catch(function (e) {
                    console.error(e);
                });
            </script>
        </div>

    </x-containers.main>
</x-layout>
