<?php

namespace OpenStack\Compute\v2;

use OpenStack\Common\Service\AbstractService;

/**
 * Compute v2 service for OpenStack.
 *
 * @property \OpenStack\Compute\v2\Api $api
 */
class Service extends AbstractService
{
    /**
     * Create a new server resource. This operation will provision a new virtual machine on a host chosen by your
     * service API.
     *
     * @param array $options {@see \OpenStack\Compute\v2\Api::postServer}
     *
     * @return \OpenStack\Compute\v2\Models\Server
     */
    public function createServer(array $options)
    {
        return $this->model('Server')->create($options);
    }

    /**
     * List servers.
     *
     * @param bool     $detailed Determines whether detailed information will be returned. If FALSE is specified, only
     *                           the ID, name and links attributes are returned, saving bandwidth.
     * @param array    $options  {@see \OpenStack\Compute\v2\Api::getServers}
     * @param callable $mapFn    A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listServers($detailed = false, array $options = [], callable $mapFn = null)
    {
        $def = ($detailed === true) ? $this->api->getServersDetail() : $this->api->getServers();
        $operation = $this->getOperation($def, $options);
        return $this->model('Server')->enumerate($operation, $mapFn);
    }

    /**
     * Retrieve a server object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see Server::retrieve}.
     *
     * @param array $options An array of attributes that will be set on the {@see Server} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\Compute\v2\Models\Server
     */
    public function getServer(array $options = [])
    {
        $server = $this->model('Server');
        $server->populateFromArray($options);
        return $server;
    }

    /**
     * List flavors.
     *
     * @param array    $options {@see \OpenStack\Compute\v2\Api::getFlavors}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listFlavors(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getFlavors(), $options);
        return $this->model('Flavor')->enumerate($operation, $mapFn);
    }

    /**
     * Retrieve a flavor object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see Flavor::retrieve}.
     *
     * @param array $options An array of attributes that will be set on the {@see Flavor} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\Compute\v2\Models\Flavor
     */
    public function getFlavor(array $options = [])
    {
        $flavor = $this->model('Flavor');
        $flavor->populateFromArray($options);
        return $flavor;
    }

    /**
     * List images.
     *
     * @param array    $options {@see \OpenStack\Compute\v2\Api::getImages}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listImages(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getImages(), $options);
        return $this->model('Image')->enumerate($operation, $mapFn);
    }

    /**
     * Retrieve an image object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see Image::retrieve}.
     *
     * @param array $options An array of attributes that will be set on the {@see Image} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\Compute\v2\Models\Image
     */
    public function getImage(array $options = [])
    {
        $image = $this->model('Image');
        $image->populateFromArray($options);
        return $image;
    }

    /**
     * List keypairs.
     *
     * @param array    $options {@see \OpenStack\Compute\v2\Api::getKeypairs}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listKeypairs(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getKeypairs(), $options);
        return $this->model('Keypair')->enumerate($operation, $mapFn);
    }

    /**
     * Retrieve a keypair object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see Keypair::retrieve}.
     *
     * @param array $options An array of attributes that will be set on the {@see Keypair} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\Compute\v2\Models\Keypair
     */
    public function getKeypair(array $options = [])
    {
        $keypair = $this->model('Keypair');
        $keypair->populateFromArray($options);
        return $keypair;
    }

    /**
     * Import a new keypair resource.
     *
     * @param array $options {@see \OpenStack\Compute\v2\Api::postKeypair}
     *
     * @return \OpenStack\Compute\v2\Models\Keypair
     */
    public function importKeypair(array $options)
    {
        return $this->model('Keypair')->create($options);
    }

    /**
     * List security gorups.
     *
     * @param array    $options {@see \OpenStack\Compute\v2\Api::getSecurityGroups}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listSecurityGroups(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getSecurityGroups(), $options);
        return $this->model('SecurityGroup')->enumerate($operation, $mapFn);
    }

    /**
     * Create a new security group rule resource.
     *
     * @param array $options {@see \OpenStack\Compute\v2\Api::postSecurityGroupRule}
     *
     * @return \OpenStack\Compute\v2\Models\SecurityGroupRule
     */
    public function createSecurityGroupRule(array $options)
    {
        return $this->model('SecurityGroupRule')->create($options);
    }

    /**
     * Delete a security group rule resource.
     *
     * @param array $options {@see \OpenStack\Compute\v2\Api::deleteSecurityGroupRule}
     *
     * @return \OpenStack\Compute\v2\Models\SecurityGroupRule
     */
    public function deleteSecurityGroupRule()
    {
        return $this->model('SecurityGroupRule')->delete();
    }
}
