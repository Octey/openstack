<?php

namespace OpenStack\Volume\v2;

use OpenStack\Common\Api\AbstractParams;

class Params extends AbstractParams
{
    public function urlId($type)
    {
        return parent::id($type) + [
            'required' => true,
            'location' => self::URL,
        ];
    }
}
