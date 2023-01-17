<?php

namespace Desperados\Game\Managers;

use Core\Managers\Core\SuperManager;
use Core\Serializers\Serializer;
use Desperados;
use Desperados\Game\Factories\GangMemberFactory;
use Desperados\Game\Material\GangMember;

/**
 * Description of GameManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GangMemberManager extends SuperManager {

    public function initNewGame() {
        //-- Gang Members
        $members = [];
        foreach (GANG_AVIABLE_FAMILLIES as $familly) {
            $members = array_merge($members, GangMemberFactory::create($familly));
        }

        $this->create($members);      
    }

    public function drawGangs() {

        $playerManager = \Desperados::getInstance()->getPlayerManager();
        $players = $playerManager->findBy();
        $gangs = array("test 1", "test 2", "test 3");
        shuffle($gangs);

        foreach ($players as &$player) {
            $player->setGang(array_shift($gangs));
        }
        $playerManager->setIsDebug(true);
        $playerManager->update($players);
//        die('???');
    }

    protected function initSerializer(): Serializer {
        return new Serializer(GangMember::class);
    }

}
