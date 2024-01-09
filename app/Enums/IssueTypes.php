<?php

namespace App\Enums;

use App\Enums\Concerns\EnumAttributes;

enum IssueTypes: string
{
    use EnumAttributes;

    case TASK = 'task';
    case SUB_TASK = 'subtask';

    case BUG = 'bug';
    case EPIC = 'epic';
    case STORY = 'story';
    case IMPROVEMENT = 'improvement';

}
