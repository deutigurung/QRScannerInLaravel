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
                // Check if the browser supports getUserMedia
                if (navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function(stream) {
                        // Stream obtained successfully, you can now use it
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
                            if(cameras.lenght > 1){
                                scanner.start(cameras[1]);
                            }else if (cameras.length > 0) {
                                scanner.start(cameras[0]);
                            } else {
                                alert('No cameras found.');
                            }
                        }).catch(function (e) {
                            console.error(e);
                        });
                    })
                    .catch(function(error) {
                        // An error occurred, handle it accordingly
                        console.error('Error accessing camera: ' + error);
                    });
                }else{
                    console.alert('getUserMedia is not supported in this browser.');
                }
               
            </script>
            </div>
        </div>
    </div>
</x-app-layout>
