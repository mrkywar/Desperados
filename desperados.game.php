<?php

use Core\Managers\PlayerManager;
use Desperados\Game\GameTools\GameSetup;
use Desperados\Game\Managers\DiceManager;
use Desperados\Game\Managers\GangMemberManager;
use Desperados\Game\Managers\StatsManager;
use Desperados\Game\Turn\TurnManager;
use Desperados\Game\ZombieTrait;

$swdNamespaceAutoload = function ($class) {
    $classParts = explode('\\', $class);

    if ($classParts[0] == 'Desperados') {
        array_shift($classParts);
        $file = dirname(__FILE__) . '/modules/php/' . implode(DIRECTORY_SEPARATOR, $classParts) . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            var_dump("Impossible to load Desperados class : $class");
        }
    } elseif ($classParts[0] == 'Core') {
        array_shift($classParts);
        $file = dirname(__FILE__) . '/modules/php/Core/' . implode(DIRECTORY_SEPARATOR, $classParts) . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            var_dump("Impossible to load Core class : $class");
        }
    }
};
spl_autoload_register($swdNamespaceAutoload, true, true);

require_once( APP_GAMEMODULE_PATH . 'module/table/table.game.php' );

class Desperados extends Table {

    use ZombieTrait;

    /**
     * 
     * @var Desperados
     */
    private static $instance;

    /**
     * @var PlayerManager
     */
    private $playerManager;

    /**
     * 
     * @var StatsManager;
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

    /**
     * 
     * @var DiceManager
     */
    private $diceManager;

    public function __construct() {
        parent::__construct();

        self::$instance = $this;

        $this->playerManager = new PlayerManager();
        $this->statsManager = new StatsManager();
        $this->gangMemberManager = new GangMemberManager();
        $this->diceManager = new DiceManager();
        $this->turnManager = new TurnManager();

        self::initGameStateLabels(array(
                //    "my_first_global_variable" => 10,
                //    "my_second_global_variable" => 11,
                //      ...
                //    "my_first_game_variant" => 100,
                //    "my_second_game_variant" => 101,
                //      ...
        ));
    }

    protected function getGameName() {
        return "desperados";
    }

    /*
      setupNewGame:

      This method is called only once, when a new game is launched.
      In this method, you must setup the game according to the game rules, so that
      the game is ready to be played.
     */

    protected function setupNewGame($players, $options = array()) {

//        $this->playerManager->initNewGame($players, $options);
//        $this->statsManager->initNewGame();
//        $this->gangMemberManager->initNewGame();

        $gameSetup = new GameSetup($this);
        $gameSetup->setup($players, $options);

//        $this->playerManager->drawGangs();
//
        $this->activeNextPlayer();
    }

    /*
      getAllDatas:

      Gather all informations about current game situation (visible by the current player).

      The method is called each time the game interface is displayed to a player, ie:
      _ when the game starts
      _ when a player refreshes the game page (F5)
     */

    protected function getAllDatas() {
        $result = array();

//        $this->diceManager->initNewPlayerTurn();
//        $ptn = $this->getStat("player_turns_number", self::getCurrentPlayerId());
//        $ttn = $this->getStat("table_turns_number");
////        var_dump($ptn, $ttn);

        $current_player_id = self::getCurrentPlayerId();    // !! We must only return informations visible by this player !!
        // Get information about players
        // Note: you can retrieve some extra field you added for "player" table in "dbmodel.sql" if you need it.
        $sql = "SELECT player_id id, player_score score FROM player ";
        $result['players'] = self::getCollectionFromDb($sql);

        return $result;
    }

    /*
      getGameProgression:

      Compute and return the current game progression.
      The number returned must be an integer beween 0 (=the game just started) and
      100 (= the game is finished or almost finished).

      This method is called each time we are in a game state with the "updateGameProgression" property set to true
      (see states.inc.php)
     */

    function getGameProgression() {
        // TODO: compute and return the game progression

        return 0;
    }

///////////////////////////////////////////////////////////////////////////////////:
////////// DB upgrade
//////////

    /*
      upgradeTableDb:

      You don't have to care about this until your game has been published on BGA.
      Once your game is on BGA, this method is called everytime the system detects a game running with your old
      Database scheme.
      In this case, if you change your Database scheme, you just have to apply the needed changes in order to
      update the game database and allow the game to continue to run with your new version.

     */

    function upgradeTableDb($from_version) {
        // $from_version is the current version of this game database, in numerical form.
        // For example, if the game was running with a release of your game named "140430-1345",
        // $from_version is equal to 1404301345
        // Example:
//        if( $from_version <= 1404301345 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "ALTER TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        if( $from_version <= 1405061421 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "CREATE TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        // Please add your future database scheme changes here
//
//
    }

    /**
     * 
     * @return Desperados
     */
    public static function getInstance(): Desperados {
        return self::$instance;
    }

    /**
     * 
     * @return PlayerManager
     */
    public function getPlayerManager(): PlayerManager {
        return $this->playerManager;
    }

    /**
     * 
     * @return GangMemberManager
     */
    public function getGangMemberManager(): GangMemberManager {
        return $this->gangMemberManager;
    }

    /**
     * 
     * @return StatsManager
     */
    public function getStatsManager(): StatsManager {
        return $this->statsManager;
    }

    /**
     * 
     * @return DiceManager
     */
    public function getDiceManager(): DiceManager {
        return $this->diceManager;
    }

    /**
     * 
     * @return TurnManager
     */
    public function getTurnManager(): TurnManager {
        return $this->turnManager;
    }

}
