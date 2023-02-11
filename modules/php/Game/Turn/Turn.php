<?php

namespace Desperados\Game\Turn;

use Core\Models\Core\Model;
use Core\Models\Player;
use Desperados;
use Desperados\Game\Managers\DiceManager;
use Desperados\Game\Managers\StatsManager;

/**
 * Description of Turn
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 * @ORM\Table{"name":"turn"}
 */
class Turn extends Model {

    /**
     * 
     * @var int|null
     * @ORM\Column{"type":"integer", "name":"turn_id", "exclude":["insert"]}
     * @ORM\Id
     */
    private $id;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"turn_player_id"}
     */
    private $playerId;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"turn_number"}
     */
    private $number;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"turn_roll_count"}
     */
    private $rollCount;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"turn_dice_1_id"}
     */
    private $dice1Id;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"turn_dice_2_id"}
     */
    private $dice2Id;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"turn_dice_3_id"}
     */
    private $dice3Id;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"turn_dice_4_id"}
     */
    private $dice4Id;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Unpersisted property
     * ---------------------------------------------------------------------- */

    /**
     * 
     * @var DiceManager
     */
    private $diceManager;

    /**
     * 
     * @var StatsManager
     */
    private $statManager;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Constructor 
     * ---------------------------------------------------------------------- */

    public function __construct(Player $player) {

        $this->diceManager = Desperados::getInstance()->getDiceManager();
        $this->statManager = Desperados::getInstance()->getStatsManager();

        $actualTurn = $this->statManager->getPlayerStat("player_turns_number", $player);
        var_dump($actualTurn);
        die;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function setId(?int $id) {
        $this->id = $id;
        return $this;
    }

    public function setPlayerId(int $playerId) {
        $this->playerId = $playerId;
        return $this;
    }

    public function setNumber(int $number) {
        $this->number = $number;
        return $this;
    }

    public function setRollCount(int $rollCount) {
        $this->rollCount = $rollCount;
        return $this;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getPlayerId(): int {
        return $this->playerId;
    }

    public function getNumber(): int {
        return $this->number;
    }

    public function getRollCount(): int {
        return $this->rollCount;
    }

    public function getDice1Id(): int {
        return $this->dice1Id;
    }

    public function getDice2Id(): int {
        return $this->dice2Id;
    }

    public function getDice3Id(): int {
        return $this->dice3Id;
    }

    public function getDice4Id(): int {
        return $this->dice4Id;
    }

    public function getDiceManager(): DiceManager {
        return $this->diceManager;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Shortcut
     * ---------------------------------------------------------------------- */

    public function setPlayer(Player $player) {
        $this->playerId = $player->getId();
        return $this;
    }

    public function getPlayer() {
        $pm = Desperados::getInstance()->getPlayerManager();
        return $pm->findBy(["id" => $this->getPlayerId()]);
    }

    public function addDice(Desperados\Game\Material\Dice $dice) {
        
    }

}
