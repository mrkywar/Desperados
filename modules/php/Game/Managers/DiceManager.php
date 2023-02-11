<?php

namespace Desperados\Game\Managers;

use Core\Managers\Core\SuperManager;
use Core\Models\Player;
use Core\Serializers\Serializer;
use Desperados\Game\Factories\DiceFactory;
use Desperados\Game\Material\Dice;
use const DICE_NUMBER;

/**
 * Description of DiceManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiceManager extends SuperManager {

    protected function initSerializer(): Serializer {
        return new Serializer(Dice::class);
    }

    public function initNewRound() {
        $dices = [];
        for ($i = 0; $i < DICE_NUMBER; $i++) {
            $dices[] = new Dice();
        }
        $this->create($dices);

        return $this->findBy([], DICE_NUMBER, ["id"]);
    }

}
