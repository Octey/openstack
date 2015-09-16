<?php

namespace OpenStack\Compute\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\Updateable;
use OpenStack\Common\Resource\Retrievable;

/**
 * Represents a Compute v2 Quota Set
 *
 * @property \OpenStack\Compute\v2\Api $api
 */
class QuotaSet extends AbstractResource implements Retrievable, Updateable
{
    public $id;
    public $cores;
    public $fixedIps;
    public $floatingIps;
    public $instances;
    public $keyPairs;
    public $ram;
    public $securityGroups;
    public $securityGroupRules;

    protected $aliases = [
        'fixed_ips' => 'fixedIps',
        'floating_ips' => 'floatingIps',
        'key_pairs' => 'keyPairs',
        'security_groups' => 'securityGroups',
        'security_group_rules' => 'securityGroupRules',
    ];

    protected $resourceKey = 'quota_set';

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getQuotaSet(), $this->getAttrs(['id']));

        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function update()
    {
        $response = $this->executeWithState($this->api->putQuotaSet());

        return $this->populateFromResponse($response);
    }
}