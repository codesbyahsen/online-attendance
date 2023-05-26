<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- jQuery 3.7 CDN --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <style>
        html,
        body {
            overflow-x: hidden;
            padding: 0;
            margin: 0;
        }
    </style>
    <title>Attendances</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>


        <div class="row">
            <div class="col-12">
                <div class="card shadow rounded m-5">
                    <div class="card-body">
                        <h5 class="card-title">Create Attendance</h5>
                        <form class="row mt-3 g-3" action="{{ route('attendances.store') }}" method="POST">
                            @csrf
                            <div class="col-12">
                                <label for="name" class="form-label">Name <span class="text-danger"
                                        title="Required">*</span></label>
                                <select id="name" name="user_id" class="form-select">
                                    <option value="">Choose...</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user?->id }}" @selected(auth()->user()->id == $user?->id)
                                            @disabled(auth()->user()->id != $user?->id)>{{ $user?->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="attendance-status" class="form-label">Attendance Status <span
                                        class="text-danger" title="Required">*</span></label>
                                <select id="attendance-status" name="status" class="form-select">
                                    <option value="">Choose...</option>
                                    <option value="{{ config('constants.ATTENDANCE_STATUS_PRESENT') }}">Present</option>
                                    <option value="{{ config('constants.ATTENDANCE_STATUS_ABSENT') }}">Absent</option>
                                </select>
                                @error('status')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <x-primary-button class="float-end">{{ __('Mark Attendance') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow rounded m-5 p-3">
                    <div class="card-body">
                        <h5 class="card-title">Attendance List</h5>
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $attendance?->user?->name }}</td>
                                        <td>{{ $attendance?->date }}</td>
                                        <td>{{ $attendance?->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
