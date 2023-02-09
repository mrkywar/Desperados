<?php

namespace Desperados\Game\GameTools;

use Core\Managers\PlayerManager;
use Desperados;
use Desperados\Game\Managers\GangMemberManager;
use Desperados\Game\Managers\StatsManager;

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

    public function __construct(Desperados $game) {
        $this->playerManager = $game->getPlayerManager();
        $this->statsManager = $game->getStatsManager();
        $this->gangMemberManager = $game->getGangMemberManager();
    }

    public function setup($rawPlayers, $options) {
        $this->playerManager->initNewGame($rawPlayers, $options);
        $this->statsManager->initNewGame();
        $this->gangMemberManager->initNewGame();
    }

}
