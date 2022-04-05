<?php

namespace App\Domains\Relationship\Enums;

enum RelationshipChangeResponse
{
    case CREATED ;
    case UPDATED ;
    case DUPLICATE_PREVENTED;
    case NOT_ALLOWED;
    case BLOCKED_REQUEST_IGNORED;
}
