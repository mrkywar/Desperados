<?php

namespace Desperados\Game\Material;

use Core\Models\Core\Model;

/**
 * Description of GangMember
 *
 * @author Mr_Kywar mr_kywar@gmail.com

 *
 * @author Mr_Kywar mr_kywar@gmail.com
 * @ORM\Table{"name":"gangmember"}
 */
class GangMember extends Model {

    /**
     * 
     * @var int|null
     * @ORM\Column{"type":"integer", "name":"member_id", "exclude":["insert"]}
     * @ORM\Id
     */
    private $id;

    /**
     * 
     * @var string
     * @ORM\Column{"type":"string", "name":"member_familly"}
     */
    private $familly;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"int", "name":"member_difficulty"}
     */
    private $difficulty;

    /**
     * 
     * @var string
     * @ORM\Column{"type":"string", "name":"member_category"}
     */
    private $category;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getId(): ?int {
        return $this->id;
    }

    public function getFamilly(): string {
        return $this->familly;
    }

    public function getDifficulty(): int {
        return $this->difficulty;
    }

    public function getCategory(): string {
        return $this->category;
    }

    public function setId(?int $id) {
        $this->id = $id;
        return $this;
    }

    public function setFamilly(string $familly) {
        $this->familly = $familly;
        return $this;
    }

    public function setDifficulty(int $difficulty) {
        $this->difficulty = $difficulty;
        return $this;
    }

    public function setCategory(string $category) {
        $this->category = $category;
        return $this;
    }

}
