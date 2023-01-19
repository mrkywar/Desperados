<?php

namespace Desperados\Game\Factories;

use Core\Models\Player;
use Desperados\Game\Material\GangMember;

/**
 * Description of GangMemberFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class GangMemberFactory {

    static public function create(Player $player, string $familly) {
        $members = [];

        foreach (GANG_AVIABLE_MEMBERS as $category) {
            $members[] = self::createMember($player, $category, $familly);
        }

        return $members;
    }

    static private function createMember(Player $player, string $category, string $familly) {
        $member = new GangMember();

        $difficulty = GANG_DIFFICULTY_MEMBERS[$category];

        $member->setCategory($category)
                ->setFamilly($familly)
                ->setDifficulty($difficulty)
                ->setPlayer($player);

        return $member;
    }

}
