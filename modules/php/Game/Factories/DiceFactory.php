<?php

namespace Desperados\Game\Factories;

use Desperados\Game\Material\Dice;

/**
 * Description of DiceFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class DiceFactory {

    static public function create($actualFace = null) {
        $dice = new Dice();
        if (null !== $actualFace) {
            $dice->setActualFace($actualFace);
        }

        return $dice;
    }

}
