<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-hover table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Total User</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $depart)
                            <tr>
                                <td>{{ $depart->name}}</td>
                                <td>{{ $depart->users_count}}</td>
                                <td>
                                    <a href="{{ route('qrcode',['user'=>$depart->id,'type'=>'department']) }}" class="btn btn-success btn-sm">QR Code</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
