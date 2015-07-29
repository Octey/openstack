<?php

namespace OpenStack\Volume\v2\Models;

use OpenStack\Common\Resource\Retrievable;
use OpenStack\Common\Resource\AbstractResource;

/**
 * Represents a Volume v2 Limits.
 *
 * @property \OpenStack\Volume\v2\Api $api
 */
class Limits extends AbstractResource implements Retrievable
{
    public $maxTotalVolumes;
    public $totalVolumesUsed;

    public $maxTotalVolumeGigabytes;
    public $totalGigabytesUsed;

    public $maxTotalSnapshots;
    public $totalSnapshotsUsed;

    public $maxTotalBackups;
    public $totalBackupsUsed;

    public $maxTotalBackupGigabytes;
    public $totalBackupGigabytesUsed;

    protected $resourceKey = 'limits';
    protected $resourcesKey = 'limits';

    public function populateFromArray(array $array)
    {
        if (isset($array['absolute'])) {
            foreach ($array['absolute'] as $key => $val) {
                $property = isset($this->aliases[$key]) ? $this->aliases[$key] : $key;
                if (property_exists($this, $property)) {
                    $this->$property = $val;
                }
            }
        }
        else {
            parent::populateFromArray($array);
        }
    }

    public function retrieve()
    {
        //$response = $this->execute($this->api->getLimits(), $this->getAttrs(['id']));
        $response = $this->execute($this->api->getLimits());
        return $this->populateFromResponse($response);
    }

}