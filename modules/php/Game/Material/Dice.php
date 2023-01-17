<?php

namespace Desperados\Game\Material;

/**
 * Description of Dice
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Dice{

    const D_FACES = array(
        1 => "The Cheat",
        2 => "The Bully",
        3 => "The Ugly",
        4 => "The Bad Girl",
        5 => "The Boss",
        6 => "Action"
    );

    /**
     * 
     * @param int $diceValue
     * @return string|null
     */
    public function getFace(int $diceValue) {
        if (isset(self::D_FACES[$diceValue])) {
            return self::D_FACES[$diceValue];
        } else {
            return null;
        }
    }

}
