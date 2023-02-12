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
        $this->setTableStat("table_turns_number",0);
        
        $players = $this->game->getPlayerManager()->findBy();

        foreach ($players as $player) {
            $this->initPlayerStat("player_turns_number", $player);
        }
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Player Stats Management Methods
     * ---------------------------------------------------------------------- */

    /**
     * 
     * @param string $statName
     * @param Player $player
     * @return type
     */
    public function initPlayerStat(string $statName, Player $player) {
        return $this->setPlayerStat($statName, $player, 1);
    }

    public function getPlayerStat(string $statName, Player $player) {
        return $this->game->getStat($statName, $player->getId());
       // 
    }


    /**
     * 
     * @param string $statName
     * @param Player $player
     * @param type $value
     * @return $this
     */
    public function setPlayerStat(string $statName, Player $player, $value = 0) {
        $this->game->setStat($value, $statName, $player->getId());
        return $this;
    }

    /**
     * 
     * @param string $statName
     * @param Player $player
     * @param int $delta
     * @return $this
     */
    public function incrementPlayerStat(string $statName, Player $player, int $delta = 1) {
        //incStat( $delta, $name, $player_id = null )
        $this->game->incStat($delta, $statName, $player->getId());
        return $this;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Table Stats Management Methods
     * ---------------------------------------------------------------------- */

    /**
     * 
     * @param string $statName
     * @return type
     */
    public function initTableStat(string $statName) {
        return $this->setTableStat($statName, 1);
    }

    /**
     * 
     * @param string $statName
     * @param type $value
     * @return $this
     */
    public function setTableStat(string $statName, $value = 0) {
        $this->game->setStat($value, $statName, null);
        return $this;
    }

    /**
     * 
     * @param string $statName
     * @param int $delta
     * @return $this
     */
    public function incrementTableStat(string $statName, int $delta = 1) {
        $this->game->incStat($delta, $statName, null);
        return $this;
    }

}
