<?php

namespace OpenStack\Volume\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\Updateable;
use OpenStack\Common\Resource\Retrievable;

/**
 * Represents a Volume v2 Quota Set
 *
 * @property \OpenStack\Volume\v2\Api $api
 */
class QuotaSet extends AbstractResource implements Retrievable, Updateable
{
    public $id;
    public $gigabytes;
    public $snapshots;
    public $volumes;

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