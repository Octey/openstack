<?php

namespace OpenStack\Networking\v2;

use OpenStack\Common\Service\AbstractService;

/**
 * Network v2 service for OpenStack.
 *
 * @property \OpenStack\Networking\v2\Api $api
 */
class Service extends AbstractService
{
    /**
     * Create a new network resource.
     *
     * @param array $options {@see \OpenStack\Networking\v2\Api::postNetwork}
     *
     * @return \OpenStack\Networking\v2\Models\Network
     */
    public function createNetwork(array $options)
    {
        return $this->model('Network')->create($options);
    }

    /**
     * Create a new network resources.
     *
     * @param array $options {@see \OpenStack\Networking\v2\Api::postNetworks}
     *
     * @return array
     */
    public function createNetworks(array $options)
    {
        return $this->model('Network')->bulkCreate($options);
    }

    /**
     * Retrieve a network object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see Network::retrieve}.
     *
     * @param string $id
     *
     * @return \OpenStack\Networking\v2\Models\Network
     */
    public function getNetwork($id)
    {
        return $this->model('Network', ['id' => $id]);
    }


    public function getQuotaSet($id)
    {
        $quotaSet = $this->model('QuotaSet');
        $quotaSet->populateFromArray(['id' => $id]);
        return $quotaSet;
    }
}
