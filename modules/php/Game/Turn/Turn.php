<?php

namespace Desperados\Game\Turn;

use Core\Models\Core\Model;
use Core\Models\Player;
use Desperados;
use Desperados\Game\Factories\DiceFactory;

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
     * @ORM\Column{"type":"integer", "name":"turn_dice_1_face"}
     */
    private $dice1Face;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"turn_dice_2_face"}
     */
    private $dice2Face;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"turn_dice_3_face"}
     */
    private $dice3Face;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"turn_dice_4_face"}
     */
    private $dice4Face;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Constructor 
     * ---------------------------------------------------------------------- */

    public function __construct() {
        $this->setRollCount(1);
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

    public function getDice1Face(): int {
        return $this->dice1Face;
    }

    public function getDice2Face(): int {
        return $this->dice2Face;
    }

    public function getDice3Face(): int {
        return $this->dice3Face;
    }

    public function getDice4Face(): int {
        return $this->dice4Face;
    }

    public function setDice1Face(int $dice1Face) {
        $this->dice1Face = $dice1Face;
        return $this;
    }

    public function setDice2Face(int $dice2Face) {
        $this->dice2Face = $dice2Face;
        return $this;
    }

    public function setDice3Face(int $dice3Face) {
        $this->dice3Face = $dice3Face;
        return $this;
    }

    public function setDice4Face(int $dice4Face) {
        $this->dice4Face = $dice4Face;
        return $this;
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
        if (null === $this->dice1Face) {
            $this->dice1Face = $dice->getActualFace();
        } elseif (null === $this->dice2Face) {
            $this->dice2Face = $dice->getActualFace();
        } elseif (null === $this->dice3Face) {
            $this->dice3Face = $dice->getActualFace();
        } elseif (null === $this->dice4Face) {
            $this->dice4Face = $dice->getActualFace();
        } else {
            throw new TurnException("TE-01 : Only 4 dice for a turn");
        }
    }

    public function getDices() {
        return [
            DiceFactory::create($this->dice1Face),
            DiceFactory::create($this->dice2Face),
            DiceFactory::create($this->dice3Face),
            DiceFactory::create($this->dice4Face),
        ];
    }

}
