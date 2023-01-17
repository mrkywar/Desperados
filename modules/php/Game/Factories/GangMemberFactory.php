<?php

namespace Desperados\Game\Factories;

use Desperados\Game\Material\GangMember;

/**
 * Description of GangMemberFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class GangMemberFactory {

    static public function create(string $familly) {
        $members = [];

        foreach (GANG_AVIABLE_MEMBERS as $category) {
            $members[] = self::createMember($category, $familly);
        }

        return $members;
    }

    static private function createMember(string $category, string $familly) {
        $member = new GangMember();

        $difficulty = GANG_DIFFICULTY_MEMBERS[$category];

        $member->setCategory($category)
                ->setFamilly($familly)
                ->setDifficulty($difficulty);

        return $member;
    }

}
