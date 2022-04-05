<?php

namespace App\Domains\Relationship\Services;

use App\Domains\Relationship\Enums\RelationshipType;
use App\Domains\Relationship\Enums\RelationshipStatusCode;
use App\Domains\Relationship\Enums\RelationshipChangeResponse;
use App\Domains\Relationship\Repositories\RelationshipRepository;


class RelationshipService
{
    private RelationshipRepository $relationshipRepository;

    public function __construct(RelationshipRepository $relationshipRepository)
    {
        $this->relationshipRepository = $relationshipRepository;
    }

    public function make(
        RelationshipType       $type,
        int|string             $initiatorId,
        int|string             $respondentId,
        RelationshipStatusCode $relationshipStatusCode = RelationshipStatusCode::PROPOSED
    ): RelationshipChangeResponse
    {
        $isDuplicate = $this->relationshipRepository->relationshipExists($initiatorId, $respondentId);


        if ($isDuplicate) {
            return RelationshipChangeResponse::DUPLICATE_PREVENTED;
        }

        return $this->relationshipRepository->make($type, $initiatorId, $respondentId, $relationshipStatusCode);
    }

    public function block(int|string $blockerId, int|string $blockeeId, RelationshipStatusCode $status): RelationshipChangeResponse
    {
        $relationshipExists = $this->relationshipRepository->relationshipExists($blockerId, $blockeeId);

        if (!$relationshipExists) {
           return $this->make(RelationshipType::BLOCKED_ON_CREATION, $blockerId, $blockeeId, RelationshipStatusCode::BLOCKED);
        }

        $relationshipId = $this->relationshipRepository->getRelationShipIdByMembers($blockerId, $blockeeId);

        return $this->relationshipRepository->updateStatus($relationshipId, $status, $blockerId);
    }
}
