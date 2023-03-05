<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('QR Code Scanner') }}
        </h2>
    </x-slot>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <video id="preview"></video>
            <script type="text/javascript">
                let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
                scanner.addListener('scan', function (content) {
                    console.log('#content',content);
                    let qr_code = content.toString();
                    $.ajax({
                        type:"POST",
                        url: "{{ route('attendance.store')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            code: qr_code
                        },
                        success:function(response){
                            if(response == 200){
                                alert('Attendance added');
                            }
                            if(response == 500){
                                alert('Attendance already done');
                            }
                            if(response == 404){
                                alert('User doesnot exits');
                            }
                            console.log('@response',response);
                        },
                        error:function(error){
                            console.log(error);
                        }
                    })
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
        </div>
    </div>
</x-app-layout>
