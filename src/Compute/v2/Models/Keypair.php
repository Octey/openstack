<?php

namespace OpenStack\Compute\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\Listable;
use OpenStack\Common\Resource\Retrievable;

/**
 * Represents a Compute v2 Keypair.
 *
 * @property \OpenStack\Compute\v2\Api $api
 */
class Keypair extends AbstractResource implements Listable, Retrievable
{
    public $id;
    public $name;
    public $fingerprint;
    public $publicKey;
    public $privateKey;

    protected $resourceKey = 'keypair';
    protected $resourcesKey = 'keypairs';

    protected $aliases = [
        'public_key'    => 'publicKey',
        'private_key'    => 'privateKey',
    ];

    /**
     * {@inheritDoc}
     */
    public function populateFromArray(array $array)
    {
        if (isset($array['keypair'])) {
            foreach ($array['keypair'] as $key => $val) {
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

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getKeypair(), ['name' => (string) $this->name]);
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     *
     */
    public function create(array $data)
    {
        $response = $this->execute($this->api->postKeypair(), $data);
        return $this->populateFromResponse($response);
    }


    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->execute($this->api->deleteKeypair(), $this->getAttrs(['name']));
    }

}