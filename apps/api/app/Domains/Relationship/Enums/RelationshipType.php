<?php

namespace App\Domains\Relationship\Enums;

enum RelationshipType: string
{
    case FRIENDSHIP = 'friendship';
    case SPOUSE = 'spouse';
    case BLOCKED_ON_CREATION = 'block_on_creation';
}
