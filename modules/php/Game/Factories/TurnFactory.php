<?php

namespace Desperados\Game\Factories;

use Core\Models\Player;
use Desperados;
use Desperados\Game\Material\Dice;
use Desperados\Game\Turn\Turn;
use const DICE_NUMBER;

/**
 * Description of TurnFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class TurnFactory {

    static public function create(Player $player) {
        $statManager = Desperados::getInstance()->getStatsManager();

        $turn = new Turn();
        $turn->setPlayerId($player->getId())
                ->setNumber($statManager->getPlayerStat("player_turns_number", $player));

       
        for ($i=0; $i<DICE_NUMBER; $i++) {
            $turn->addDice(new Dice());
        }

        return $turn;
    }

}
