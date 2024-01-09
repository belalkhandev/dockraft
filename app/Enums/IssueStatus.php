<?php

namespace App\Enums;

use App\Enums\Concerns\EnumAttributes;

enum IssueStatus: string
{
    use EnumAttributes;

    case TODO = 'todo';
    case IN_PROGRESS = 'in-progress';
    case DEV_COMPLETED = 'dev-completed';
    case IN_REVIEW = 'in-review';
    case IN_TESTING = 'in-testing';
    case CLOSED = 'closed';
    case REOPENED = 'reopened';
    case ON_HOLD = 'on-hold';
    case DEFERRED = 'deferred';
    case BLOCKED = 'blocked';

}
