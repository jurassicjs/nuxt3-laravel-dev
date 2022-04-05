<?php

namespace App\Domains\Relationship\Enums;

enum RelationshipStatusCode: string
{
    case PROPOSED = 'proposed';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case IGNORED = 'ignored';
    case BLOCKED = 'blocked';
    case SNOOZED = 'snoozed';
    case ENDED = 'ended';
    case PAUSED = 'paused';
}
