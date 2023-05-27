<?php

use App\Models\Attendance;
use App\Models\User;

return [
    'ATTENDANCE_STATUS_PRESENT' => Attendance::STATUS_PRESENT,
    'ATTENDANCE_STATUS_ABSENT' => Attendance::STATUS_ABSENT,
    'USER_ROLE_ADMIN' => User::ROLE_ADMIN,
];
