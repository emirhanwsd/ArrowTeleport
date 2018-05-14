<?php

namespace ArrowTeleport\Commands;

use ArrowTeleport\Main;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use pocketmine\Player;
use pocketmine\Server;

class ArrowTeleportCommand extends Command {
	
	public function __construct() {
		parent::__construct(
		  "arrowteleport",
		  "Give a special bow"
		
		);
		
	}
	
	/**
	* @var CommandSender $g
	* @var string $label
	* @var array $args
	* @return bool
	*/
	
	// TODO: Add price
	
	public function execute(CommandSender $sender, string $label, array $args): bool {
		if($sender instanceof Player) {
			if(empty($args[0])) {
				Main::getAPI()->addSpecialBow($sender);
				$sender->sendMessage(Main::PREFIX.Main::getAPI()->config->get("added-your-inventory"));
				$sender->sendMessage("§l§cNOTE: §r§7It bow works if you set projectile to Arrow on config.");
				
			}else{
				switch($args[0]) {
					case "give":
					  if($sender->isOp()) {
					    if(empty($args[1])) {
					  	  $sender->sendMessage(Main::PREFIX.Main::getAPI()->config->get("usage-message"));
					  	
					   }else{
					  	 if(!$player = Server::getInstance()->getPlayer($args[1])) {
					  		 $sender->sendMessage(Main::PREFIX.Main::getAPI()->config->get("player-not-found"));
					  		
					  	 }else{
					  		 Main::getAPI()->addSpecialBow($player);
					  		 $addedxinventory = str_replace("{player}", $player->getName(), Main::getAPI()->config->get("added-x-inventory"));
					  		 $xaddedyourinventory = str_replace("{sender}", $sender->getName(), Main::getAPI()->config->get("x-added-your-inventory"));
					  		 $sender->sendMessage(Main::PREFIX.$addedxinventory);
					  		 $player->sendMessage(Main::PREFIX.$xaddedyourinventory);
					  	
					  	 }
					  	
					   }
					  
					  }else{
					  	$sender->sendMessage(Main::PREFIX.Main::getAPI()->config->get("you-must-be-op"));
					  	
					  }
					break;
					
				}
				
			}
			
		}
		return true;
		
	}
	
}
