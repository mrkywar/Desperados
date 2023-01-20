<?php

namespace Desperados\Game\Managers;

use Desperados;

/**
 * Description of StatsManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StatsManager {

    public function initNewGame() {
        $game = Desperados::getInstance();
        $players = $game->getPlayerManager()->findBy();

        foreach ($players as $player) {
            $game->setStat(1, "turns_number", $player->getId()); //setStat( $value, $name, $player_id = null )
        }
    }

}
