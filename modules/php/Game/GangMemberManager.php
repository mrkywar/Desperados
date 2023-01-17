<?php

namespace Desperados\Game;

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
        $members = new GangMember();
        foreach (GANG_AVIABLE_FAMILLIES as $familly) {
            $members = array_merge($members, GangMemberFactory::create($familly));
        }
        var_dump($members);
        die;
    }

    protected function initSerializer(): Serializer {
        return new Serializer(GangMember::class);
    }

}
