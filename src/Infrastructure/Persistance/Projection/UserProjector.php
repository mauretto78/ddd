<?php

namespace Mauretto78\DDD\Infrastructure\Persistance\Projection;

use Mauretto78\DDD\Domain\Model\UserWasCreated;

class UserProjector extends AbstractProjector
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
        $userArray = $userWasCreated->body();
        $this->db->insert(
            'users',
            [
                'id' => $userArray['id'],
                'name' => $userArray['name'],
                'last_name' => $userArray['last_name'],
                'email' => $userArray['email'],
            ]
        );
    }

    public function rollbackUserWasCreated(UserWasCreated $userWasCreated)
    {
        $userArray = $userWasCreated->body();
        $this->db->delete('users', ['id' => $userArray['id']]);
    }
}
