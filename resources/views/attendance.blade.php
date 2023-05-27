<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="X-CSRF-TOKEN" content="{{ csrf_token() }}">
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
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Attendances</title>
</head>

<body>
    @include('layouts.navigation')
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded m-5">
                <div class="card-body">
                    <h5 class="card-title">Create Attendance</h5>
                    <form class="row mt-3 g-3" method="POST" id="mark-attendance">
                        <div class="col-12">
                            <label for="name" class="form-label">Name <span class="text-danger"
                                    title="Required">*</span></label>
                            <select id="name" name="user_id" class="form-select name">
                                <option value="">Choose...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user?->id }}" @disabled(auth()->user()->role != config('constants.USER_ROLE_ADMIN') && auth()->user()->id != $user?->id)>{{ $user?->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="attendance-status" class="form-label">Attendance Status <span
                                    class="text-danger" title="Required">*</span></label>
                            <select id="attendance-status" name="status" class="form-select status">
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
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Attendance List</h5>
                        <form id="filter-by-date">
                            <div class="input-group input-group-sm">
                                <input type="date" title="Filter by date" class="form-control" class="date" />
                                <x-primary-button>Submit</x-primary-button>
                            </div>

                        </form>
                    </div>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody id="attendance"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('script.js') }}"></script>
</body>

</html>
