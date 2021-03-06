<?php

namespace OpenStack\Test\Identity\v3\Models;

use GuzzleHttp\Message\Response;
use OpenStack\Identity\v3\Api;
use OpenStack\Identity\v3\Models\Policy;
use OpenStack\Test\TestCase;

class PolicyTest extends TestCase
{
    private $policy;

    public function setUp()
    {
        $this->rootFixturesDir = dirname(__DIR__);

        parent::setUp();

        $this->policy = new Policy($this->client->reveal(), new Api());
        $this->policy->id = 'POLICY_ID';
    }

    public function test_it_creates()
    {
        $userOptions = [
            'blob' => 'blob',
            'projectId' => 'id',
            'type' => 'type',
            'userId' => 'id',
        ];

        $userJson = [
            'blob' => 'blob',
            'project_id' => 'id',
            'type' => 'type',
            'user_id' => 'id',
        ];

        $request = $this->setupMockRequest('POST', 'policies', $userJson);
        $this->setupMockResponse($request, 'policy');

        /** @var $policy \OpenStack\Identity\v3\Models\Policy */
        $policy = $this->policy->create($userOptions);

        $this->assertInstanceOf(Policy::class, $policy);
        $this->assertEquals('--policy-id--', $policy->id);
    }

    public function test_it_retrieves()
    {
        $request = $this->setupMockRequest('GET', 'policies/POLICY_ID');
        $this->setupMockResponse($request, 'policy');

        $this->policy->retrieve();
    }

    public function test_it_updates()
    {
        $this->policy->type = 'foo';

        $request = $this->setupMockRequest('PATCH', 'policies/POLICY_ID', ['type' => 'foo']);
        $this->setupMockResponse($request, 'policy');

        $this->policy->update();
    }

    public function test_it_deletes()
    {
        $request = $this->setupMockRequest('DELETE', 'policies/POLICY_ID');
        $this->setupMockResponse($request, new Response(204));

        $this->policy->delete();
    }
}