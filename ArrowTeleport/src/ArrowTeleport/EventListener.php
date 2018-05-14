<?php

namespace ArrowTeleport;

use pocketmine\event\Listener;
use pocketmine\event\entity\ProjectileHitEvent;

use pocketmine\Player;

use pocketmine\entity\projectile\{Arrow, Egg, Snowball};

use pocketmine\level\Level;
use pocketmine\level\sound\EndermanTeleportSound;

use ArrowTeleport\Main;

class EventListener implements Listener {

	public function arrowTeleport(ProjectileHitEvent $e) {
		$entity = $e->getEntity();
		if($entity instanceof Arrow) {
			if(Main::getAPI()->config->get("projectile") == "Arrow") {
				$player = $arrow->getOwningEntity();
				if($player instanceof Player) {
					$player->teleport($entity);
					$sound = new EndermanTeleportSound($player);
					$player->getLevel()->addSound($sound);
					
				}
			
			}
			
		}
		
	}
	
	public function eggTeleport(ProjectileHitEvent $e) {
		$entity = $e->getEntity();
		if($entity instanceof Egg) {
			if(Main::getAPI()->config->get("projectile") == "Egg") {
				$player = $arrow->getOwningEntity();
				if($player instanceof Player) {
					$player->teleport($entity);
					$sound = new EndermanTeleportSound($player);
					$player->getLevel()->addSound($sound);
					
				}
			
			}
			
		}
		
	}
	
	public function snowballTeleport(ProjectileHitEvent $e) {
		$entity = $e->getEntity();
		if($entity instanceof Snowball) {
			if(Main::getAPI()->config->get("projectile") == "Snowball") {
				$player = $arrow->getOwningEntity();
				if($player instanceof Player) {
					$player->teleport($entity);
					$sound = new EndermanTeleportSound($player);
					$player->getLevel()->addSound($sound);
					
				}
			
			}
			
		}
		
	}
	
}
