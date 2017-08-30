<?php

namespace Mauretto78\DDD\Infrastructure\Persistance\Projection;

use Mauretto78\DDD\Domain\Model\UserWasCreated;
use SimpleEventStoreManager\Infrastructure\Projector\Projector;

class UserProjector extends Projector
{
    /**
     * @return array
     */
    public function subcribedEvents()
    {
        return [
            UserWasCreated::class
        ];
    }

    public function applyUserWasCreated(UserWasCreated $userWasCreated)
    {
        echo 'ciao da applyUserWasCreated';
    }

    public function rollbackUserWasCreated(UserWasCreated $userWasCreated)
    {
        echo 'ciao';
    }
}
