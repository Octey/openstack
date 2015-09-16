<?php

namespace OpenStack\Networking\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\Updateable;
use OpenStack\Common\Resource\Retrievable;

/**
 * Represents a Networking v2 Quota Set
 *
 * @property \OpenStack\Volume\v2\Api $api
 */
class QuotaSet extends AbstractResource implements Retrievable, Updateable
{
    public $id;
    public $floatingIp;

    protected $aliases = [
        'floatingip' => 'floatingIp',
    ];

    protected $resourceKey = 'quota';

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