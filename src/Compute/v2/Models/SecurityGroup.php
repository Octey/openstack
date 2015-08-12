<?php

namespace OpenStack\Compute\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\Deletable;
use OpenStack\Common\Resource\Listable;
use OpenStack\Common\Resource\Retrievable;

/**
 * Represents a Compute v2 SecurityGroup
 *
 * @property \OpenStack\Networking\v2\Api $api
 */
class SecurityGroup extends AbstractResource implements Listable, Retrievable, Deletable
{
    public $id;
    public $description;
    public $name;
    public $tenantId;
    public $rules;
    public $securityGroups;

    protected $aliases = array(
        'tenant_id' => 'tenantId',
        'security_groups' => 'securityGroups',
    );

    protected $resourceKey = 'security_group';
    protected $resourcesKey = 'security_groups';

    /**
     * {@inheritDoc}
     *
     * @param array $data {@see \OpenStack\Compute\v2\Api::postSecurityGroup}
     */
    public function create(array $data)
    {
        $response = $this->execute($this->api->postSecurityGroup(), $data);

        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getSecurityGroup(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->execute($this->api->deleteSecurityGroup(), ['id' => (string) $this->id]);
    }

}
