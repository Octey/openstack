<?php

namespace OpenStack\Test\Identity\v3\Models;

use GuzzleHttp\Message\Response;
use OpenStack\Identity\v3\Api;
use OpenStack\Identity\v3\Models\Endpoint;
use OpenStack\Identity\v3\Models\Service;
use OpenStack\Test\TestCase;

class ServiceTest extends TestCase
{
    private $service;

    public function setUp()
    {
        $this->rootFixturesDir = dirname(__DIR__);

        parent::setUp();

        $this->service = new Service($this->client->reveal(), new Api());
        $this->service->id = 'SERVICE_ID';
    }

    public function test_it_retrieves()
    {
        $request = $this->setupMockRequest('GET', 'services/SERVICE_ID');
        $this->setupMockResponse($request, 'service');

        $this->service->retrieve();
    }

    public function test_it_updates()
    {
        $this->service->type = 'foo';

        $request = $this->setupMockRequest('PATCH', 'services/SERVICE_ID', ['service' => ['type' => 'foo']]);
        $this->setupMockResponse($request, 'service');

        $this->service->update();
    }

    public function test_it_deletes()
    {
        $request = $this->setupMockRequest('DELETE', 'services/SERVICE_ID');
        $this->setupMockResponse($request, new Response(204));

        $this->service->delete();
    }

    public function test_it_returns_false_if_name_and_type_does_not_match()
    {
        $this->assertFalse($this->service->getUrl('foo', 'bar', '', ''));
    }

    public function test_it_retrieves_url_if_name_type_and_region_match()
    {
        $endpoint = new Endpoint($this->client->reveal(), new Api());
        $endpoint->region = 'baz';
        $endpoint->url = 'foo.com';
        $endpoint->interface = 'internal';

        $this->service->name = 'foo';
        $this->service->type = 'bar';
        $this->service->endpoints = [$endpoint];

        $this->assertNotNull($this->service->getUrl('foo', 'bar', 'baz', 'internal'));
        $this->assertFalse($this->service->getUrl('foo', 'bar', 'bat', ''));
    }
} 