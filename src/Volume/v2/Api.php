<?php

namespace OpenStack\Volume\v2;

use OpenStack\Common\Api\ApiInterface;

/**
 * A representation of the Volume (Nova) v2 REST API.
 *
 * @internal
 * @package OpenStack\Volume\v2
 */
class Api implements ApiInterface
{
    private $idParam = [
        'type' => 'string',
        'required' => true,
        'location' => 'url',
        'description' => 'The unique ID of the remote resource.',
    ];

    private $nameParam = [
        'type' => 'string',
        'location' => 'json',
        'description' => 'The name of the resource',
    ];

    private $keyParam = [
        'type' => 'string',
        'location' => 'url',
        'required' => true,
        'description' => 'The specific metadata key you are interacting with',
    ];

    private $limitParam = [
        'type'     => 'integer',
        'location' => 'query',
        'description' => <<<DESC
This will limit the total amount of elements returned in a list up to the number specified. For example, specifying a
limit of 10 will return 10 elements, regardless of the actual count.
DESC
    ];

    private $markerParam = [
        'type'     => 'string',
        'location' => 'query',
        'description' => <<<DESC
Specifying a marker will begin the list from the value specified. Elements will have a particular attribute that
identifies them, such as a name or ID. The marker value will search for an element whose identifying attribute matches
the marker value, and begin the list from there.
DESC
    ];

    public function getSnapshots()
    {
        return [
            'method' => 'GET',
            'path'   => 'snapshots',
            'params' => [
                'limit'   => $this->limitParam,
                //'marker'  => $this->markerParam,
            ],
        ];
    }

    public function getSnapshotsDetail()
    {
        $op = $this->getAll();
        $op['path'] += '/detail';
        return $op;
    }

    public function getSnapshot()
    {
        return [
            'method' => 'GET',
            'path'   => 'snapshots/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

    public function postSnapshot()
    {
        return [
            'method' => 'POST',
            'path'   => 'snapshots',
            'jsonKey' => 'snapshot',
            'params' => [
                'name' => [
                    'type' => 'string',
                    'required' => true,
                ],
                'description' => [
                    'type' => 'string',
                    'required' => false,
                ],
                'volume_id' => [
                    'type' => 'string',
                    'required' => true,
                ],
                'force' => [
                    'type' => 'string',
                ],
                'quiesce' => [
                    'type' => 'string',
                ],
            ]
        ];
    }

    public function deleteSnapshot()
    {
        return [
            'method' => 'DELETE',
            'path'   => 'snapshots/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

    public function getBackups()
    {
        return [
            'method' => 'GET',
            'path'   => 'backups',
            'params' => [
                'limit'   => $this->limitParam,
                'marker'  => $this->markerParam,
            ],
        ];
    }

    public function getBackupsDetail()
    {
        $op = $this->getAll();
        $op['path'] += '/detail';
        return $op;
    }

    public function getBackup()
    {
        return [
            'method' => 'GET',
            'path'   => 'backups/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

    public function postBackup()
    {
        return [
            'method' => 'POST',
            'path'   => 'backups',
            'jsonKey' => 'backup',
            'params' => [
                'name' => [
                    'type' => 'string',
                    'required' => true,
                ],
                'description' => [
                    'type' => 'string',
                    'required' => false,
                ],
                'backup_id' => [
                    'type' => 'string',
                    'required' => true,
                ],
                'force' => [
                    'type' => 'string',
                ],
            ]
        ];
    }


    public function getVolumes()
    {
        return [
            'method' => 'GET',
            'path'   => 'volumes',
            'params' => [
                'limit'   => $this->limitParam,
                'marker'  => $this->markerParam,
            ],
        ];
    }

    public function getVolumesDetail()
    {
        $op = $this->getAll();
        $op['path'] += '/detail';
        return $op;
    }

    public function getVolume()
    {
        return [
            'method' => 'GET',
            'path'   => 'volumes/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }
    public function postVolume()
    {
        return [
            'method' => 'POST',
            'path'   => 'volumes',
            'jsonKey' => 'volume',
            'params' => [
                'name' => [
                    'type' => 'string',
                    'required' => true,
                ],
                'description' => [
                    'type' => 'string',
                    'required' => false,
                ],
                'snapshot_id' => [
                    'type' => 'string',
                    'required' => false,
                ],
                'imageRef' => [
                    'type' => 'string',
                    'required' => false,
                ],
                'volume_id' => [
                    'type' => 'string',
                    'required' => false,
                ],
                'force' => [
                    'type' => 'string',
                ],
                'size' => [
                    'type' => 'integer',
                ],
            ]
        ];
    }

    public function deleteVolume()
    {
        return [
            'method' => 'DELETE',
            'path'   => 'volumes/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

    public function getTypes()
    {
        return [
            'method' => 'GET',
            'path'   => 'types',
            'params' => [
                'limit'   => $this->limitParam,
            ],
        ];
    }

    public function getTypesDetail()
    {
        $op = $this->getAll();
        $op['path'] += '/detail';
        return $op;
    }

    public function getType()
    {
        return [
            'method' => 'GET',
            'path'   => 'types/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

    public function getLimits()
    {
        return [
            'method' => 'GET',
            'path'   => 'limits',
            'params' => [
                'limit'   => $this->limitParam,
            ],
        ];
    }


    private function isRequired(array $param)
    {
        return array_merge($param, ['required' => true]);
    }

    private function notRequired(array $param)
    {
        return array_merge($param, ['required' => false]);
    }
}