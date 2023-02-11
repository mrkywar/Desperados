<?php

namespace Desperados\Game\GameTools;

use Core\Managers\PlayerManager;
use Desperados;
use Desperados\Game\Factories\TurnFactory;
use Desperados\Game\Managers\GangMemberManager;
use Desperados\Game\Managers\StatsManager;
use Desperados\Game\Turn\TurnManager;

/**
 * Description of GameSetup
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GameSetup {

    /**
     * 
     * @var PlayerManager
     */
    private $playerManager;

    /**
     * 
     * @var StatsManager
     */
    private $statsManager;

    /**
     * 
     * @var GangMemberManager
     */
    private $gangMemberManager;

    /**
     * 
     * @var TurnManager
     */
    private $turnManager;

    public function __construct(Desperados $game) {
        $this->playerManager = $game->getPlayerManager();
        $this->statsManager = $game->getStatsManager();
        $this->gangMemberManager = $game->getGangMemberManager();
        $this->turnManager = $game->getTurnManager();
    }

    public function setup($rawPlayers, $options) {
        $this->playerManager->initNewGame($rawPlayers, $options);
        $this->statsManager->initNewGame();
        $this->gangMemberManager->initNewGame();

        $players = $this->playerManager->findBy(
                [],
                null,
                ["no"] //order by
        );

        $turns = [];
        foreach ($players as $player) {
            $turns[] = TurnFactory::create($player);
        }
        $this->turnManager->create($turns);
    }

}
