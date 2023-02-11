<?php

namespace Desperados\Game\Turn;

use Core\Managers\Core\SuperManager;
use Core\Serializers\Serializer;

/**
 * Description of TurnManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class TurnManager extends SuperManager {

    public function addTurns($turns) {
        return $this->create($turns);
    }

    protected function initSerializer(): Serializer {
        return new Serializer(Turn::class);
    }

}
