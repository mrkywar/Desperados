<?php

namespace Desperados\Game\Managers;

use Core\Managers\Core\SuperManager;
use Core\Models\Player;
use Core\Serializers\Serializer;
use Desperados\Game\Factories\DiceFactory;
use Desperados\Game\Material\Dice;

/**
 * Description of DiceManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiceManager extends SuperManager {
    
    
    
    public function initNewPlayerTurn(){
        $dices = [];
        for ($i=0; $i< DICE_NUMBER; $i++){
            $dices[] = DiceFactory::create();
        }
        
        $this->create($dices);
        
//        $diceThrow = new DiceThrow();Player $player
//        $diceThrow->setPlayer($player)
//                ->setLunches(1)
//                ->setId(0)
//                ->setDice1(DiceFactory::create($player))
//                ->setDice2(DiceFactory::create($player))
//                ->setDice3(DiceFactory::create($player))
//                ->setDice4(DiceFactory::create($player));
//        
//        
//        $this->create($diceThrow);
    }


    protected function initSerializer(): Serializer {
        return new Serializer(Dice::class);
    }

}