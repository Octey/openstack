<?php

namespace OpenStack\Compute\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\Deletable;
use OpenStack\Common\Resource\Listable;
use OpenStack\Common\Resource\Retrievable;

/**
 * Represents a Compute v2 SecurityGroupRule
 *
 * @property \OpenStack\Networking\v2\Api $api
 */
class SecurityGroupRule extends AbstractResource implements Listable, Retrievable, Deletable
{
    public $id;
    public $fromPort;
    public $toPort;
    public $ipProtocol;
    public $cidr;
    public $parentGroupId;

    protected $aliases = array(
        'from_port' => 'fromPort',
        'to_port' => 'toPort',
        'ip_protocol' => 'remoteGroupId',
        'parent_group_id' => 'parentGroupId'
    );

    protected $resourceKey = 'security_group_rule';
    protected $resourcesKey = 'security_group_rules';

    /**
     * {@inheritDoc}
     *
     * @param array $data {@see \OpenStack\Compute\v2\Api::postSecurityGroupRule}
     */
    public function create(array $data)
    {
        $response = $this->execute($this->api->postSecurityGroupRule(), $data);

        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getSecurityGroupRule(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->execute($this->api->deleteSecurityGroupRule(), ['id' => (string) $this->id]);
    }

}
