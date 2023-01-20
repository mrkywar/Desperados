<?php

namespace Desperados\Game\Factories;

use Desperados\Game\Material\Dice;

/**
 * Description of DiceFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class DiceFactory {

    static public function create() {
        $dice = new Dice();
//        if (null !== $player) {
//            $dice->setPosition(POSITION_HAND)
//                    ->setPositionArg($player->getId());
//        }
        return $dice;
    }

}
