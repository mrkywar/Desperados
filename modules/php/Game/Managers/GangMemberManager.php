<?php

namespace Desperados\Game\Managers;

use Core\Manager\Core\SuperManager;
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
        $players = \Desperados::getInstance()->getPlayerManager()->findBy();
        echo "<pre>";

        $gangs = GANG_AVIABLE_FAMILLIES;
        shuffle($gangs);

        $members = [];
        foreach ($players as $player) {
            $familly = array_shift($gangs);
            $members = array_merge($members, GangMemberFactory::create($player, $familly));
        }


        var_dump($players, $gangs, $members);
        die;

//        //-- Gang Members
//        $members = [];
//        foreach (GANG_AVIABLE_FAMILLIES as $familly) {
//            $members = array_merge($members, GangMemberFactory::create($familly));
//        }
//
//        $this->create($members);
    }

//    public function drawGangs() {
//
//        $playerManager = \Desperados::getInstance()->getPlayerManager();
//        $players = $playerManager->findBy();
//        $gangs = GANG_AVIABLE_FAMILLIES;
//        shuffle($gangs);
//
//        $qb = $this->prepareUpdate($players);
//        $qs = \Core\DB\QueryStatementFactory::create($qb);
//        echo "<pre>";
//        var_dump($qb, $qs, $gangs);
//        die('stop');
//        return $qb;
//    }

    protected function initSerializer(): Serializer {
        return new Serializer(GangMember::class);
    }

}
