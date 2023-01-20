<?php

namespace Desperados\Game\Managers;

use Core\Models\Player;
use Desperados;

/**
 * Description of StatsManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StatsManager {

    private $game;

    public function __construct() {
        $this->game = Desperados::getInstance();
    }

    public function initNewGame() {
        $players = $this->game->getPlayerManager()->findBy();

        foreach ($players as $player) {
            $this->initPlayerStat("turns_number", $player);
        }
    }

    public function initPlayerStat(string $statName, Player $player) {
        return $this->setPlayerStat($statName, $player, 1);
    }

    public function setPlayerStat(string $statName, Player $player, $value = 0) {
        $this->game->setStat($value, $statName, $player->getId());
        return $this;
    }

}
