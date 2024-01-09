<?php

namespace App\Enums;

use App\Enums\Concerns\EnumAttributes;

enum ProjectStatus: string
{
    use EnumAttributes;

    case NOT_STARTED = 'not-started';

    case PLANNING = 'planning';

    case IN_PROGRESS = 'in-progress';

    case ON_HOLD = 'on-hold';

    case COMPLETED = 'completed';

    case CANCELLED = 'cancelled';

}
