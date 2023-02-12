<?php

namespace Desperados\Game\Material;

class Dice {

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

    public function getActualFace() {
        return $this->actualFace;
    }

    public function setActualFace($actualFace) {
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
