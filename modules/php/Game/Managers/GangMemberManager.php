<?php

namespace Desperados\Game\Managers;

use Core\Managers\Core\SuperManager;
use Core\Serializers\Serializer;
use Desperados\Game\Factories\GangMemberFactory;
use Desperados\Game\Material\GangMember;

/**
 * Description of GameManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GangMemberManager extends SuperManager {

    public function initNewGame() {
        $members = [];
        foreach (GANG_AVIABLE_FAMILLIES as $familly) {
            $members = array_merge($members, GangMemberFactory::create($familly));
        }

        
        $this->create($members);
        
        return $members;
    }

    protected function initSerializer(): Serializer {
        return new Serializer(GangMember::class);
    }

}
