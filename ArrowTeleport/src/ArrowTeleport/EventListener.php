<?php

namespace ArrowTeleport;

use pocketmine\event\Listener;
use pocketmine\event\entity\ProjectileHitEvent;

use pocketmine\Player;

use pocketmine\entity\projectile\Arrow;

use pocketmine\level\Level;
use pocketmine\level\sound\EndermanTeleportSound;

class EventListener implements Listener {
	
	/** @var ProjectileHitEvent $e */
	
	public function teleport(ProjectileHitEvent $e) {
 	$entity = $e->getEntity();
 	if($entity instanceof Arrow) {
 		$player = $entity->getOwningEntity();
 		if($player instanceof Player) {
 			$player->teleport($entity);
 			$sound = new EndermanTeleportSound($player);
 			$player->getLevel()->addSound($sound);
 			
 		}
 		
 	}
 	
 }
	
}