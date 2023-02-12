<?php

namespace Desperados\Game\GameTools;

use Core\Managers\PlayerManager;
use Desperados;
use Desperados\Game\Managers\GangMemberManager;
use Desperados\Game\Managers\StatsManager;
use Desperados\Game\Material\Dice;
use Desperados\Game\Turn\TurnManager;

/**
 * Description of GameDataRetriver
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GameDataRetriver {

    /**
     * 
     * @var PlayerManager
     */
    private $playerManager;

    /**
     * 
     * @var StatsManager
     */
    private $statManager;

    /**
     * 
     * @var TurnManager
     */
    private $turnManager;

    /**
     * 
     * @var GangMemberManager
     */
    private $gangManager;

    public function __construct(Desperados $game) {
        $this->playerManager = $game->getPlayerManager();
        $this->statManager = $game->getStatsManager();
        $this->turnManager = $game->getTurnManager();
        $this->gangManager = $game->getGangMemberManager();
    }

    public function retrive(int $playerId) {

        $currentPlayer = $this->playerManager->findBy([
            "id" => $playerId
        ]); // !! We must only return informations visible by this player !!

        $playerTurn = $this->statManager
                ->getPlayerStat("player_turns_number", $currentPlayer);
        $turn = $this->turnManager->findBy([
            "number" => $playerTurn,
            "playerId" => $currentPlayer->getId()
        ]);

        $gangs = [];
        foreach ($this->playerManager->findBy() as $player) {
            $gangMembers = $this->gangManager->findBy([
                "playerId" => $player->getId()
            ]);
            $gangs[$player->getId()] = $this->displayGang($gangMembers);
        }

        $result = [
            "dices" => $this->displayDices($turn->getDices()),
            "gangs" => $gangs
        ];

        return $result;
    }

    private function displayGang(array $gangMembers) {
        return $this->gangManager->getSerializer()->serialize($gangMembers);
    }

    private function displayDices(array $dices) {
        $rawdices = [];
        foreach ($dices as $dice) {
            $rawdices[] = $this->displayDice($dice);
        }
        return $rawdices;
    }

    private function displayDice(Dice $dice) {
        return [
            "actualFace" => $dice->getActualFace(),
            "face" => $dice->getFace(),
        ];
    }

}
