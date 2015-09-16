<?php

namespace OpenStack\Volume\v2;

use OpenStack\Common\Service\AbstractService;

/**
 * Volume v2 service for OpenStack.
 *
 * @property \OpenStack\Volume\v2\Api $api
 */
class Service extends AbstractService
{
    /**
     * List volumes.
     *
     * @param array    $options {@see \OpenStack\Volume\v2\Api::getVolumes}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listVolumes(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getVolumes(), $options);
        return $this->model('Volume')->enumerate($operation, $mapFn);
    }

    /**
     * Retrieve a volume object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see Volume::retrieve}.
     *
     * @param array $options An array of attributes that will be set on the {@see Volume} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\Volume\v2\Models\Volume
     */
    public function getVolume(array $options = [])
    {
        $volume = $this->model('Volume');
        $volume->populateFromArray($options);
        return $volume;
    }

    /**
     * List types.
     *
     * @param array    $options {@see \OpenStack\Volume\v2\Api::getTypes}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listTypes(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getTypes(), $options);
        return $this->model('Type')->enumerate($operation, $mapFn);
    }

    /**
     * Retrieve a type object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see Type::retrieve}.
     *
     * @param array $options An array of attributes that will be set on the {@see Type} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\Volume\v2\Models\Type
     */
    public function getType(array $options = [])
    {
        $type = $this->model('Type');
        $type->populateFromArray($options);
        return $type;
    }

    /**
     *
     *test de récupération de la liste des snapshots
     *
     *
     */
    public function getSnapshot(array $options = [])
    {
        $snapshot = $this->model('Snapshot');
        $snapshot->populateFromArray($options);
        return $snapshot;
    }

    public function listSnapshots(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getSnapshots(), $options);
        return $this->model('Snapshot')->enumerate($operation, $mapFn);
    }

    public function createSnapshot(array $options)
    {
        return $this->model('Snapshot')->create($options);
    }

    public function createVolume(array $options)
    {
        return $this->model('Volume')->create($options);
    }

    public function getLimits($options = [])
    {
        $limits = $this->model('Limits');
        $limits->populateFromArray($options);
        return $limits;
    }

    public function getQuotaSet($id)
    {
        $quotaSet = $this->model('QuotaSet');
        $quotaSet->populateFromArray(['id' => $id]);
        return $quotaSet;
    }
}