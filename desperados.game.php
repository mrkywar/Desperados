<?php

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
    }
};
spl_autoload_register($swdNamespaceAutoload, true, true);

require_once( APP_GAMEMODULE_PATH . 'module/table/table.game.php' );

class Desperados extends Table {

    /**
     * 
     * @var Desperados
     */
    private static $instance;

    public function __construct() {
        self::$instance = $this;
    }

    protected function getGameName() {
        return "Desperados";
    }

    /*
      setupNewGame:

      This method is called only once, when a new game is launched.
      In this method, you must setup the game according to the game rules, so that
      the game is ready to be played.
     */

    protected function setupNewGame($players, $options = array()) {
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
        return;
    }

    function getGameProgression() {
        // TODO: compute and return the game progression

        return 0;
    }
    
    /**
     * Get curent instance of Desperados Game
     * @return Desperados
     */

    public static function getInstance(): Desperados {
        return self::$instance;
    }

}
