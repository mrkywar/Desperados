<?php

namespace Desperados\Game\Material;

use Core\Models\Core\Model;

/**
 * Description of Dice
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 * @ORM\Table{"name":"dice"}
 */
class Dice extends Model {

    /**
     * 
     * @var int|null
     * @ORM\Column{"type":"integer", "name":"dice_id", "exclude":["insert"]}
     * @ORM\Id
     */
    private $id;

    /**
     * 
     * @var string
     * @ORM\Column{"type":"string", "name":"dice_postion", "default":0}
     */
    private $position;

    /**
     * 
     * @var string
     * @ORM\Column{"type":"string", "name":"dice_postion_arg"}
     */
    private $positionArg;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"dice_actual_face", "default":0}
     */
    private $actualFace;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Constructor 
     * ---------------------------------------------------------------------- */

    public function __construct() {
        $this->roll();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getId(): ?int {
        return $this->id;
    }

    public function getPosition(): string {
        return $this->position;
    }

    public function getPositionArg(): string {
        return $this->positionArg;
    }

    public function getActualFace(): int {
        return $this->actualFace;
    }

    public function setId(?int $id) {
        $this->id = $id;
        return $this;
    }

    public function setPosition(string $position) {
        $this->position = $position;
        return $this;
    }

    public function setPositionArg(string $positionArg) {
        $this->positionArg = $positionArg;
        return $this;
    }

    public function setActualFace(int $actualFace) {
        $this->actualFace = $actualFace;
        return $this;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Shortcut
     * ---------------------------------------------------------------------- */

    /**
     * 
     * @param int $diceValue
     * @return string|null
     */
    public function getFace() {
        if (isset(DICE_FACES[$this->getActualFace()])) {
            return DICE_FACES[$this->getActualFace()];
        } else {
            return null;
        }
    }

    public function roll() {
        $aviableFaces = array_keys(DICE_FACES);
        shuffle($aviableFaces);
        return $this->setActualFace(array_shift($aviableFaces));
    }

}