<?php

namespace App\Domains\Relationship\Repositories;

use App\Domains\Relationship\Enums\RelationshipChangeResponse;
use App\Domains\Relationship\Enums\RelationshipStatusCode;
use App\Domains\Relationship\Enums\RelationshipType;
use App\Domains\Relationship\Models\Relationship;
use App\Domains\Relationship\Models\RelationshipStatus;

class RelationshipRepository
{
    public function make(
        RelationshipType $type,
        int|string       $initiatorId,
        int|string       $respondentId,
        RelationshipStatusCode $relationshipStatusCode
    ): RelationshipChangeResponse
    {
        $relationship = new Relationship();
        $relationship->type = $type;
        $relationship->initiator_id = $initiatorId;
        $relationship->respondent_id = $respondentId;
        $relationship->saveOrFail();

        $status = new RelationshipStatus();
        $status->relationship_id = $relationship->id;
        $status->status_code = $relationshipStatusCode;
        $status->specifier_id = $initiatorId;
        $status->saveOrFail();

        return RelationshipChangeResponse::CREATED;
    }

    public function relationshipExists(int|string $initiatorId, int|string $respondentId): bool
    {
        return Relationship::query()
            ->where('initiator_id', '=', $initiatorId)
            ->where('respondent_id', '=', $respondentId)
            ->orWhere('initiator_id', '=', $respondentId)
            ->where('respondent_id', '=', $initiatorId)
            ->exists();
    }

    public function getRelationShipIdByMembers(int|string $initiatorId, int|string $respondentId): bool
    {
        return Relationship::query()
            ->where('initiator_id', '=', $initiatorId)
            ->where('respondent_id', '=', $respondentId)
            ->orWhere('initiator_id', '=', $respondentId)
            ->where('respondent_id', '=', $initiatorId)
            ->pluck('id')
            ->firstOrFail();
    }

    public function updateStatus(int|string $relationshipId, RelationshipStatusCode $statusCode, int|string $specifierId): RelationshipChangeResponse
    {
        $relationshipStatus = RelationshipStatus::query()->where('relationship_id', '=', $relationshipId)->firstOrFail();

        /** @var $relationshipStatus RelationshipStatus*/
        $relationshipStatus->status_code = $statusCode;
        $relationshipStatus->specifier_id = $specifierId;
        $relationshipStatus->saveOrFail();

        return RelationshipChangeResponse::UPDATED;
    }
}
