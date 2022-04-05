<?php

namespace Tests\App\Domains\Relationship\Services;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\Relationship\Enums\RelationshipType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Domains\Relationship\Services\RelationshipService;
use App\Domains\Relationship\Enums\RelationshipStatusCode;
use App\Domains\Relationship\Enums\RelationshipChangeResponse;
use App\Domains\Relationship\Repositories\RelationshipRepository;

class RelationshipServiceTest extends TestCase
{
    use DatabaseMigrations;
//    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        User::factory(2)->create();
        $this->initiatorId = 1;
        $this->respondentId = 2;
        $relationshipRepository = new RelationshipRepository();
        $this->relationshipService = new RelationshipService($relationshipRepository);
    }

    public function testUserCanCreateRelationship()
    {
        User::factory(10000)->create();

        $result = $this->relationshipService->make(
            RelationshipType::FRIENDSHIP,
            $this->initiatorId,
            $this->respondentId
        );

        $this->assertDatabaseHas('relationships', [
            'type' => RelationshipType::FRIENDSHIP,
            'initiator_id' => $this->initiatorId,
            'respondent_id' => $this->respondentId
        ]);

        $this->assertEquals(RelationshipChangeResponse::CREATED, $result);
    }

    public function testCreateRelationshipRequestDuplicatePrevention()
    {
        $this->relationshipService->make(RelationshipType::FRIENDSHIP, $this->initiatorId, $this->respondentId);

        $result = $this->relationshipService->make(RelationshipType::FRIENDSHIP, $this->respondentId, $this->initiatorId);

        $this->assertEquals(RelationshipChangeResponse::DUPLICATE_PREVENTED, $result);
    }

    public function testUserCanBlockExistingRelationship()
    {
        $this->relationshipService->make(
            RelationshipType::SPOUSE,
            $this->initiatorId,
            $this->respondentId
        );

        $this->relationshipService->block($this->respondentId, $this->initiatorId, RelationshipStatusCode::BLOCKED);

        $this->assertDatabaseHas('relationship_statuses', [
            'status_code' => RelationshipStatusCode::BLOCKED,
            'relationship_id' => 1,
            'specifier_id' => $this->respondentId,
        ]);
    }

    public function testUserCanBlockNonExistingRelationship()
    {
        $this->relationshipService->block($this->initiatorId, $this->respondentId, RelationshipStatusCode::BLOCKED);

        $this->assertDatabaseHas('relationships', [
            'type' => RelationshipType::BLOCKED_ON_CREATION,
            'initiator_id' => $this->initiatorId,
            'respondent_id' => $this->respondentId
        ]);

        $this->assertDatabaseHas('relationship_statuses', [
            'status_code' => RelationshipStatusCode::BLOCKED,
            'relationship_id' => 1,
            'specifier_id' => $this->initiatorId,
        ]);
    }
}
