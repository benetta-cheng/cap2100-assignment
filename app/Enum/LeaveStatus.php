<?php

namespace App\Enum;

abstract class LeaveStatus
{
    const PENDING = 'Pending';
    const MEET_STUDENT = 'Meet Student';
    const APPROVED = 'Approved';
    const REJECTED = 'Rejected';
    const CANCELLED = 'Cancelled';
}
